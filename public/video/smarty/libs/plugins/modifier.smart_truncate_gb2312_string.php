 <?php   
function smarty_modifier_smart_truncate_gb2312_string($string,$length,$etc='...'){
	$result='';
	$string=html_entity_decode(trim(strip_tags($string)),ENT_QUOTES,'GB2312');
	$strlen=strlen($string);
	
	for($i=0;(($i<$strlen)&&($length>0));$i++){
		if(ord(substr($string,$i,1))>128){
			if($length<1.0){
				break;
			}
			
			$result.=substr($string,$i,2);
			$length-=1.0;
			$i++;
			
		}else{
			$result.=substr($string,$i,1);
			$length-=0.5;
		}
	}
	
	$result=htmlspecialchars($result,ENT_QUOTES,'GB2312');
	
	if($i<$strlen){
		$result.=$etc;
	}
	
	return $result;
}
?>