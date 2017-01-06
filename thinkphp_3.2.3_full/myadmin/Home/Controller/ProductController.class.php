<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {
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
    public function updateProduct(){
        $info_id=I('get.info_id','0','/^\d{1,20}$/');
        $prod=M('markzhu_info')->where('info_id='.$info_id)->select();
        $this->assign('prod',$prod[0]);
        $prod_detail=M('markzhu_info_meta')->where('info_id='.$info_id)->select();
        $prod_size=[];
        $prod_size['prod_id']=$info_id;
        foreach($prod_detail as $item)
        {
            if($item['im_key']=='product')
            {
                $prod_size['prod_size']=$item['im_value'];

            }
        }




        $this->display('product/product_update');
    }
    public function delProduct(){
        $this->display('product/product_del');
    }

}