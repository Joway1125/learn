<?php

namespace app\admin\controller;

use app\admin\model\Index as IndexModel;
use think\Controller;
use think\Request;

class Index extends Controller
{
	public function index()
	{
        $searchInfo = '';
	    if(!empty(input('post.type'))){
            $searchInfo['type'] = input('post.type');
        }

        if(!empty(input('post.status'))){
            $searchInfo['status'] = input('post.status');
        }

        if(!empty(input('post.addressId'))){
            $searchInfo['addressId'] = input('post.addressId');
        }

        if(!empty(input('post.name'))){
            $searchInfo['name'] = input('post.name');
        }

        if(!empty(input('post.carNum'))){
            $searchInfo['carNum'] = input('post.carNum');
        }

        if(!empty(input('post.start_ts'))){
            $searchInfo =['>',strtotime( input('post.start_ts'))];
        }

        if(!empty(input('post.end_ts'))){
            $searchInfo['end_ts']= ['<',strtotime( input('post.end_ts'))];
        }
        if(!empty($searchInfo)) {
            $cars = IndexModel::search($searchInfo);
            $finalData = IndexModel::totalInterest();
            foreach($cars as $key=>$value){
                foreach($finalData as $v){
                    if($value['id'] == $v['id']){
                        $cars[$key]['totalInterest'] = $v['totalInterest'];
                    } else {
                        $cars[$key]['totalInterest'] = $value['interest_first'];
                    }
                }
            }
            return json($cars);
        } else {
            $cars = IndexModel::indexInfo();
            $finalData = IndexModel::totalInterest();
            foreach ($cars as $key => $value) {
                foreach ($finalData as $v) {
                    if ($value['id'] == $v['id']) {
                        $cars[$key]['totalInterest'] = $v['totalInterest'];
                    } else {
                        $cars[$key]['totalInterest'] = $value['interest_first'];
                    }
                }
            }
            $this->assign('cars',$cars);
            return $this->fetch();
        }
	}

	public function entry(){
	    return view();
    }

    public function dataCount(){
        return view();
    }

    public function entryInfo(){
       $data = input('post.');
       $data['date'] = strtotime($data['date']);
       $data['status'] = 1;
       $data['create_time'] = time();
       $res = IndexModel::entryInfo($data);
        if($res > 0){
            $result = [
                'status' => true,
                'msg' => '录入成功'
            ];

        } else {
            $result = [
                'status' => false,
                'msg' => '录入失败'
            ];
        }
        return json($result);
    }
    //接受图片
    public function imgInfo(){
        $files = request()->file();
        $path = [];
        foreach($files as $key=>$file){
            $url = ROOT_PATH . 'public' . DS . 'upload';
            $info = $file->move($url);
            if($info){
                $path[$key] = 'http://'.$_SERVER['HTTP_HOST'].DS.'upload'.'/'.date('Ymd',time()).'/'.$info->getFilename();
                return json($path);
            } else {
                echo $file->getError();
            }
        }
    }
    //添加利息
    public function interest($id){
        $interestData = IndexModel::interestData($id);
        $this->assign('interestData',$interestData);
        $this->assign('empty','<span class="empty">没有数据</span>');
        $this->assign('id',$id);
        return $this->fetch();
    }
    public function addInterest(){
        $data = input('post.');
        $res = IndexModel::addInterest($data);
        if($res > 0){
            $result = [
                'status' => true,
                'msg' => '添加成功'
            ];

        } else {
            $result = [
                'status' => false,
                'msg' => '添加失败'
            ];
        }
        return json($result);
    }
    //编辑界面
    public function edit($id){
        $data = IndexModel::editCar($id);
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function editInfo(){
        $data = input('post.');
        if($data['status'] != 4){
            $data['statusNote'] = '';
        }
        $data['date'] = strtotime($data['date']);
        $res = IndexModel::updateCar($data);
        if($res > 0){
            $result = [
                'status' => true,
                'msg' => '添加成功'
            ];

        } else {
            $result = [
                'status' => false,
                'msg' => '添加失败'
            ];
        }
        return json($result);
    }
    //查看图片详情
    public function imgData($id){
        $img = IndexModel::imgData($id);
        $imgData = explode(',',$img);
        $this->assign('imgData',$imgData);
        return $this->fetch();
    }
}