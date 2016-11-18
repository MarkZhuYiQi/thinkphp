<?php
/**
 * Created by PhpStorm.
 * User: red
 * Date: 11/18/16
 * Time: 10:12 AM
 */

namespace Home\Controller;
use Think\Controller;

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
        $cart->name='mark';
        $value=$cart->name;
        echo 'value:'.$value;
    }
}