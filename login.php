<?php
function __autoload($class_name)
{
	require_once $class_name . '.php';
}
try 
{
	session_start();
	$passwd=$_POST["password"];
	$user=$_POST["username"];
	
	
	$ldap=new ldap('192.168.10.20',389);

	$isvalidate= $ldap->validate($user."@cellon.com",$passwd);
	if (strcmp($isvalidate , "ok")==0)
	{
	/*		
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');	
		$extra = "main.php";
		header("Location: http://$host$uri/$extra");
	*/
		echo '{ "success": true, "msg": "login successfully" }';
	}
	else
	{
		echo '{ "failure": true, "msg": " username and password not match !" }';
	}
}
catch (Exception $e)
{
	//echo $e->getMessage();
	//echo "<br><a href=\"#\" onclick=\"javascript:history.go(-1)\">back</a>";
	echo '{ "failure": true, "msg": "'. $e->getMessage().'" }';
}

?>
