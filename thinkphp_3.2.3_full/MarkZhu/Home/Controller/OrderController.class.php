<?php
/**
 * Created by PhpStorm.
 * User: szl4zsy
 * Date: 11/21/2016
 * Time: 2:39 PM
 */

namespace Home\Controller;
use Think\Controller;
use Home\API\UserAPI;

class OrderController extends Controller
{
    function index()
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
        $cart_key='Cart_'.$user_id;
        $get_cart_cache=S($cart_key);
        if($get_cart_cache)
        {
            $sum_price=0;
            $get_cart_cache=json_decode($get_cart_cache,1);
        }

        $order_main=M('order_main');    //实例化主订单
        $order_detail=M('order_detail');    //实例化子订单
        $order_main->startTrans();          //开始事务
        $order_detail->startTrans();
        $detail=array();        //这个数组存放每个商品的信息，每次循环插入下面的变量代表一个商品。
        $detail_data=array();   //这是最后插入子订单的信息
        foreach($get_cart_cache as $key=>$value)
        {
            $sum_price+=$value['price'];
            $detail['product_id']=$value['pid'];
            //C2C这里必须再计算一次，因为缓存里的价格可能已经过期，商家更改了新的价格。
            $detail['product_price']=$value['price'];
            array_push($detail_data,$detail);
        }

        $order_main->order_price=$sum_price;
        $order_main->user_id=$user_id;
        $order_main->order_time=date('Y-m-d H:i:s');
        $order_id=$order_main->add();
        if($order_id && intval($order_id)>0)        //到这里主订单信息已经插入成功，获得主订单order_id
        {
            //这就是订单编号
            $order_no=date('Y').date('m').date('d').date('H').date('i').date('s').$user_id.$order_id;
            foreach($detail_data as &$data)
            {
                $data['order_id']=$order_id;
            }
            $order_detail->addAll($detail_data);
        }else{
            $order_main->rollback();
        }
        //订单号存入主订单信息
        $order_main->order_no=$order_no;
        $update=$order_main->where('order_id='.$order_id)->save();
        //更新成功，提价事务
        if($update===1)
        {
            $order_main->commit();
            $order_detail->commit();

            exit($order_no);
        }else{
            $order_main->rollback();
            $order_detail->rollback();
        }
        exit();
    }
}