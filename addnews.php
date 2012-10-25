	<?php
	include("class_lib.php");
			$db= new Database();
			$db->connectdb();
			$title=$_POST['title'];
			
			$ndetails=$_POST['ndetails'];
			$date=date('y-m-d');
			$dbinsert=array("title" => $title,"news_detail"=> $ndetails,"date"=>$date);
			$table1="news";
			$insert=$db->insertdb($table1,$dbinsert);
			if($insert==1)
	{
		
		header("location:uploadnews.php?msg1=ok");
	}
	else
	{
		
		header('location:userhome.php?msg1=err');
	}
			?>
