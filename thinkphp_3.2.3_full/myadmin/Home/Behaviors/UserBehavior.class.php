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
        $user=new UserAPI();
        //判断当前controller 和 action 是否在我们的配置列表里面
        $default_show=C('DEFAULT_SHOW');
        //如果当前页面在我们的配置表中
        if((array_key_exists(strtolower(CONTROLLER_NAME),$default_show) && in_array(strtolower(ACTION_NAME),$default_show[strtolower(CONTROLLER_NAME)])))
        {
            if(!$user->isLogin())
            {
                //   echo "这个页面需要登录";
                //$this->error('这个页面需要登录','/Home/login');
                redirect('/Home/User/login?from='.urlencode(__SELF__), 2, '正在跳转通行证...');
                exit();
            }
        }
        if($user->isLogin()) {
            $this->assign("global_user", $user->getUser());
        }
    }
}