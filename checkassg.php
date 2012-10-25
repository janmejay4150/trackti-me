<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
	header('location:index.php');
	else
	{
		include("class_lib.php");
	
		$db= new Database();
		$db->connectdb();

		$project=$_POST['project'];
		$usernames=$_POST['users'];
		
		$userid = explode(",", $usernames);
		$id= array_unique ($userid);

		$table1="projects";
		$parameters1="pid";
		$cond1="name='".$project."'";
			
		$getpid=$db->selectdb($table1,$parameters1,$cond1);
		$pid=$getpid['pid'];

		$i=count($id)-1;

		$table2="assignments";
		$parameters2="*";

		$caught = array();
		$uncaught = array();
		
		while($i>=0)
		{
			$cond2="eid=".$id[$i]." and pid=".$pid;
			$result=$db->countdb($table2,$parameters2,$cond2);
			if($result==1)
				array_push($caught, $id[$i]);
			else
				array_push($uncaught, $id[$i]);
			$i=$i-1;	
		}

		if(count($uncaught)==0)
		{
			$msg4="ok";
			header("location:projects.php?msg4=".$msg4);
		}
		else
		{

			$table="assignments";

			foreach($uncaught as $inr)
				$db_insert[]=array("pid" =>$pid,"eid" => $inr);
			foreach($db_insert as $dbinsert)	
			{
				$insert=$db->insertdb($table,$dbinsert);
				$check=1;
			}
	
			if($check==1)
			{
				$msg3="ok";
				header("location:projects.php?msg3=".$msg3);
			}
			else
			{
				$msg3="err";
				header("location:projects.php?msg3=".$msg3);
			}
		}
	}
?>

		
