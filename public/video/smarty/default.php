<?php
include("smarty_config.php");

$sql="select * from phpsq_content where autoid=6";

$connect=mysql_connect("localhost","root","qilu2009soft") or die("Á´½ÓÊý¾Ý¿âÊ§°Ü£¡");

mysql_query("SET NAMES 'gbk'");

$query=mysql_db_query("phpsoftqilu",$sql,$connect) or die("<li>¶ÁÊý¾Ý¿âÊ§°Ü£¡");

while($rows=mysql_fetch_array($query))
    {
	$row[]=$rows;
	}
$smarty->assign("row",$row);
$smarty->display("neirong.html"); 

?>
