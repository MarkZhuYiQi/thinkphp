<?php
/**
 * Created by PhpStorm.
 * User: szl4zsy
 * Date: 11/15/2016
 * Time: 9:45 AM
 */

namespace Home\API;


class InfoAPI
{
    public $_info_type=1;   //默认是1，代表新闻，2是商品
    public $_page_size=4;   //每页显示数量
    public $page_bar='';     //分页组件展现的内容
    public $_main_data=array(); //主表数据
    public $_detail_data=array();
    function __construct($infoType,$pageSize=4)
    {
        $this->_info_type=$infoType;
        $this->_page_size=$pageSize;
    }

    function loadData($where_main='',$where_detail='')    //加载主表数据
    {
        if($where_main!='')
        {
            $where_main=$where_main.' and info_type='.$this->_info_type;
        }
        else
        {
            $where_main='info_type='.$this->_info_type;
        }
        $info_count=M('info')->where($where_main)->count();
        $p=new \Think\Page($info_count,$this->_page_size);
        $p->setConfig('next','下一页');
        $p->setConfig('prev','上一页');
        $this->page_bar=$p->show();     //分页内容样式
        $this->_main_data=M('info')->order('info_id desc ')
            ->where($where_main)->limit($p->firstRow.','.$p->listRows)->select();    //主表数据
        //以下是当前页项目的id拼凑
        $info_id_set='';
        foreach($this->_main_data as $key => $value)
        {
            if($info_id_set!='')$info_id_set.=',';
            $info_id_set.=$value['info_id'];
        }
        if($info_id_set!='')            //取出子表数据
        {
            if($where_detail!='')
            {
                $where_detail=' and '.$where_detail;
            }
            $this->_detail_data=M('info_meta')->where('info_id in('.$info_id_set.')'.$where_detail)->order('info_id desc')->select();
        }
    }

    /**
     * 加载子查询。
     * @param $info_id
     * @param $detail_data
     * @return array
     */
    function loadDetail($info_id,$detail_data)
    {
        $ret=array();
        foreach($detail_data as $detail)
        {
            if($detail['info_id']==$info_id)
            {
                $ret[$detail['im_key']]=$detail['im_value'];
            }
        }
        return $ret;
    }
}