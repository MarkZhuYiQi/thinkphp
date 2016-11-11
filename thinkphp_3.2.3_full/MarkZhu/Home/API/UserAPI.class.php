<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/9
 * Time: 21:48
 */

namespace Home\API;


class UserAPI
{
    public $actionInfo='';

    //获取当前用户信息对象。
    public function getUser()
    {
        $getCookie=$_COOKIE['user_log_info'];
        if(!$getCookie)return false;
        $get_user_login=unserialize($getCookie);
        if(!$get_user_login)return false;
        if($get_user_login->user_id && intval($get_user_login->user_id)>0)
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
            if($result[0]['user_pwd']==md5($getPassword))
            {
//                $this->actionInfo='$this->assign("errorInfo","login success!");';
                $user_log=new \stdClass();
                $user_log->user_id=$result[0]['user_id'];
                $user_log->user_name=$getUserName;
                setcookie('user_log_info',serialize($user_log),time()+10,'/');    //cookie过期时间为1小时
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