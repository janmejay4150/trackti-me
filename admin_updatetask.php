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
	
	$pid=$_POST['project'];
	$task=addslashes($_POST['task']);
	$client=$_POST['client'];
	
	$dt=strtotime($_POST['date']);
	$date=date( 'Y-m-d', $dt);
	
	$start=$_POST['start'];
	$end=$_POST['end'];
	$notes=addslashes($_POST['notes']);

	$tid=$_POST['taskid'];
	
	$db= new Database();
	$db->connectdb();

	$where1="id=".$tid;	
	$table1="tasks";
	$dbinsert=array("pid" =>$pid,"taskname" => $task,"eid"=> $id,"t_date"=> $date,"t_start"=> $start,"t_end"=>$end,"notes"=>$notes,"client"=>$client);
	$update=$db->updatedb($table1,$dbinsert,$where1);
	
	if($update==1)
	{
		$msg2="ok";
		header("location:admintt.php?msg2=".$msg2."&dt=".$date);
	}
	else
	{
		$msg2="err";
		header("location:admintt.php?msg2=".$msg2."&dt=".$date);
	}
	
?>
</head>
<body>

</body>
<?php
}
?>
</html>
