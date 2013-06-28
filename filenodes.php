<?php

 if ( ! empty($_POST['path']))
   $selectpath=$_POST['path'];
 else
   $selectpath='/home/roger/documents/flex/flex';

 $files = array();

 if ($handle = opendir($selectpath))
 {
    while (false !== ($file = readdir($handle))) 
    {
       if ($file != "." && $file != "..")
       {
	  unset($curr);
          $curr=array();

          $curr['path'] = $selectpath.'/'.$file;
          $curr['text'] = $file;
	  clearstatcache(true);
          if ( true === is_dir( $selectpath.'/'.$file ))
          {   
		$curr['leaf'] = false;
		$curr['expandable'] = true;		
		$curr['loaded'] = false;
          }
          else
          {
             $curr['leaf'] = true; 
	     $curr['expandable'] = false;
  	     $curr['loaded'] = true;
	   }
	  $curr['expanded']=false;
          $files[]=$curr;
       }
    }
 }
 sort($files);

 echo json_encode($files);

?>
