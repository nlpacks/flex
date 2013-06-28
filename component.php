<?php


	$con=mysql_connect("192.168.80.89", "root", "cellonmysql!@#");
	mysql_query("SET NAMES UTF8");
	mysql_query("SET CHARACTER SET UTF8");
	mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
	mysql_select_db("flexdb", $con);
	
	$result=mysql_query("SELECT distinct component FROM flexitems where state=1 and filekey='b1be86bd940b0823ff3cb83050bd3515'  ");
	$data = array();
	
	while($row = mysql_fetch_array($result))
	{
		$data [] = $row;
	}

//	mysql_free_result($result);
	echo  json_encode($data) ;
?>
