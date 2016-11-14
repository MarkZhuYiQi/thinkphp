<?php
namespace Home\Controller;
use Think\Controller;
use Home\API\UserAPI;
class TempController extends Controller {
    public function test()
    {
        $info=M();
        $info->table('markzhu_info a')->join(' markzhu_info_meta b on a.info_id=b.info_id ',' left ')
            ->where('a.info_type=1')->order('a.info_id')->select();
        echo $info->getLastSql();
//        $this->theme('colleague')->display('temp/test');
    }
}

