<html>
<head></head>
<body>
<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
		header('location:index.php');
	else
	{
		include("class_lib.php");

		$client=$_POST['keyword'];
		$pid=$_POST['pid'];echo $pid;
		$id= $_SESSION['id'];
		
		$db= new Database();
		$db->connectdb();

		$table="client_info";
		$parameters="cid";	
		$where= "status=1 and name='".$client."'";
		$query=$db->selectdb($table,$parameters,$where);
		$cid=$query['cid'];

		$table1="client_project c,projects p,assignments a";
		$parameters1="c.cid cid,p.pid pid,a.eid eid,p.name name";	
		$where1= "c.pid=p.pid and p.pid= a.pid and c.cid = ".$cid." and a.eid=".$id;
		$query1=$db->select_db($table1,$parameters1,$where1);

		$count=$db->countdb($table1,$parameters1,$where1);

		if($count>0)
		{
		
			echo "<option value='#'>Select a Project</option>";
			foreach($query1 as $name)
			{
			echo "<option value=" . $name['pid'];
		                        if($name['pid']==$pid)
		                        {
						echo " selected='selected' ";
		                        }
		                        echo ">" . $name['name'] . "</option>";
			}
		}
		else
		{
			echo "<option value='#'>No Projects for you</option>";
		}
	}

?>
</body>


