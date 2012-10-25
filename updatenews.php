<html>
<head>
	
<?php
	session_start();
	if(!isset($_SESSION['user']))
	header('location:index.php');
else
{
	include("class_lib.php");
	$id= $_SESSION['id'];
	
	
	$ndetails=$_POST['ndetails'];
	$title=$_POST['title'];
	$date=$_POST['date'];
	$slno=$_POST['slno'];
	
	$db= new Database();
	$db->connectdb();

	$where1="slno=".$slno;	
	$table1="news";
	$dbinsert=array("slno" =>$slno,"title" => $title,"news_detail"=> $ndetails);
	$update=$db->updatedb($table1,$dbinsert,$where1);

	if($update==1)
	{
		$msg2="ok";
		header("location:uploadnews.php?msgedit=".$msg2."&dt=".$date);
	}
	else
	{
		$msg2="err";
		header("location:uploadnews.php?msgedit=".$msg2."&dt=".$date);
	}
	
?>
</head>
<body>

</body>
<?php
}
?>
</html>
