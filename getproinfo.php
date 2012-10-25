<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
		header('location:index.php');
	else
	{
		include("class_lib.php");
		
		$pid=$_POST['keyword'];
		
		$db= new Database();
		$db->connectdb();

		$table="projects";
		$parameters="name,project_details";	
		$where= "status=1 and pid=".$pid;
		$query=$db->selectdb($table,$parameters,$where);
		$pid=$query['pid'];

		echo $query['name']."`".$query['project_details'];
	}

?>
