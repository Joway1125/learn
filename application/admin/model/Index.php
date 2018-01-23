<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/23 0023
 * Time: 14:13
 */

namespace app\admin\model;


use think\Db;
use think\Model;

class Index extends Model
{
    public static function entryPic($data,$picInfo){
        $resId = Db::table('pic')->insertGetId($picInfo);
        if($data['token'] == 0){
            $res['redeemPicId'] = $resId;
        } else if ($data['token'] == 1){
            $res['sellPicId'] = $resId;
        } else if($data['token'] == 2){
            $res['borrowPicId'] = $resId;
        } else if($data['token'] == 3){
            $res['otherPicId'] = $resId;
        } else if($data['token'] == 4){
            $res['appearancePicId'] = $resId;
        } else if($data['token'] == 5){
            $res['contracPicId'] = $resId;
        }
        return $res;
    }
}