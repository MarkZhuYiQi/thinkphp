<?php
/**
 * Created by PhpStorm.
 * User: szl4zsy
 * Date: 11/11/2016
 * Time: 10:13 AM
 */

namespace Home\Behaviors;
use Think\Controller;
class BaseBehavior extends Controller
{
    function __construct()
    {
        parent::__construct();   //执行controller的构造函数，不影响功能
        //修改：这里傻了，不需要获取所有方法然后判断这个方法在里面，直接可以用method_exists判断这个方法是否存在当前类中。
//        if(isset($_GET['do']) && in_array($_GET['do'],get_class_methods(__CLASS__)))
        $get_do=I('get.do');
        if($get_do && method_exists($this,I('get.do')))
        {
            $this->$get_do();
        }

    }
    function logout()
    {
        setcookie('user_log_info','',time()-3600,'/');    //cookie过期时间为1小时
        redirect('/Home/index',1,'正在注销...');
        exit();
    }
}