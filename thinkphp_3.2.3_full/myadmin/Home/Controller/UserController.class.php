<?php
/**
 * Created by PhpStorm.
 * User: szl4zsy
 * Date: 11/25/2016
 * Time: 3:07 PM
 */

namespace Home\Controller;
use Home\API\UserAPI;
use Think\Controller;


class UserController extends Controller
{
    public function login()
    {
        if($_POST)
        {
            $obj=new UserAPI();
            $obj->login();
            if($obj->actionInfo)
            {
                eval($obj->actionInfo);
            }
        }
        $this->display('user/login');
    }
    public function reg()
    {
        $this->display('User/reg');
    }
}
