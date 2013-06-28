<?php

	$itemid=$_POST['id'];
	$filekey='';
	if ( $itemid == 21 )
		$filekey='Q8145SA_ICON';

	if ( $itemid == 22 )
		$filekey='Q8145SA_IQ';

	if ( $itemid == 23 )
		$filekey='Q8150SA';

	$con=mysql_connect("192.168.80.89", "root", "cellonmysql!@#");
	mysql_query("SET NAMES UTF8");
	mysql_query("SET CHARACTER SET UTF8");
	mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
	mysql_select_db("flexdb", $con);
	
	$result=mysql_query("SELECT id,component,instructions,options,optiondefault,odmtype,description FROM flexitems where state=1 and projectname='$filekey' ");
	$data = array();
	
	while($row = mysql_fetch_array($result))
	{
		$data [] = $row;
	}
	// 释放资源
	mysql_free_result($result);
	echo  json_encode($data) ;
?>
