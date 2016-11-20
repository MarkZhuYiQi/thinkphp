<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/9
 * Time: 21:48
 */

namespace Home\API;
use Home\Lib\PasswordHash;
use Think\Verify;
class UserAPI
{
    public $actionInfo='';
    public function verifyCheck($code,$id='')
    {
        $verify=new Verify();
        return $verify->check($code,$id);
    }
    public function verifyCode()
    {
        $verify=new Verify();
        $verify->fontSize = 28;
        $verify->length   = 3;
        $verify->useNoise = false;
        $verify->useImgBg = false;
        $verify->entry();
    }

    public function reg()
    {
        $getUserName=I('post.user_name','','/\w{3,20}$/');
        $getPassword=I('post.user_pass','','/\w{3,20}$/');
        if($getUserName==''||$getPassword=='')
        {
            $this->actionInfo='$this->assign("errorInfo","Error!userName or Password format is incorrect!");';
        }
        else
        {
            $ph=new PasswordHash(8,true);
            $user=D('user');
            try{
                $user->user_name=$getUserName;
                $user->user_pwd=$ph->HashPassword($getPassword);
                $user->startTrans();        //开启事物
                $user_id=$user->add();

                if($user_id)
                {
                    $muser=M('users_meta');
                    $muser->user_id=$user_id;
                    $muser->meta_key='reg_date';
                    $muser->meta_value=date('Y-m-d H:i:s');
                    $ret=$muser->add();
                    if($ret)
                    {
                        $user->commit();
                        $this->actionInfo='header("location:/Home/login");'; //跳转到登陆页面
                        return;
                    }
                    else
                    {
                        $user->rollback();
                        $this->actionInfo='$this->assign("errorInfo","属性表插入失败");';
                        return;
                    }
                }
                else
                {
                    $this->actionInfo='$this->assign("errorInfo","用户主表插入失败");';
                    return;
                }
            }catch(\Think\Exception $ex){
//                $ex->getMessage();
                $user->rollback();
                $this->actionInfo='$this->assign("errorInfo","用户名被占用");';
                return;
            }
        }
    }


    /**
     * 获取当前用户信息对象。
     * @return bool|mixed|string
     */
    public function getUser()
    {
        $getCookie=$_COOKIE['user_log_info'];
        if(!$getCookie)return false;
        $get_user_login=think_decrypt($getCookie,C('ENCRYPT_KEY'));
        $get_user_login=unserialize($get_user_login);
        if(!$get_user_login)return false;
        $get_user_login->flag=think_decrypt($get_user_login->flag,C('FLAG_KEY'));
        if($get_user_login->user_id && intval($get_user_login->user_id)>0 && (getIP()==$get_user_login->ip) && ($get_user_login->flag=='loginFlag'))
        {
            return $get_user_login;
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
    public function login(){
        $getUserName=I('post.userName','','/\w{3,20}$/');
        $getPassword=I('post.password','','/\w{3,20}$/');
        if($getUserName==''||$getPassword=='')
        {
            $this->actionInfo='$this->assign("errorInfo","Error!userName or Password format is incorrect!");';
        }
        else
        {
            $result=M('users')->where(' user_name =  "'.$getUserName.'"')->limit(1)->select();
            $ph=new PasswordHash(8,true);
            $check=$ph->CheckPassword($getPassword,$result[0]['user_pwd']);
            if($check)
            {
//                $this->actionInfo='$this->assign("errorInfo","login success!");';
                $user_log=new \stdClass();
                $user_log->user_id=$result[0]['user_id'];
                $user_log->user_name=$getUserName;
                $user_log->ip=getIP();
                $user_log->flag=think_encrypt('loginFlag',C('FLAG_KEY'));
                $cookieString=serialize($user_log);
                $cookieString=think_encrypt($cookieString,C('ENCRYPT_KEY'));
                setcookie('user_log_info',$cookieString,time()+21600,'/');    //cookie过期时间为6小时
                if(I('get.from')!='')
                {
                    gotoUrl(I('get.from'));
                    //注意！！安全防护重点对象！！
                    $this->actionInfo='header("location:'.I("get.from").'");';
                }
                else
                {
                    $this->actionInfo='header("location:/Home/index");';        //默认跳转首页
                }
            }
            else
            {
                $this->actionInfo='$this->assign("errorInfo","userName or password incorrect!");';
            }
        }
    }
}