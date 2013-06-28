<?php

	$data = array();
	if ( ! empty($_POST['path']))
	  $selectpath=$_POST['path'];
	else
	{
	  echo json_encode($data);
	  return;
	}

	$db= new SQLite3($selectpath);
	// $db->open();

	//get all tables
//	$result=$db->query("SELECT name,sql FROM sqlite_master where name not like 'sqlite_%' and name not like 'osw_%' order by name ");
	$result=$db->query("SELECT name FROM sqlite_master where name not like 'sqlite_%' order by name ");
	while($row = $result->fetchArray())
	{
		$table_name=$row["name"];
		$data[] = $table_name;
		
	}
	$db->close();
	echo  json_encode($data) ;
?> 
