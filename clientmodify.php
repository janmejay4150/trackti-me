<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
		header('location:index.php');
	else
	{
		include("class_lib.php");

		$cid=$_POST['client']; 
		$name=$_POST['cname']; echo $name; echo "<br />";
		$address=$_POST['caddress']; echo $address; echo "<br />";
		$city=$_POST['city']; echo $city; echo "<br />";
		$state=$_POST['state']; echo $state; echo "<br />";
		$postalcode=$_POST['postcode']; echo $postalcode; echo "<br />";
		$phone=$_POST['cph']; echo $phone; echo "<br />";
		$fax=$_POST['fax']; echo $fax; echo "<br />";
		$email=$_POST['cmail']; echo $email; echo "<br />";
		$website=$_POST['cwsite']; echo $website; echo "<br />";

		$db= new Database();
		$db->connectdb();
		

		$table="client_info";
		$db_update=array("name"=>$name,"address"=>$address,"city"=>$city,"state"=>$state,"postal_code"=>$postalcode,"phone"=>$phone,"fax"=>$fax,"email"=>$email,"website"=>$website);
		$where="status=1 and cid=".$cid;

		$update=$db->updatedb($table,$db_update,$where);

		if($update==1)
		{
			$msg4="ok";
			header("location:manageprojects.php?msg4=".$msg4);
		}
		else
		{
			$msg4="err";
			header("location:manageprojects.php?msg4=".$msg4);
		}

	}
?>
