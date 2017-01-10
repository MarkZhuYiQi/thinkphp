<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/9
 * Time: 21:14
 */

namespace Home\API;
use Home\API\UserAPI;
use Home\API\ImageAPI;
use Think\Controller;



class UploadAPI extends Controller
{
    protected $config;
    protected $info_id;
    public function __construct()
    {
        parent::__construct();
        $user_info=new UserAPI();
        if($user=$user_info->getUser())
        {
            $user_id=$user->user_id;
        }
        $this->info_id=I('get.info_id','-1');
        $this->config = array(
            'maxSize'    =>    C('MAXSIZE'),
            'rootPath'   =>    C('UPLOAD_ROOTPATH'),
            'savePath'   =>    C('UPLOAD_SAVEPATH'),
            'saveName'   =>    array('genFileName',$user_id),  //调用genFileName(__FILE__)，保存的名字
            'exts'       =>    C('UPLOAD_EXTS'),
            'autoSub'    =>    true,
            'subName'    =>    I('get.info_id','-1'),     //子文件夹目录
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
            $Image=new ImageAPI();
            $Image->zoom_image($des_path,$info['savename'],720);
            $info_meta=M('markzhu_info_meta');
            $data['info_id']=$this->info_id;
            $data['im_key']='prod_content_img';
            $data['im_value']=$des_path;
            $info_meta->data($data)->add();
            //ckeditor的回调方法，包含3个参数第一个是通过上传地址通过get发送的CKEditorFuncNum，第二个是上传成功图片地址，第三个留空。
            echo "<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction('" . $_GET['CKEditorFuncNum'] . "','".$des_path."','')</script>";
        }
    }
}