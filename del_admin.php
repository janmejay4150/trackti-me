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
		$type="e";
		$db_insert = array("type"=>$type
		);
		$where = "username = '".$user."'";
		$result = $db->updatedb($table,$db_insert,$where);
		if($result==1)
		{
			$msg4="ok";
			header("location:employees.php?msg4=".$msg4);
		}
		else
		{
			$msg4="err";
			header("location:employees.php?msg4=".$msg4);
		}
		
	}
?>
