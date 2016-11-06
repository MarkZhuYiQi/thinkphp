<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/6
 * Time: 14:08
 */

namespace Home\Widget;
use Think\Controller;
class NavWidget extends Controller {
    public function def(){
        $navbar=M('nav');          //不用自定义模型，直接使用数据模型
        $ret=$navbar->where(' nav_isShow = 1 ')->order('nav_index')->select();
        return $ret;
    }
}