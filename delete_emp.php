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
		$user=$_POST['user'];
		$db_insert = array("status"=>0
		);
		$where = "username = '".$user."'";
		$result = $db->updatedb($table,$db_insert,$where);
		if($result==1)
		{
			$msg2="ok";
			header("location:employees.php?msg2=".$msg2);
		}
		else
		{
			$msg2="err";
			header("location:employees.php?msg2=".$msg2);
		}
		
	}
?>
