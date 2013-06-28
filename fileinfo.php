<?php

 $files = array();
 if ( ! empty($_POST['path']))
   $selectpath=$_POST['path'];
 else
 {
   echo json_encode($files);
   return;
 }

 //return subfiles name, size, lastmodify
 if ($handle = opendir($selectpath))
 {
    while (false !== ($file = readdir($handle))) 
    {
       if ($file != "." && $file != "..")
       {
	  unset($curr);
          $curr=array();

	  clearstatcache(true);
          $curr['name'] = $file;
          if ( true === is_dir( $selectpath.'/'.$file ))
          {   
		$curr['size'] = '';
          }
          else
          {
             $curr['size'] = filesize($selectpath.'/'.$file); 
	   }
	  $curr['lastmodify']=date("Y-m-d H:i:s",filectime($selectpath.'/'.$file));
          $files[]=$curr;
       }
    }
 }
 sort($files);

 echo json_encode($files);


?> 
