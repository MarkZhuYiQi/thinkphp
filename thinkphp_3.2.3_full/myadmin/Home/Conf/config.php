<?php
return array(
    //'配置项'=>'配置值'
    'DEFAULT_FILTER'        => 'strip_tags,htmlspecialchars',
    // 'TMPL_ENGINE_TYPE' =>'PHP',
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '7777777y', // 密码
    'DB_PREFIX' => 'admin_', // 数据库表前缀
    'DB_DSN'    => 'mysql:host=localhost;dbname=tp;charset=utf8'
,'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=>array(
        'login' =>'User/login',
        'reg' =>'User/reg',
    ),
    'LOAD_EXT_CONFIG'=>'c_login',
    'ENCRYPT_KEY'           =>          'MarkZhuSetCookie',  //cookie设置时使用的加密钥匙.
    'FLAG_KEY'              =>          'CookieFlagString',     //cookie标志位

);