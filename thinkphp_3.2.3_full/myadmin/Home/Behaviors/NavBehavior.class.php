<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/24
 * Time: 15:07
 */
namespace Home\Behaviors;
use Think\Controller;

class NavBehavior extends BaseBehavior{
    //行为执行入口
    public function run(&$param){
       // $this->assign("name","shenyi");
        $navbar=M("navbar");
        $ret=$navbar->where("nav_isshow=1")->order("nav_index")->select();
        $this->assign("navbar",$ret);

    }
}