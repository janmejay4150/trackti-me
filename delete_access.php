<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
	header('location:index.php');
	else
	{
		include("class_lib.php");
	
		$db= new Database();
		$db->connectdb();
		$table="login";
		$client=$_POST['client'];
		$db_insert = array("status"=>0);
		$where = "username = '".$client."'";
		$result = $db->updatedb($table,$db_insert,$where);
		if($result==1)
		{
			$msg6="ok";
			header("location:employees.php?msg6=".$msg6);
		}
		else
		{
			$msg6="err";
			header("location:employees.php?msg6=".$msg6);
		}
		
	}
?>
