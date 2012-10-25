<?php
	session_start();
	include("class_lib.php");
		
	$uname = $_POST['uname'];
	$pwd = $_POST['password'];
	//$_SESSION['user']=$uname;
	//setcookie("user",$uname,time()+86400*7);

	//print_r($_POST);

	unset($_SESSION['adminuser']);
	unset($_SESSION['user']);
	unset($_SESSION['id']);

	$login="login";
	$id="*";
	$cond="username='".$uname."'";
	$db= new Database();
	$db->connectdb();

	$uid=$db->selectdb($login,$id,$cond);
	//print_r($uid['0']);
	//echo $uid;
	$_SESSION['id']=$uid['0'];
	$_SESSION['email']=$uid['email'];

	if ($db->logincheck($uname,$pwd))

	{
		if($uid['type']=='e')
		{		
			$_SESSION['user']=$uname;
			header("location:userdash.php");
		}
		else if($uid['type']=='a')
		{
			$_SESSION['adminuser']=$uname;
			header("location:admindash.php");
		}
		else
		{
			$_SESSION['guest']=$uname;
			header("location:guesthome.php");
		}
	}
	else
	{
		$msg="err";
		session_destroy();			
		header("location:index.php?msg=".$msg);
	}

?>
