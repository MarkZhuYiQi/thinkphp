<?php
/**
 * Created by PhpStorm.
 * User: szl4zsy
 * Date: 11/15/2016
 * Time: 4:34 PM
 */

namespace Home\Widget;
use Think\Controller;

class InfoWidget extends Controller
{
    public function load($id)
    {
        //id先判断
        $get_widget_conf=M('info_widget')->where(' widget_id='.$id)->limit(1)->select();
        if($get_widget_conf && count($get_widget_conf)==1)
        {
            $get_widget_conf=$get_widget_conf[0];
            $m=M();
            eval('$get_widget_data=$m->'.$get_widget_conf['widget_model'].';');
            //加载widget模板的方法
            $this->assign('w_title',$get_widget_conf['widget_title']);
            $this->assign('w_data',$get_widget_data);
            $this->theme('colleague')->display($get_widget_conf['widget_tpl']);
        }



    }
}