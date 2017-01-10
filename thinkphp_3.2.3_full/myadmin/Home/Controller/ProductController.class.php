<?php
namespace Home\Controller;
use Think\Controller;
use Home\API\UploadAPI;
use Think\Upload;

class ProductController extends Controller {
    public $info_id;        //当前正在操作的商品id
    public function index(){
        $info=M('markzhu_info');
        $product=$info->field('info_id,info_title,info_date')->where('info_type=2')->limit(100)->select();
        $info_id_set='';
        foreach($product as  $key => $value)
        {
            if($info_id_set!='')$info_id_set.=',';
            $info_id_set.=$value['info_id'];
        }
        $info_meta=M('markzhu_info_meta')->where('info_id in('.$info_id_set.')')->order('info_id desc')->select();
        //给product塞进最大最小价格
        $product=$this->_productPrice($product,$info_meta);
        $this->assign('product',$product);
        $this->display('product/product_info');
    }
    //生成最大最小价格
    public function _productPrice($product,$info_meta){
        foreach($product as $key => $item){
            $max=-1;
            $min=-1;
            foreach($info_meta as $value)
            {
                if($item['info_id']==$value['info_id'])
                {
                    if($value['im_key']=='current_price'){
                        if($max==-1)$max=$value['im_value'];
                        if($min==-1)$min=$value['im_value'];
                        if($max<$value['im_value'])$max=$value['im_value'];
                        if($min>$value['im_value'])$min=$value['im_value'];
                    }
                    if($value['im_key']=='views'){
                        $product[$key]['info_views']=$value['im_value'];
                    }
                }
            }
            $product[$key]['info_max_price']=$max;
            $product[$key]['info_min_price']=$min;
        }
        return $product;
    }
    public function addProduct(){
        $this->display('product/product_add');
    }

    public function uploadImage(){
        $upload=new UploadAPI();
        $upload->upload();
    }

    public function submitProduct(){
        $data=json_decode(file_get_contents('php://input'));
        if($data){
            $product_info=M('markzhu_info');
            if($product_info->where('info_id='.$data->info_id)->data($data)->save()!==false){
                echo 'updated';
            }
        }
    }

    public function updateProduct(){
        $this->info_id=I('get.info_id','0','/^\d{1,20}$/');
        $prod=M('markzhu_info')->where('info_id='.$this->info_id)->select();
        $this->assign('prod',$prod[0]);
        $prod_detail=M('markzhu_info_meta')->where('info_id='.$this->info_id)->select();
        $product=array();
        $color=array();
        $price=array();
        foreach($prod_detail as $item)
        {
            if($item['im_key']=='product')
            {
                array_push($product,$item);
            }
            if($item['im_key']=='product_color')
            {
                array_push($color,$item);
            }
        }
        $this->assign('product',$product);
        $this->assign('color',$color);
        $this->assign('price',$price);
        $prod_size=$this->_gainProductRelation($prod_detail,$this->info_id);

        $this->assign('prod_size',$prod_size);
        $this->display('product/product_update');
    }

    public function addProductRelation(){
        $data=json_decode(file_get_contents('php://input'));
//        var_export($data);
        $prod_meta=M('markzhu_info_meta');
        $info_id=$data[5]->info_id;
        $add_data=[];
        foreach($data as $num=>$item)
        {
            foreach($item as $key => $value)
            {
                $add_data[$key]['im_key']=$key;
                $add_data[$key]['im_value']=$value;
                $add_data[$key]['info_id']=$info_id;
            }
        }
//        var_export($add_data);
        $insert_ids=new \stdClass();
        $prod_meta->startTrans();
        $insert_ids->product_color_id=isset($add_data['product_color'])?$prod_meta->add($add_data['product_color']):$add_data['product_color_id']['im_value'];
        $insert_ids->product_mainType_id=isset($add_data['product'])?$prod_meta->add($add_data['product']):$add_data['product_id']['im_value'];
        if($insert_ids->product_color_id && intval($insert_ids->product_color_id) > 0 && $insert_ids->product_mainType_id && intval($insert_ids->product_mainType_id) > 0)
        {
            $add_data['current_price']['im_pid']=$insert_ids->product_color_id;
            $insert_ids->product_price_id=$prod_meta->add($add_data['current_price']);
            if($insert_ids->product_price_id && intval($insert_ids->product_price_id))
            {
                $relation['im_key']=$insert_ids->product_price_id;
                $relation['im_value']=$insert_ids->product_mainType_id;
                $relation['info_id']=$info_id;
                if($insert_ids->product_relation_id=$prod_meta->add($relation))
                {
                    $prod_meta->commit();
                    echo json_encode($insert_ids);
                    return true;
                }
            }
        }
        $prod_meta->rollback();
        echo 0;
    }

    public function delProductRelation(){
        $data=json_decode(file_get_contents('php://input'));
        $prod_meta=M('markzhu_info_meta');
        $prod_meta->startTrans();
        $flag=0;
        foreach($data as $key => $value)
        {
            if($value>0){
                if(!$prod_meta->where('im_id='.$value)->delete())
                {
                    $flag=0;
                    $prod_meta->rollback();
                    break;
                }else{
                    $flag=1;
                }
            }
        }
        if($flag)
        {
            $prod_meta->commit();
            echo '1';
        }else{
            echo'0';
        }
    }
    public function _gainProductRelation($prod_detail,$info_id){
        //商品规格关系数组
        $prod_size=[];
//        $prod_size['prod_id']=$info_id;
        foreach($prod_detail as $num => $item)
        {
            $prod_temp=[];
            //先拿出默认价格
            if($item['im_pid']==0 && $item['im_key']=='current_price'){
//                $prod_size['default_price']=$item['im_value'];
                unset($prod_detail[$num]);
            }
            //取出子规格，并根据子规格的im_id查找是否有以该im_id作为im_pid的价格（们）
            if($item['im_key']=='product_color')
            {
//                $prod_temp['product_color_id']=$item['im_id'];
//                $prod_temp['product_color']=$item['im_value'];
                $product_color_id=$item['im_id'];
                $product_color=$item['im_value'];
//                var_dump($prod_temp);
                //根据子规格，查询对应价格的pid为该子规格id的键值对（不止一个）,根据此商品的颜色取到商品的价格们
                $price=$this->_findArgs($prod_detail,'im_pid',$item['im_id']);
//                var_dump($price);
                //取到了该关系图中的价格
                foreach($price as $key =>$value)
                {
                    $temp['product_color_id']=$product_color_id;
                    $temp['product_color']=$product_color;
                    $temp['product_price_id']=$value['im_id'];
                    $temp['product_price']=$value['im_value'];
                    $relation=$this->_findArgs($prod_detail,'im_key',$temp['product_price_id']);
                    $temp['product_relation_id']=$relation[0]['im_id'];
                    $product_mainType=$this->_findArgs($prod_detail,'im_id',$relation[0]['im_value']);
                    $temp['product_mainType_id']=$product_mainType[0]['im_id'];
                    $temp['product_mainType']=$product_mainType[0]['im_value'];
                    array_push($prod_temp,$temp);
                }
//                var_export($prod_temp);
                //根据价格的im_id查找是否有以该im_id为im_key的条目，有说明有关联对
                $prod_size=array_merge($prod_size,$prod_temp);
            }
        }
//        var_export($prod_size);
        return $prod_size;
    }

    /**
     * @param $prod_detail  被查找的数组
     * @param $key          需要查找的key
     * @param $value        需要得到的值
     * @param bool $unset   是否删除已判断内容，默认false
     * @return array
     */
    public function _findArgs(&$prod_detail,$key,$value,$unset=false){
        foreach($prod_detail as $num => $item)
        {
            if($item[$key]==$value)
            {
                $temp[]=$item;
                if($unset)unset($prod_detail[$num]);
//                return $item;
            }
        }
        return $temp;
    }
    public function delProduct(){
        $this->display('product/product_del');
    }

}