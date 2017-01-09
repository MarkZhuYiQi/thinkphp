<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/9
 * Time: 21:51
 */

namespace Home\Controller;
use Home\API\UserAPI;
use Think\Controller;

class UploadController extends Controller
{
    protected $config;
    public function __construct()
    {
        parent::__construct();
        $user_info=new UserAPI();
        if($user=$user_info->getUser())
        {
            $user_id=$user->user_id;
        }
        $this->config = array(
            'maxSize'    =>    C('MAXSIZE'),
            'rootPath'   =>    C('UPLOAD_ROOTPATH'),
            'savePath'   =>    C('UPLOAD_SAVEPATH'),
//            'saveName'   =>    array('genFileName',array('__FILE__')),  //调用genFileName(__FILE__)
            'saveName'   =>    array('genFileName',$user_id),  //调用genFileName(__FILE__)
            'exts'       =>    C('UPLOAD_EXTS'),
            'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
        );
    }
    public function upload(){
        $upload = new \Think\Upload($this->config);// 实例化上传类
        // 上传单个文件
        $info   =   $upload->uploadOne($_FILES['upload']);
        if(!$info) {// 上传错误提示错误信息
            echo $this->error($upload->getError());
        }else {
            // 上传成功 获取上传文件信息
            $des_path = '/Public/admin/upload'.$info['savepath'] . $info['savename'];
            //ckeditor的回调方法，包含3个参数第一个是通过上传地址通过get发送的CKEditorFuncNum，第二个是上传成功图片地址，第三个留空。
            echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction('" . $_GET['CKEditorFuncNum'] . "','".$des_path."','')</script>";
        }
    }

}