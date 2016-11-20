<?php
/**
 * Created by PhpStorm.
 * User: red
 * Date: 11/18/16
 * Time: 10:12 AM
 */

namespace Home\Controller;
use Think\Controller;
use Home\API\UserAPI;

class CartController extends Controller
{
    public function index()
    {
        $this->theme('colleague')->display('/Info/cart');
    }
    public function cart_num()
    {
        $container_id=I('get.id','count');
        $show=isset($_GET['show'])?true:false;      //是否显示购物车内容
        S(array(
            'type'=>'memcache',
            'host'=>'127.0.0.1',
            'port'=>'11211',
        ));
        $user_id=0;
        $user_api=new UserAPI();
        $get_user=$user_api->getUser();
        if($get_user)
        {
            $user_id=$get_user->user_id;
        }
        else
        {
            exit('-1');
        }
        $cart_key='Cart_'.$user_id;
        $get_cart_cache=S($cart_key);
        if($get_cart_cache){
            if($show)
            {
                $product=json_decode($get_cart_cache,1);
                $pids='';
                foreach($product as $key=>$value)
                {
                    if($pids!='')$pids.=',';
                    $pids.=$key;
                }
                $result=M('info')->where(' info_id in ('.$pids.')')->field('info_id,info_title')->select();
                $result_meta=M('info_meta')->where(' info_id in ('.$pids.')')->select();
                echo "product_list=eval('".json_encode($result)."');".PHP_EOL;
                echo "product_meta_list=eval('".json_encode($result_meta)."');".PHP_EOL;
                echo "product_cart=eval(".$get_cart_cache.");".PHP_EOL;

                exit();
            }
            else
            {
                $get_cart_cache=json_decode($get_cart_cache,1);
                exit('document.getElementById("'.$container_id.'").innerHTML='.count($get_cart_cache).';');
            }
        }else{
            exit('0');
        }
    }
    public function del_cart()
    {
        $pid=I('get.pid','');
        if($pid=='')exit('0');
        S(array(
            'type'=>'memcache',
            'host'=>'127.0.0.1',
            'port'=>'11211',
        ));
        $user_id=0;
        $user_api=new UserAPI();
        $get_user=$user_api->getUser();
        if($get_user)
        {
            $user_id=$get_user->user_id;
        }
        $cart_key='Cart_'.$user_id;
        $get_cart_cache=S($cart_key);

        if($get_cart_cache)
        {
            $get_cart_cache=json_decode($get_cart_cache,1);
            unset($get_cart_cache[$pid]);
            S($cart_key,json_encode($get_cart_cache),21600);
        }else{
            exit('-1');
        }
        exit('1');
    }
    public function add_cart()
    {
        S(array(
            'type'=>'memcache',
            'host'=>'127.0.0.1',
            'port'=>'11211',
        ));
        $user_id=0;
        $user_api=new UserAPI();
        $get_user=$user_api->getUser();
        if($get_user)
        {
            $user_id=$get_user->user_id;
        }
        else
        {
            exit('-1');
        }
        $pmeta=I('post.pmeta','','/(\d+_)+$/'); //传来规格ID们，形如28_32_
        $pid=I('post.pid',0,'/\d+$/');          //传来商品主键ID
        if($pid>0 && $pmeta != '')
        {
            /**
             *  1：首先先按照商品主键ID获取数据库中所有关联了该主键ID的子表数据
                2：根据之前获得的规格，去查找是否有以这些规格为pid的数据，查找出来，这些数据都代表了与选中规格相关的价格。
                3：价格全部获取到了，然后按照价格的im_id去寻找是否有以这些id作为im_key的数据。
                3.1：如果有说明他还关联了其他规格。
                    3.1.1：取到关联规格数据，去查找im_value，这个数据就是同时需要选择的关联规格。
                    3.1.2：在先前取到的规格ID们中寻找是否有这个im_value。
                        3.1.2.1：如果有，那么这个价格就生效了。
                        3.1.2.2：如果没有，就使用默认价格。
                3.2：如果没有直接输出默认价格。pid=0的价格。
             */

            //获取与该商品相关的所有meta
            $get_meta=M('info_meta')->where(' info_id='.$pid)->select();
            $originPrice=$this->getOriginPrice($get_meta);
            $productIds=explode('_',$pmeta);        //将拿过来的规格ID们，打成数组
            $finalPrice=0;                          //最终价格定义
            $productResult=array();                 //存放价格与其相应的im_id
            foreach($productIds as $im_id)
            {
                if($im_id=='')continue;
                //根据规格ID获取数据表中所有以这些ID为pid的价格们，并把价格存放到productResult
                array_push($productResult,$this->getPriceByImPid($im_id,$get_meta));
            }
            if(!empty($productResult[1]))
            {
                foreach($productResult[1] as $item)
                {
//                var_export(key($item));
//                echo '-----';
                    $primary=$this->getRelationByImId(key($item),$get_meta);
                    if(in_array($primary,$productIds))
                    {
                        $finalPrice=$item[key($item)];
                        break;
                    }else{
                        $finalPrice=$originPrice;
                    }
                }
            }else{
                $finalPrice=$originPrice;
            }
//            var_export(S('Cart'.$user_id));
//            exit();
            if($finalPrice<=0)exit('error!');
            $cart_class=new \stdClass();
            $cart_class->userid=$user_id;
            $cart_class->pid=$pid;
            $cart_class->pmeta=$productIds;
            $cart_class->price=$finalPrice;
            $cart_key='Cart_'.$user_id;
            $get_cart_cache=S($cart_key);
            if($get_cart_cache)
            {
                $get_cart_cache=json_decode($get_cart_cache,1);
                $get_cart_cache[$pid]=$cart_class;
                S($cart_key,json_encode($get_cart_cache),21600);
            }else{
                S($cart_key,json_encode(array($pid=>$cart_class)),21600);
            }
            exit('OK');
        }
        else
        {
            exit('提交数据不符合规范');
        }
    }

    /**
     * 取得商品的初始价格
     * @param $meta     与该商品相关的所有表项
     * @return mixed    返回pid为0且im_key是current_price的值，即为初试价格
     */
    private function getOriginPrice($meta)
    {
        foreach($meta as $key => $value)
        {
            if($value['im_key']=='current_price' && $value['im_pid']==0)
            {
                return $value['im_value'];
            }
        }
    }

    /**
     * 通过价格的Pid获取他的规格名称
     * @param $im_id        这个是传过来的规格ID，会作为价格的pid去寻找价格
     * @param $meta         商品相关表项
     * @return array        返回键值对，形如array(product=>499) 、 array(product_color=>599)
     */
    private function getPriceByImPid($im_id,$meta)
    {
        $prices=array();
        foreach($meta as $item)
        {
            if($item['im_pid']==$im_id && $item['im_key']=='current_price') {
//                return array($this->getImKeyByImId($item['im_pid'],$meta)=>$item['im_value']);
                array_push($prices, array($item['im_id'] => $item['im_value']));    //存放价格键值对,比如42=>499
            }
        }
        return $prices;
    }

    /**
     * 根据im_id获取该id下的im_key
     * @param $im_id
     * @param $meta
     * @return string
     */
    private function getImKeyByImId($im_id,$meta)
    {
        foreach($meta as $item)
        {
            if($item['im_id']==$im_id)return $item['im_key'];
        }
        return '';
    }

    /**
     * 获取价格与主规格之间的联系
     * @param $im_id    选择的价格所属的im_id，对应的值是主规格ID
     * @param $meta
     */
    private function getRelationByImId($im_id,$meta)
    {
        $relation=array();
        foreach($meta as $item)
        {
            if($item['im_key']==$im_id)
            {
                return $item['im_value'];
            }
        }
    }
}