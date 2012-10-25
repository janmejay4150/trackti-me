<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
	header('location:index.php');
	else
	{
		include("class_lib.php");
	
		$db= new Database();
		$db->connectdb();
		$table="login";
	
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		$client=$_POST['client'];
		$type="g";

		$table2="client_info";
		$parameters2="email";
		$where2="status=1 AND name='".$client."'";
		
		$query2=$db->selectdb($table2,$parameters2,$where2);
		$email=$query2['email'];

		$query_para="*";
		$query_where="username='".$user."' OR email='".$email."'";
		$query=$db->countdb($table,$query_para,$query_where);
		
		function validate_alphanumeric_underscore($str) 
		{
			return preg_match('/^[a-zA-Z0-9_.]+$/',$str);
			
		}
		
		if($query==1)
		{
			$msg5="x";
			header("location:employees.php?msg5=".$msg5);
		}
		
		else
		{
			$uncheck = validate_alphanumeric_underscore($user);
			if($uncheck == 0)
			{
				$msg5="unerr";
				header("location:employees.php?msg5=".$msg5);
				 
			}
			else
			{
				$dbinsert=array("username" =>$user,"password" => $pass,"type"=> $type,"email"=> $email);
				$insert=$db->insertdb($table,$dbinsert);
				$to = $email;
				$subject = "Username and Password For Timekeepers";
				$message = "Here are your new password details:"."\n"."<br/><br/>".
					   "Username :". $user." \n"."<br/>".
					   "Password :". $pass ."\n"."<br/><br/>".

					   "Thank You"."\n"."<br/>".
   
                   			   "Administrator,"."\n".
					   "Timekeepers"."\n"."<br/>"."
					_____________________________________________________"."\n".
					"THIS IS AN AUTOMATED RESPONSE."."\n"."
					***DO NOT RESPOND TO THIS EMAIL****";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type:text/html;charset=iso-8859-1' . "\r\n";
				$headers .= 'From: Timkeepers'."\r\n" .
					'X-Mailer: PHP/' . phpversion();
				$mailsend=mail($to, $subject, $message,$headers);
	
				if($insert==1&&$mailsend==1)
				{
					$msg5="ok";
					header("location:employees.php?msg5=".$msg5);
				}
				else
				{
					$msg5="err";
					header("location:employees.php?msg5=".$msg5);
				}
			}
		}
	}
?>
	
