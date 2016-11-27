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
            $ph=new PasswordHash(8,true);
            $check=$ph->CheckPassword($getPassword,$result[0]['user_pwd']);
            if ($check)
            {
                $user_log = new \stdClass();
                $user_log->user_id = $result[0]['user_id'];
                $user_log->user_name = $result[0]['user_name'];
                $user_log->ip = getIP();
                $user_log->flag = think_encrypt('loginFlag', C('FLAG_KEY'));
                $cookieString = think_encrypt(serialize($user_log),C('ENCRYPT_KEY'));
                $flag=setcookie('user_log_info', $cookieString, time()+3600, '/');
                if (I('get.from'))
                {
                    $this->actionInfo = 'header("location:' . I('get.from') . '");';
                }
                else
                {
                    $this->actionInfo = 'header("location:/Home/Index");';
                }
            }
            else
            {
                $this->actionInfo='$this->error="Error! user name mismatch with password!";';
            }
        }
    }
    public function getUser()
    {
        if($getCookie=$_COOKIE['user_log_info'])
        {
            $getCookie=think_decrypt($getCookie,C('ENCRYPT_KEY'));
            $get_user_login=unserialize($getCookie);
            if(!$get_user_login)return false;
            $get_user_login->flag=think_decrypt($get_user_login->flag,C('FLAG_KEY'));
            if($get_user_login->user_id&&intval($get_user_login->user_id)>0&&(getIP()==$get_user_login->ip) && ($get_user_login->flag=='loginFlag'))
            {
                return $get_user_login;
            }
        }
        return false;
    }
    public function isLogin()
    {
        $u=$this->getUser();
        if($u->user_id && intval($u->user_id)>0)
        {
            return true;
        }
        return false;
    }
    public function reg()
    {
        $getUserName=I('post.userName','/\w{3,20}$/');
        $getPassword=I('post.password','/\w{3,20}$/');
        $getConfirm=I('post.passwordConfirm','/\w{3,20}$/');
        $getRole=I('post.role','/[A-Za-z]{3,20}/');
        if($getUserName=='' || $getPassword=='' || $getConfirm=='' || $getRole=='' || $getPassword=='')
        {
            $this->actionInfo='$this->assign("errorInfo","Error!please fulfill the information!");';
        }
        else
        {
            $ph=new PasswordHash(8,true);
            //获取admin_users数据表对象
            $user=M('users');
            $roles=M('roles');
            $user_role=M('user_role');
            try{
                $user->user_name=$getUserName;
                $user->user_pwd=$ph->HashPassword($getPassword);
                $user->startTrans();
                $user_id=$user->add();
                if($user_id)
                {
                    $roleData=$roles->where(' role_name="'.strtolower($getRole).'"')->select();
                    $user_role->user_id=$user_id;
                    $user_role->role_id=$roleData[0]['role_id'];
                    $user_role_id=$user_role->add();
                    if($user_role_id)
                    {
                        $user->commit();
                        $roles->commit();
                        //成功注册，跳转到登陆页面
                        $this->actionInfo='header("location:/Home/user/login");';
                    }
                    else
                    {
                        $user->rollback();
                        $user_role->rollBack();
                        $this->actionInfo='$this->assign("errorInfo","角色插入失败");';
                    }
                }
                else
                {
                    $user->rollback();
                    $this->actionInfo='$this->assign("errorInfo","用户插入失败");';
                }
            }
            catch(\Think\Exception $ex)
            {
                var_export($ex->getMessage());
                $user->rollback();
                $user_role->rollback();
                $this->actionInfo='$this->assign("errorInfo","用户名被占用");';
                return;
            }
        }
    }

}