<?php
namespace Home\Controller;
use Think\Controller;
use Home\API\UserAPI;
class UserController extends Controller {
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

