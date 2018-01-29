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
    //车辆录入
    public static function entryInfo($data){
        $resId = Db::table('carinfo')->insert($data);
        return $resId;
    }
    public static function indexInfo(){
        $data = Db::table('address')
            ->alias('a')
            ->join('carinfo b','a.id = b.addressId ')
            ->select();
        foreach($data as $key=>$value){
            $data[$key]['create_time'] = date("Y-m-d ", $value['create_time']);
        }
        return $data;
    }
    //添加利息
    public static function addInterest($data){
        $arr = Db::table('interest')->where('carId',$data['id'])->find();
        $newData = [];
        foreach($data['addInterest'] as $key=>$v){
            $newData[$key]['interestValue'] = $v;
            $newData[$key]['create_time'] = date('Y-m-d',time());
        }
        if(count($arr) > 0){
            $newInterest = json_decode($arr['interest'],true);
            $finalInterest = json_encode(array_merge($newInterest,$newData));
           $res = Db::table('interest')->where('id',$arr['id'])->update(['interest'=>$finalInterest]);
        } else{
            $interestInfo['interest'] = json_encode($newData);
            $interestInfo['carId'] = $data['id'];
            $res = Db::table('interest')->insert($interestInfo);
        }
        return $res;
    }
    //利息信息
    public static function interestData($id){
        $data = Db::table('interest')->where('carId',$id)->find();
        $interestData = json_decode($data['interest'],true);
        return $interestData;
    }
    //累计利息
    public static function totalInterest(){
        $data = Db::table('interest')
            ->alias('a')
            ->join('carinfo b','a.carId = b.id ')
            ->field('b.id,b.interest_first,a.interest')
            ->select();
        foreach($data as $key=>$value){
            $newInterest[$key]['interest'] = json_decode($value['interest'],true);
            $newInterest[$key]['id'] = $value['id'];
            $newInterest[$key]['interest_first'] = $value['interest_first'];
        }
        foreach($newInterest as $k=>$v){
            $finalData[$k]['id'] = $v['id'];
            $total = 0;
            foreach($v['interest'] as $vv){
                $total += $vv['interestValue'];
            }
            $finalData[$k]['totalInterest'] = $total+$v['interest_first'];
        }
        return $finalData;
    }
    //编辑数据
    public static function editCar($id){
        $data= Db::table('carInfo')->where('id',$id)->find();
        $data['date'] = date('Y-m-d',$data['date']);
        return $data;
    }
    public static function updateCar($data){
        $result = Db::table('carInfo')->where('id',$data['id'])->update($data);
        return $result;
    }
    //查看图片信息
    public static function imgData($id){
        $img = Db::table('carinfo')->where('id',$id)->value('img');
        return $img;
    }

    //查询
    public static function search($data){
        $result = Db::table('address')
            ->alias('a')
            ->join('carinfo b','a.id = b.addressId ')
            ->where($data)
            ->select();
        foreach($result as $key=>$value){
            $result[$key]['create_time'] = date("Y-m-d ", $value['create_time']);
        }
        return $result;
    }
}