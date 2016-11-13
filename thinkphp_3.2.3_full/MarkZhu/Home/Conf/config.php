<?php
return array(
	//'配置项'=>'配置值'
    'DEFAULT_FILTER'        =>          'strip_tags,htmlspecialchars',
//    'TMPL_ENGINE_TYPE'      =>          'PHP'   //关闭thinkphp的模板引擎
    'DB_TYPE'               =>          'mysql',
    'DB_USER'               =>          'root',
    'DB_PWD'                =>          '7777777y',
    'DB_PREFIX'             =>          'MarkZhu_', //数据库表前缀
    'DB_DSN'                =>          'mysql:host=127.0.0.1;dbname=tp;charset=utf8',
    'URL_ROUTER_ON'         =>          true,
    'URL_ROUTE_RULES'       =>          array(
        'login'=>'User/login',
        'reg'=>'User/reg'
    ),
    'LOAD_EXT_CONFIG'       =>          'c_login',     //读取自定义的配置文件必须写这么一个参数！

    'useImgBg'              =>          true,
    'useCurve'              =>          true,
    'useNoise'              =>          true,
    'length'                =>          5,

);