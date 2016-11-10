<?php
/**
 * Created by PhpStorm.
 * User: szl4zsy
 * Date: 11/10/2016
 * Time: 9:49 AM
 */
namespace Home\Behaviors;
use Think\Controller;
use Home\API\UserAPI;
class UserBehavior extends Controller
{
    public function run(&$params)
    {
        $user=new userAPI();
        $get_need_login=C('need_login');    //获取需要登录的配置值,这里也要判断
        $this->UserName='';
        if(array_key_exists(CONTROLLER_NAME,$get_need_login) && in_array(ACTION_NAME,$get_need_login))
        {
            if(!$user->isLogin())
            {
                //tp自带跳转1,很low很难看 必须等待
//            $this->error('请登录后再执行操作！','/Home/login');
                redirect('/Home/login?from='.urlencode(__SELF__),1,'转到登录页面...');
                exit();
            }
            else
            {
                $this->userName=unserialize($_COOKIE['user_log_info'])->user_name;
            }

        }
        else
        {

        }
    }

}