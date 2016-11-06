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