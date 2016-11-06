<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/6
 * Time: 9:55
 */

namespace Home\Model;
use Think\Model;
class UserModel extends Model {
    protected $tableName='users';
//    protected $trueTableName='';  //这个会忽略前缀
    function showName()
    {
        echo 'mark';
    }
}