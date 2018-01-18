<?php
	header ( "content-type:text/html;charset=utf-8" );
	include_once "smarty/Smarty.class.php";
	$smarty = new Smarty ();
	$smarty->left_delimiter = "<{";
	$smarty->right_delimiter = "}>";
	
	if($_POST){
		// print_r($_FILES);
		// print_r($_POST);exit;
		
		//保存图片
		if($_POST['img']!=''){
			$img_base = $_POST['img'];
			$img_base = str_replace('data:image/jpeg;base64,', '', $img_base);
			$path = 'upload/cover/';
			$img_name = time().rand(1000,9999).'.jpg';
			$img_path = $path.$img_name;
			file_put_contents($img_path,base64_decode($img_base));
		}
		
		//上传视频文件
		if($_FILES['video']['name']!=''){
			move_uploaded_file($_FILES["video"]["tmp_name"],iconv("utf-8","gb2312","upload/video/".$_FILES["video"]["name"]));
		}
		
		header("Location:index.php");
	}
	
	$smarty->display('index.html');
?>