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
                $this->actionInfo='$this->assign("errorInfo","login success!");';
                $user_log=new \stdClass();
                $user_log->user_id=$result[0]['user_id'];
                $user_log->user_name=$getUserName;
                setcookie('user_log_info',serialize($user_log),time()+3600,'/');
                $this->actionInfo='header("location:/Home/index");';
            }
            else
            {
                $this->actionInfo='$this->assign("errorInfo","userName or password incorrect!");';
            }
        }
    }
}