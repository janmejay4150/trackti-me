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
		$id= $_SESSION['id'];
		
		$db= new Database();
		$db->connectdb();

		$table="client_info";
		$parameters="cid";	
		$where= "status=1 and name='".$client."'";
		$query=$db->selectdb($table,$parameters,$where);
		$cid=$query['cid'];

		$table1= "projects p, client_project c";
		$parameters1="p.name";
		$where1="c.pid=p.pid AND c.cid=".$cid;
		$query1=$db->select_db($table1,$parameters1,$where1);

				
		echo "<option value='#'>Select a Project</option>";
		foreach($query1 as $name)
		{
		echo "<option value='" . $name['name'] . "'>" . $name['name'] . "</option>";
		}
		
			
	}

?>
</body>


