<?php
function get_navbar()
{
    $navbar=M('nav');          //不用自定义模型，直接使用数据模型
    $ret=$navbar->where(' nav_isShow = 1 ')->order('nav_index')->select();
    return $ret;
}
function get_cache()
{

}

/**
 * 跳转地址安全防护
 * @param $url
 */
function gotoUrl($url)
{
    //允许localhost www.baidu.com跳转
    $url=trim($url);
    if(preg_match("/^http/i",$url))
    {
        if(preg_match("/^http:\/\/(localhost)|(www\.baidu\.com)/i",$url))
        {
            redirect($url);
        }
        else
        {
            redirect("/Home/index");
        }
    }
    else
    {
        redirect($url);
    }
}