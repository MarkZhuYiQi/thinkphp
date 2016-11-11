<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/6
 * Time: 21:51
 */

namespace Home\Behaviors;
use Think\Controller;
use Home\Behaviors\BaseBehavior;
//class NavBehavior extends \Think\Behavior{
class NavBehavior extends BaseBehavior {
    //行为执行入口
    public function run(&$param){
        $navbar=M('nav');          //不用自定义模型，直接使用数据模型
        $ret=$navbar->where(' nav_isShow = 1 ')->order('nav_index')->select();
        $this->assign("nav",$ret);
    }
}