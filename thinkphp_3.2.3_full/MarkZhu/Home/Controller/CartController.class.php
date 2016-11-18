<?php
/**
 * Created by PhpStorm.
 * User: red
 * Date: 11/18/16
 * Time: 10:12 AM
 */

namespace Home\Controller;
use Think\Controller;
use Home\API\UserAPI;

class CartController extends Controller
{
    public function add_cart()
    {
        $cart=S(array(
            'type'=>'Memcache',
            'host'=>'127.0.0.1',
            'port'=>'11211',
            'expire'=>600
        ));

        $user_id=0;
        $user_api=new UserAPI();
        $get_user=$user_api->getUser();
        if($get_user)
        {
            $user_id=$get_user->user_id;
        }
        else
        {
            exit('-1');
        }
        $pmeta=I('post.pmeta','','/(\d+_)+$/');
        $pid=I('post.pid',0,'/\d+$/');
        if($pid>0 && $pmeta != '')
        {
            exit('ok');
        }else
        {
            exit('提交数据不符合规范');
        }

    }
}