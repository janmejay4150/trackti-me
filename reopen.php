<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
		header('location:index.php');
	else
	{
		include("class_lib.php");
		
		$pid=$_POST['project'];

		$db= new Database();
		$db->connectdb();
		
		$status=1;

		$table="projects";
		$db_update=array("status"=>$status);
		$where="pid=".$pid;

		$update=$db->updatedb($table,$db_update,$where);

		if($update==1)
		{
			$msg2="ok";
			header("location:manageprojects.php?msg2=".$msg2);
		}
		else
		{
			$msg2="err";
			header("location:manageprojects.php?msg2=".$msg2);
		}

	}
?>
