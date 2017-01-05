<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {
    public function index(){
        $info=M('markzhu_info');
        $product=$info->where('info_type=2')->limit(100)->select();
        var_export($product);
        $this->display('product/product_info');
    }
    public function addProduct(){
        $this->display('product/product_add');
    }
    public function updateProduct(){
        $this->display('product/product_update');
    }
    public function delProduct(){
        $this->display('product/product_del');
    }

}