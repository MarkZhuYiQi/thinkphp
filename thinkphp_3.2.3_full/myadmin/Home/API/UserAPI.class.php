<?php
/**
 * Created by PhpStorm.
 * User: szl4zsy
 * Date: 11/25/2016
 * Time: 4:42 PM
 */

namespace Home\API;
use Think\Controller;
use Home\Lib\PasswordHash;

class UserAPI extends Controller
{
    public $actionInfo='';
    /**
     * 登录流程：
     * 获得用户名和密码，正则匹配。判断用户名和密码是否符合规范。
     * 符合规范则去数据库根据用户名取出所有信息。根据加密字符串，和传过来的密码进行比对。
     * 如果符合用对象将相关信息包装起来，然后进行对称加密。
     * 然后返回到登录前的那个页面，如果有from就去from页面，没有就去index。
     */
    public function login()
    {
        $getUserName = I('post.userName', '/\w{3,20}$/');
        $getPassword = I('post.password', '/\w{3,20}$/');
        if ($getUserName == '' || $getPassword == '') {
            $this->actionInfo='$this->error="Error!Please input your user name and password";';
        } else {
            $result = M('users')->where(' user_name ="' . $getUserName.'"')->limit(1)->select();
            $check = $getPassword == $result[0]['user_pwd'] ? true : false;
//            $ph=new PasswordHash(8,true);
//            $check=$ph->CheckPassword($getPassword,$result[0]['user_pwd']);
            if ($check) {
                $user_log = new \stdClass();
                $user_log->user_id = $result[0]['user_id'];
                $user_log->user_name = $result[0]['user_name'];
                $user_log->ip = getIP();
                $user_log->flag = think_encrypt('loginFlag', C('FLAG_KEY'));
                $cookieString = think_encrypt(serialize($user_log));
                setcookie('user_log_info', $cookieString, 21600, '/');
                if (I('get.from')) {
                    $this->actionInfo = 'header("location:' . I('get.from') . '");';
                } else {
                    $this->actionInfo = 'header("location:/Home/Index");';
                }
            }
            else
            {
                $this->actionInfo='$this->error="Error! user name mismatch with password!";';
            }
        }
    }
    public function isLogin()
    {
        if($getCookie=$_COOKIE['user_log_info'])
        {
            $getCookie=think_decrypt($getCookie,'FLAG_KEY');
            $get_user_login=unserialize($getCookie);
            if(!$get_user_login)return false;
            $get_user_login->flag=think_decrypt($get_user_login->flag,C);
        }
        return false;
    }
    public function getUser()
    {

    }
    public function reg()
    {
        $getUserName=I('post.userName','/\w{3,20}$/');
        $getPassword=I('post.password','/\w{3,20}$/');
        $getConfirm=I('post.passwordConfirm','/\w{3,20}$/');
        $getRole=I('post.role','/[A-Za-z]{3,20}/');
        if($getUserName=='' || $getPassword=='' || $getConfirm=='' || $getRole=='' || $getPassword==)
        {
            $this->actionInfo='$this->assign("errorInfo","Error!please fulfill the information!");';
        }
        else
        {
            $ph=new PasswordHash(8,true);
            $user=D('users');
            try{
                $user->userName=$getUserName;
                $user->userPassword=$ph->HashPassword($getPassword);
                $user->role=
                $user->startTrans();
                $user->add();
            }catch(\Think\Exception $ex)
            {

            }

        }
    }

}