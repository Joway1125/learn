<?php

namespace app\admin\controller;

use think\Controller;

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
        $data = input('post.');
        print_r($data);die;
    }
    //接受图片
    public function imgInfo(){
        $file = request()->file('file');
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploadImgs');
    }
}