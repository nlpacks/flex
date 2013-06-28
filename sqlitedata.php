<?php

	$data = array();

	if ( ! empty($_POST['path']))
	  $selectpath=$_POST['path'];
	else
	{
	  echo json_encode($data);
	  return;
	}

	$selecttable=$_POST['table'];

	//$selectpath='/home/roger/documents/flex/flex/pro10/flex/customconfig';
	//$selecttable='setting';

	$db= new SQLite3($selectpath);

	$fields = array();
	$result=$db->query("SELECT * FROM sqlite_master where name ='$selecttable'" );
	
	while($row = $result->fetchArray())
	{
	   $tablesql=$row['sql'];
           $tablesql=substr($tablesql,strpos($tablesql,"(")+1); 
           $tablesql=substr($tablesql,0,strpos($tablesql,")")); 	
	   $fieldsarray = explode(",",$tablesql);
	   foreach ( $fieldsarray as $element )
	   {
		$tmparray=explode(" ",trim($element));		
		$fieldsname=strtolower($tmparray[0]);
		if (isset($tmparray[1]))
		   $fieldstype=$tmparray[1];
		else //table sqlite_sequence hasn't sql filed in sqlite_master
		   $fieldstype="TEXT";
		$fields[$fieldsname] = $fieldstype;
	   }
	}
	$result->finalize();


	$result=$db->query("SELECT * FROM $selecttable order by _id ");
	while($row = $result->fetchArray())
	{
	   $data['data'][]=$row;		
	}



	$cols=$result->numColumns();

	for ($i=0; $i<$cols; $i++)
	{
	   $colname=strtolower($result->columnName($i));
	   $data['fields'][]=$colname;
	   $width="50";

	   if (strcasecmp($fields[$colname],"INTEGER") == 0 )
		$width = "50";
	   else if (strcasecmp($fields[$colname], "TEXT") == 0)
		$width = "250";
	   $data['columns'][]="{ text: '".$colname."',dataIndex: '".$colname."', width: ".$width." }";
	}
	$result->finalize();

	$db->close();
	echo  json_encode($data) ;


?> 
