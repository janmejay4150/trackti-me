<!DOCTYPE html>
<html lang="en">
	<head>
		<?php
			session_start();
			if(!isset($_SESSION['adminuser']))
				header('location:index.php');
			else
			{
				include("class_lib.php");
	
	
	$slno=$_GET['slno'];
	
	$db= new Database();
	$db->connectdb();

	$where1="slno=".$slno;
	$table="news";
	
	$dbinsert=array("status" =>0);
	$delete=$db->updatedb($table,$dbinsert,$where1);
	

	if($delete==1)
	{
		$msgdel="ok";
		header("location:uploadnews.php?msgdel=$msgdel");
	}
	else
	{
		$msgdel="err";
		header("location:uploadnews.php?msgdel=$msgdel");	
	}
	
?>
</head>
<body>

</body>
<?php
}
?>
</html>
