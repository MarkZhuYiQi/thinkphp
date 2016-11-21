<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/24
 * Time: 15:07
 */
namespace Home\Behaviors;
use Home\API\Base;
use Home\API\UserAPI;
use Think\Controller;

class UserBehavior extends BaseBehavior{
    //行为执行入口
    public function run(&$param){
        // $this->assign("name","shenyi");
      //setcookie("userin",null,time()-3600,"/");
        $user=new UserAPI();
        //判断当前controller 和 action 是否在我们的配置列表里面
        $get_login_config=C("need_login");//获取 需要的登录的配置节

       if(array_key_exists(CONTROLLER_NAME,$get_login_config) &&
           in_array(ACTION_NAME,$get_login_config[CONTROLLER_NAME]) && !$user->isLogin() )
       {
             //   echo "这个页面需要登录";
               //$this->error('这个页面需要登录','/Home/login');
           redirect('/Home/login?from='.urlencode(__SELF__), 2, '正在跳转通行证...');
           exit();
       }


         if($user->isLogin() )
         {

             $this->assign("global_user",$user->getUser());
         }


    }
}