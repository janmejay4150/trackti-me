<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
		header('location:index.php');
	else
	{
		include("class_lib.php");
		
		$db= new Database();
		$db->connectdb();
		
		$table = "emp_status_report";
		
		$eid = $_POST['uid'];
		$cid = $_POST['cid'];
		
		
		
		if(isset($_POST['uid']))
		{
			$parameters = "distinct cid,client";
			if($_POST['uid'] > 0)
			{
				$where = "eid=$eid";
				$name = $db->select_db($table,$parameters,$where);
				echo "<option value = 0>Choose Client</option>";
			}
			else
			{
				$name = $db->select_db($table,$parameters);
				echo "<option value = 0>All Clients</option>";
			}
			foreach($name as $var)
			{
				echo "<option value='" . $var['cid'] . "'>" . $var['client'] . "</option>";
			}		   	
		}
		
		if(isset($_POST['cid']))
		{
			$parameters = "distinct pid,project";
			if($_POST['cid']>0)
			{
				$where = "cid=$cid";
				$name = $db->select_db($table,$parameters,$where);
				echo "<option value = 0>Choose Project</option>";
			}
			else
			{
				$name = $db->select_db($table,$parameters);
				echo "<option value = 0>All Projects</option>";
			}			
			foreach($name as $var)
				{
					echo "<option value='" . $var['pid'] . "'>" . $var['project'] . "</option>";
				}
		}
	}
				
?>
