<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
	header('location:index.php');
	else
	{
		include("class_lib.php");
	
		$db= new Database();
		$db->connectdb();

		$user=$_POST['user'];
		$type="a";
		
		$table = "login";
		$update = array("type"=>$type);
		$where = "username = '".$user."'";
		$result = $db->updatedb($table,$update,$where);

		if($result==1)
		{
			$msg="ok";
			header("location:employees.php?msg3=".$msg);
		}
		else
		{
			$msg="err";
			header("location:employees.php?msg3=".$msg);
		}
		
	}
?>
	
