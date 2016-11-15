<?php
namespace Home\Controller;
use Home\API\InfoAPI;
use Think\Controller;

class InfoController extends Controller {
    public $detail_data='';
    public function index(){
        $get_info_type=I('get.type',1,'/\d+$/');    //默认新闻
        $info=new InfoAPI($get_info_type);
        $info->loadData();
        $this->detail_data=$info->_detail_data;
        $this->assign('info_data_main',$info->_main_data);
        $this->assign('info_data_detail',$info->_detail_data);
        $this->assign('page_bar',$info->page_bar);
        $this->theme('colleague')->display();
    }
    /**
     * 第一种获取子查询数据的方法,不推荐
     * 该方法是用公共方法R来调用的，R方法允许跨模块跨类调用类方法，需要2个参数，第一个是类/方法：例如Info/getDetail
     * 第二个参数是传入的参数，用数组传递。
     * 注意在模板调用的时候，传入参数如果是数组键值，那么一定要使用$info['info_id'],$info.info_id只能用于显示，传值出错。
     *
     *
     **/
//    public function getDetail($info_id,$detail_data)
//    {
//        $ret=array();
//        foreach($detail_data as $detail)
//        {
//            if($detail['info_id']==$info_id)
//            {
//                $ret[$detail['im_key']]=$detail['im_value'];
//            }
//        }
//        return $ret;
//    }
}

