<?php
/**
 * Created by PhpStorm.
 * User: szl4zsy
 * Date: 11/10/2016
 * Time: 9:49 AM
 */
namespace Home\Behaviors;
use Home\Behaviors\BaseBehavior;
use Home\API\UserAPI;
class UserBehavior extends BaseBehavior
{
    public function run(&$params)
    {
        $user=new userAPI();
        $get_need_login=C('need_login');    //获取需要登录的配置值,这里也要判断
        $this->UserName='';
        if(array_key_exists(CONTROLLER_NAME,$get_need_login) && in_array(ACTION_NAME,$get_need_login) && !$user->isLogin()) {
            //tp自带跳转1,很low很难看 必须等待
//            $this->error('请登录后再执行操作！','/Home/login');
            redirect('/Home/login?from=' . urlencode(__SELF__), 1, '转到登录页面...');
            exit();
        }
        //修改：这里必须分开判断，因为有些页面不需要登录也可以访问，如果也放在上面那么这些页面即使登陆了，也会显示登录 注册，所以必须分开判断
        //如果登录了就直接显示用户信息。
        if($user->isLogin())
        {
            $this->assign('global_user',$user->getUser()->user_name);
//                $this->userName=unserialize($_COOKIE['user_log_info'])->user_name;
        }
    }

}