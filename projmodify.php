<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
		header('location:index.php');
	else
	{
		include("class_lib.php");

		$pid=$_POST['project'];
		$pname=$_POST['pname'];
		$pdetail=$_POST['pdetails'];

		$db= new Database();
		$db->connectdb();
		

		$table="projects";
		$db_update=array("name"=>$pname,"project_details"=>$pdetail);
		$where="status=1 and pid=".$pid;

		$update=$db->updatedb($table,$db_update,$where);

		if($update==1)
		{
			$msg3="ok";
			header("location:manageprojects.php?msg3=".$msg3);
		}
		else
		{
			$msg3="err";
			header("location:manageprojects.php?msg3=".$msg3);
		}

	}
?>
