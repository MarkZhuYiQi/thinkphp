<?php
/**
 * Created by PhpStorm.
 * User: SZL4ZSY
 * Date: 1/10/2017
 * Time: 9:18 AM
 */

namespace Home\API;
use Think\Image;

class ImageAPI
{
    public function zoom_image($originImgPath,$orginImgName,$width=null,$height=null,$water=null,$mark='water'){
        $image=new Image();
        $image->open('.'.$originImgPath);
        $imgWidth=$image->width();
        $imgHeight=$image->height();
        //是否做了缩放标记
        $do=false;
        //缩放尺寸
        //如果设置了宽度没有设置高度，则是根据宽度缩放图片
        if($width && !$height)
        {
            //原始图片宽度大于限制宽度
            if($imgWidth>$width){
                $image->thumb($width,$imgHeight,Image::IMAGE_THUMB_SCALE);
                $do=true;
            }
        }elseif(!$width && $height){
            if($imgHeight>$height)
            {
                $image->thumb($imgWidth,$height,Image::IMAGE_THUMB_SCALE);
                $do=true;
            }
        }elseif($width && $height)
        {
            if($imgHeight > $height || $imgWidth > $width)
            {
                $image->thumb($width,$height,Image::IMAGE_THUMB_SCALE);
                $do=true;
            }
        }
        if($do)
        {
            $image->save('.'.$originImgPath);
        }
        return;
    }
}