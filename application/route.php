<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('index','admin/Index/index');
Route::post('index','admin/Index/index');
Route::get('entry','admin/Index/entry');
Route::get('dataCount','admin/Index/dataCount');
Route::post('entryInfo','admin/Index/entryInfo');
Route::post('imgInfo','admin/Index/imgInfo');
Route::get('interest/:id','admin/Index/interest');
Route::post('addInterest','admin/Index/addInterest');
Route::get('edit/:id','admin/Index/edit');
Route::post('editInfo','admin/Index/editInfo');
Route::get('imgData/:id','admin/Index/imgData');
