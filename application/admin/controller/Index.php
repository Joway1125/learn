<?php

namespace app\admin\controller;

use app\admin\model\Index as IndexModel;
use think\Controller;
use think\Db;

class Index extends Controller
{
	public function index()
	{
		return view();
	}

	public function entry(){
	    return view();
    }

    public function dataCount(){
        return view();
    }

    public function entryInfo(){
       //$data = input('post.');
        $res = $this->imgInfo();
        print_r($res);die;
    }
    //接受图片
    public function imgInfo(){
        $data = input('post.');
        $file = request()->file('file');
        $path = ROOT_PATH . 'public' . DS . 'uploadImgs';
        $info = $file->move($path);
        $filename = $info->getFilename();
        $url = $path.DS.$filename;
        $picInfo = [
            'url' => $url,
            'filename' => $filename,
        ];
        $result = IndexModel::entryPic($data,$picInfo);
        return \json($result);
    }
}