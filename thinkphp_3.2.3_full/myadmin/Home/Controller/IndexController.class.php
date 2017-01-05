<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public $items='';       //全局存放一个数组集合
    public $menu='';

    public function index(){
        $this->display();
    }
}