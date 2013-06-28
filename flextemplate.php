<?php


	$con=mysql_connect("192.168.80.89", "root", "cellonmysql!@#");
	mysql_query("SET NAMES UTF8");
	mysql_query("SET CHARACTER SET UTF8");
	mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
	mysql_select_db("flexdb", $con);
	
	$result=mysql_query("SELECT id,filename,whoupload as uploader,uploadtime,description FROM uploadfiles ");
	$data = array();
	
	while($row = mysql_fetch_array($result))
	{
		$data [] = $row;
	}
	// 释放资源
	mysql_free_result($result);
	echo  json_encode($data) ;
?>
