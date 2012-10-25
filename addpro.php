<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
		header('location:index.php');
	else
	{
		include("class_lib.php");
	
		$db= new Database();
		$db->connectdb();
	
		$cid = $_POST['clientdetail'];
		$project=$_POST['project'];
		$projdetail = $_POST['pdetails'];
		$cname = $_POST['cname'];
		$caddr = $_POST['caddress'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$pcode = $_POST['postcode'];
		$phone = $_POST['cph'];
		$fax = $_POST['fax'];
		$cmail = $_POST['cmail'];
		$website = $_POST['wsite'];

		$i=0;
		$j=0;
		$k=0;

       if($cid==0)
       {
            //echo "@1";   OR 
			$check=$db->selectdb("client_info","cid","phone='$phone'"); 
			$check1=$db->selectdb("client_info","cid","email='$cmail'");
			$check2=$db->selectdb("client_info","cid","name='$cname'");
	
			if($check2[0] > 0)  
			{
				echo "@2"; 
				$msg5="err";
				header("location:projects.php?msg5=".$msg5);
				die();
		    	}
			else if($check1[0] > 0)  
			{
				echo "@2"; 
				$msg6="err";
				header("location:projects.php?msg5=".$msg6);
				die();
		    	}
			else if($check[0] > 0)  
			{
				echo "@2"; 
				$msg7="err";
				header("location:projects.php?msg7=".$msg7);
				die();
		    	}
		    	else
		        { 
				echo "@3"; 
		    		$table1="client_info";
				$dbinsert1=array("name"=>$cname,"address"=>$caddr,"city"=>$city,"state"=>$state,"postal_code"=>$pcode,"phone"=>$phone,"fax"=>$fax,"email"=>$cmail,"website"=>$website); 
				$insert1 = $db->insertdb($table1,$dbinsert1);
				$i=$i+1;
				
				//$where2 = "phone = $phone AND status = 1";
				$where2 = "status=1 ORDER BY cid DESC LIMIT 1";
				$parameters2 = "cid";
				$selectcid = $db->selectdb($table1,$parameters2,$where2);
			}
		}
		else
		{
			echo "@4";
			$selectcid=array();
			$selectcid['cid']=$cid;    
			
		}
		
		echo "@5";
		
 
		$table="projects";
		$dbinsert=array("name" =>$project,"project_details"=>$projdetail);
				
		$insert=$db->insertdb($table,$dbinsert);
		$j=$j+1;
		$where1 = "name = '$project' AND status = 1";
	
		$parameters1 = "pid";
					
		$selectpid = $db->selectdb($table,$parameters1,$where1);
	
		$table3 =  "client_project";
		$parameters3 = array("pid" => $selectpid['pid'],"cid" => $selectcid['cid']);
		$ins_clntproj = $db->insertdb($table3,$parameters3);
		$k=$k+1;

		if($i==0)
		{	
			if($j==1 && $k==1)
			{
				$msg2="ok";
				header("location:projects.php?msg2=".$msg2);
			}
			else
			{
				$msg2="err";
				header("location:projects.php?msg2=".$msg2);
			}
		}
		else
		{
			if($j==1 && $k==1 && $i==1)
			{
				$msg2="ok";
				header("location:projects.php?msg2=".$msg2);
			}
			else
			{
				$msg2="err";
				header("location:projects.php?msg2=".$msg2);
			}
		}
	}

?>
