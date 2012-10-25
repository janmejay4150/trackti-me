<html>
<head>
<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
		header('location:index.php');
else
{
	include("class_lib.php");
	$id= $_SESSION['id'];
	
	$tid=base64_decode($_GET['did']);
	
	$db= new Database();
	$db->connectdb();

	$where1="id=".$tid." AND eid=".$id;
	$table1="tasks";
	$parameters1="t_date";
	$select=$db->selectdb($table1,$parameters1,$where1);
	$getdate=$select['t_date']; 

	$where="id=".$tid." AND eid=".$id;
	$table="tasks";
	$status=0;
	$dbinsert=array("status" =>$status);
	$delete=$db->updatedb($table,$dbinsert,$where);
	$pid=$find['pid'];

	if($delete==1)
	{
		$msg3="ok";
		header("location:admintt.php?msg3=".$msg3."&dt=".$getdate);
	}
	else
	{
		$msg3="err";
		header("location:admintt.php?msg3=".$msg3."&dt=".$getdate);	
	}
	
?>
</head>
<body>
asd <?php echo $getdate; print_r($select); echo "<br />ss";?>
</body>
<?php
}
?>
</html>
