<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/7
 * Time: 16:21
 */
namespace Home\Behaviors;
use Think\Controller;
class BaseBehavior extends Controller
{
   function __construct()
   {
       parent::__construct();
        $get_do=trim(I("get.do"));
        if($get_do!="")
        {
           method_exists($this,$get_do) && $this->$get_do();



        }
   }
    function logout()
    {
        //注销，过期COOKIE

        setcookie("userin",null,time()-3600,"/");
        redirect('/Home/index', 2, '注销成功...');
        exit();
    }
}
