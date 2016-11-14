<?php
namespace Home\Controller;
use Think\Controller;
use Home\API\UserAPI;
class TempController extends Controller {
    public function test()
    {
        /*$info=M();
        $ret=$info->table('markzhu_info a')->join(' markzhu_info_meta b on a.info_id=b.info_id ',' left ')
            ->where('a.info_type=1')->order('a.info_id')
            ->field('a.info_id,a.info_title,b.info_id,b.im_key,b.im_value')->select();
        echo $info->getLastSql();
        exit();*/
        $m=M('info');
        $count=$m->where('info_type=1')->count();

        $Page = new \Think\Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数(25)

        $Page->setConfig('next','下一页');
        $show = $Page->show();// 分页显示输出
        $info_data=$m->where('info_type=1')->order('info_date desc ')->limit($Page->firstRow.','.$Page->listRows)->select();
//        var_export($info_data);
        $info_id_set='';
        foreach($info_data as $key => $value)
        {
            if($info_id_set!='')$info_id_set.=',';
            $info_id_set.=$value['info_id'];
        }
        $info_data_meta=M('info_meta')->where('info_id in('.$info_id_set.')')->order('info_id DESC')->select();
        var_export($info_data_meta);

        echo $show;
//        $this->theme('colleague')->display('temp/test');
    }
}

