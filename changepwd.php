<?php
	session_start();
	if(!isset($_SESSION['user']))
		header('location:index.php');
	else
	{
		include("class_lib.php");
	
		$db= new Database();
		$db->connectdb();
		$id=$_SESSION['id'];
		$user=$_SESSION['user'];

		$currpwd=$_POST['currpwd'];
		$newpwd=$_POST['newpwd'];

		$table="login";
		$parameters="password";
		$where="id=".$id;
		
		$query=$db->selectdb($table,$parameters,$where);
		$result=$query['password'];

		
		if($result==$currpwd)
		{
			$table1="login";
			$update1=array("password"=>$newpwd);
			$where1="username='".$user."'";

			$result1=$db->updatedb($table1,$update1,$where1);

			if($result1==1)
			{
				$msg1="ok";
				header("location:change.php?msg1=".$msg1);
			}
			else
			{
				$msg1="nah";
				header("location:change.php?msg1=".$msg1);
			}
		}
		else
		{
			$msg1="no";
			header("location:change.php?msg1=".$msg1);
		}

	}
?>
