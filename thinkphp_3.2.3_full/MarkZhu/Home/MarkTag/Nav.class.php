<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/6
 * Time: 15:06
 */
    namespace Home\MarkTag;
    use Think\Template\TagLib;
    class Nav extends TagLib{
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        protected $tags=array(
            'load'=>array(attr=>'',close=>0),

        );

        /**
         * @param $tags     标签属性
         * @param $content  标签内容
         * @return string
         */
        function _load($tags,$content)
        {
            $str=' <?php ';
            $str.='  $navbar=M("nav");  ';
            $str.='  $nav=$navbar->where(" nav_isShow = 1 ")->order("nav_index")->select();  ';
            $str.=' foreach($nav as $item) ';
            $str.=' { ';
            $str.=' echo "<li><a href=".$item["nav_href"].">".$item["nav_title"]."</a></li>"; ';
            $str.=' } ';
            $str.=' ?> ';

            return $str;
        }
    }