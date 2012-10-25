<?php
	session_start();
	if(!isset($_SESSION['user']))
	header('location:index.php');
	else
	{
		include("class_lib.php");
	
		$db= new Database();
		$db->connectdb();
		$cname = $_POST['name'];
		echo $cname;
	}
		
		
?>

