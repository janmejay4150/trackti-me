<html>
<head>
<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
	header('location:index.php');
else
{
	include("class_lib.php");
	$user= $_SESSION['adminuser'];
	$id= $_SESSION['id'];

	$client=$_POST['client'];	
	$pid=$_POST['project'];
	$task=addslashes($_POST['task']);
	
	$dt=strtotime($_POST['date']);
	$date=date( 'Y-m-d', $dt);
	
	$start=$_POST['start'];
	$end=$_POST['end'];
	$notes=addslashes($_POST['notes']);
	
	$db= new Database();
	$db->connectdb();

	$table1="tasks";
	$dbinsert=array("pid" =>$pid,"taskname" => $task,"eid"=> $id,"t_date"=> $date,"t_start"=> $start,"t_end"=>$end,'notes'=>$notes,"client"=>$client);
	$insert=$db->insertdb($table1,$dbinsert);

	if($insert==1)
	{
		$msg1="ok";
		header("location:admintt.php?msg1=".$msg1."&dt=".$date);
	}
	else
	{
		$msg1="err";
		header("location:admintt.php?msg1=".$msg1."&dt=".$date);
	}
	
?>
</head>
<body>

</body>
<?php
}
?>
</html>
