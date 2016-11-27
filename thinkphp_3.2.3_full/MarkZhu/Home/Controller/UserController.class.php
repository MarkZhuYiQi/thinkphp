<?php
namespace Home\Controller;
use Think\Controller;
use Home\API\UserAPI;

class UserController extends Controller {
    public function verifyCodeCheck()
    {
        $code=I('post.code');
        $obj=new UserAPI();
        echo $obj->verifyCheck($code);
        exit();
    }
    public function verifyCode()
    {
        $obj=new UserAPI();
        $obj->verifyCode();
    }
    public function reg()
    {
        if($_POST)
        {
            $obj=new UserAPI();
            $obj->reg();
            if($obj->actionInfo!='')
            {
                eval($obj->actionInfo);
            }
        }
        $this->theme('colleague')->display();
    }
    public function login()
    {
        if ($_POST) {
            $obj = new UserAPI();
            $obj->login();
            if ($obj->actionInfo != '') {
                eval($obj->actionInfo);
            }
        }
        $this->theme('colleague')->display('User/login');
        var_export(I('param.verify'));
    }
}

