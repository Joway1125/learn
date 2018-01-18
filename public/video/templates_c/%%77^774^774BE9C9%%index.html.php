<?php /* Smarty version 2.6.26, created on 2017-12-29 04:40:25
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<link type="text/css" rel="stylesheet" href="css/main.css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/layer/layer.js"></script>
<title>上传视频、预览、生成缩略图</title>

<style type="text/css">
	.file{ width:78px; height:26px; position:relative; display:inline-block; background:#eb6100; border:1px solid #eb6100; font-size:12px; overflow:hidden; color:#fff; text-decoration:none; text-indent:0; line-height:26px; }
	.file input{ position:absolute; font-size:12px; right:0; top:0; opacity:0; }
	.file:hover{ background:#eb6100; border-color:#eb6100; color:#fff; text-decoration:none; }
	video::-webkit-media-controls-fullscreen-button{ display:none; }<!-- 预览视频去除全屏按钮 -->
</style>
<script type="text/javascript">
$(function(){
	//发布
	$('.sub').live('click',function(){
		var frm = $('.frm');
		var file = $('input[name=file]').val();
		var img = $('input[name=img]').val();
		if(img!=''){
			frm.submit();
		}else{
			alert('请在视频上传2s后点击发布，请再次点击');
		}
	});
	
	//预览
	$(".yulan").click(function(){
		var files = $('input[name=video]').prop('files'),
			videoURL = null,
			windowURL = window.URL || window.webkitURL;
		if(files && files[0]){
			videoURL = windowURL.createObjectURL(files[0]);
			
			layer.open({
				type:1,
				title:'视频预览',
				area:['800px','500px'],
				content:'<video src="'+videoURL+'" controls="controls" autoplay="autoplay" style="margin-top:10px;margin-left:14px;"></video>'
			});
		}
	});
	
	//生成缩略图
	$('input[name=video]').change(function(){
		var obj = $(this);
		var files = this.files,
			videoURL = null,
			windowURL = window.URL || window.webkitURL;
		if(files && files[0]){
			videoURL = windowURL.createObjectURL(files[0]);
			$('.video_area').html('<video id="myvideo" src="'+videoURL+'" controls="controls" autoplay="autoplay"></video>');
			
			//截取视频2s时的画面作为缩略图
			setTimeout(function(){
				createIMG(obj);
				//获取视频时长秒数(向下取整)
				var time = Math.floor($("#myvideo")[0].duration);
				$('.time_long').val(time);
			}, 2000);
		}
	});
})
var createIMG = function(obj){
	var scale = 0.3,
		video = $('.video_area').find('video')[0],
		canvas = document.createElement("canvas"),
		canvasFill = canvas.getContext('2d');
	canvas.width = video.videoWidth * scale;
	canvas.height = video.videoHeight * scale;
	canvasFill.drawImage(video,0,0,canvas.width,canvas.height);
	
	var src = canvas.toDataURL("image/jpeg");                   
	$('.img_area').val(src);
	$('.img_show').html('<img src="'+src+'" style="width:100px;height:80px;" />');
}
</script>
</head>
<body>
<div class="main">
	<div class="contentdiv" >
		<div class="rightbody">
			<div class="rightwhite">
				<div class="rightcont">
					<div class="rightcontent">
						<div class="rightcontentdiv">
							<table border="0" cellpadding="0" cellspacing="0" class="rightconttable">
								<tr class="tabletitle">
									<td>上传</td><td>视频预览</td><td>缩略图</td><td>视频时长</td><td>编辑</td>
								</tr>

								<tr class="tablelist">
									<form class="frm" action="" method="post" enctype="multipart/form-data">
										<td>
											<a href="javascript:;" class="file" style="margin-left:-2px;">上传视频<input type="file" name="video" /></a>
											<div class="video_area" style="display:none;"></div>
											<input type="hidden" class="img_area" name="img" />
											<input type="hidden" class="time_long" name="time_long" />
										</td>
										<td><a href="javascript:;" class="yulan"><img src="images/playbtn.png" /></a></td>
										<td class="img_show"></td>
										<td><input type="text" class="time_long" value="0" readonly style="width:60px;border:0;" /> 秒</td>
										<td><input value="发布" type="button" class="publishbtn sub" /></td>
									</form>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>