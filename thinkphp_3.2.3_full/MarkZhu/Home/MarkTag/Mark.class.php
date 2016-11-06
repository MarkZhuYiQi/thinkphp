<?php
namespace Home\MarkTag;
use Think\Template\TagLib;
class Mark extends TagLib{
    protected $tags=array(
        'test'=>array(),
    );
    public function _test($tag,$content)
    {
        $content=preg_replace('/(.+)?\.class\.php/','ZhuYiQi',$content);
        $str=' <?php ';
        $str.=' echo "这是我自己的功能，试试看！<br />"; ';
        $str.=' echo "'.$content.'";';
        $str.=' ?> ';
        return $str;
    }
}