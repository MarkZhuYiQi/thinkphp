<?php
namespace Home\Controller;
use Think\Controller;
use Home\API\UserAPI;
class UserController extends Controller {
    public function reg()
    {
        $user=D('user');
        $user->user_name='lilii';
        $user->user_pwd='4567';
        $user->user_regdate=date('Y-m-d H:i:s');
        $user->add();
        /*$data=array();
        $data['user_name']='zhangsan';
        $data['user_pwd']='123456';
        $data['user_regdate']=date('Y-m-d H:i:s');
        if(intval($user->add($data)>0))     //代表新增
        {

        }
        */

        $this->theme('colleague')->display();
    }
    public function login(){
        if($_POST)
        {
            $obj=new UserAPI();
            $obj->login();
            if($obj->actionInfo!='')
            {
                eval($obj->actionInfo);
            }
        }
        $this->theme('colleague')->display('User/login');
    }
}

