<?php
include("smarty_config.php");

$sql="select * from phpsq_content where autoid=6";

$connect=mysql_connect("localhost","root","qilu2009soft") or die("�������ݿ�ʧ�ܣ�");

mysql_query("SET NAMES 'gbk'");

$query=mysql_db_query("phpsoftqilu",$sql,$connect) or die("<li>�����ݿ�ʧ�ܣ�");

while($rows=mysql_fetch_array($query))
    {
	$row[]=$rows;
	}
$smarty->assign("row",$row);
$smarty->display("neirong.html"); 

?>
