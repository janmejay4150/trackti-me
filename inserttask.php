<html>
<head>
	<script type = "text/javascript">
		javascript:window.history.forward(1);
	</script>
<?php
	session_start();
	if(!isset($_SESSION['user']))
	header('location:index.php');
else
{
	include("class_lib.php");
	$user= $_SESSION['user'];
	$id= $_SESSION['id'];
	
	$client = $_POST['client'];
	$pid=$_POST['project'];
	$task=addslashes($_POST['task']);
	
	$dt=strtotime($_POST['date']);
	$date=date( 'Y-m-d', $dt);
	
	$start=$_POST['start'];
	$end=$_POST['end'];
	$notes=addslashes($_POST['notes']);
	
	$db= new Database();
	$db->connectdb();
	$table_client = "client_info";
	$para = "cid";
	$where2 = "status = 1 and name='".$client."'";
	
	$result = $db->selectdb($table_client,$para,$where2);
	$cid = $result['cid'];
	
	$table1="tasks";
	$dbinsert=array("pid" =>$pid,"taskname" => $task,"eid"=> $id,"t_date"=> $date,"t_start"=> $start,"t_end"=>$end,'notes'=>$notes,"client" =>$client,"cid"=>$cid);
	$insert=$db->insertdb($table1,$dbinsert);

	if($insert==1)
	{
		$msg1="ok";
		header("location:userhome.php?msg1=".$msg1."&dt=".$date);
	}
	else
	{
		$msg1="err";
		header("location:userhome.php?msg1=".$msg1."&dt=".$date);
	}
	
?>
</head>
<body>

</body>
<?php
}
?>
</html>
