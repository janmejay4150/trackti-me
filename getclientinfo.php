<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
		header('location:index.php');
	else
	{
		include("class_lib.php");
		
		$cid=$_POST['keyword'];
		
		$db= new Database();
		$db->connectdb();

		$table="client_info";
		$parameters="name,address,city,state,postal_code,phone,fax,email,website";	
		$where= "status=1 and cid=".$cid;
		$query=$db->selectdb($table,$parameters,$where);
		$pid=$query['pid'];

		echo $query['name']."`".$query['address']."`".$query['city']."`".$query['state']."`".$query['postal_code']."`".$query['phone']."`".$query['fax']."`".$query['email']."`".$query['website'];
	}

?>
