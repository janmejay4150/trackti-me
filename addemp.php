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
		$type="e";

		$email=$_POST['email'];

		$query_para="*";
		$query_where="username='".$user."'";
		$query=$db->countdb($table,$query_para,$query_where);
		function validate_alphanumeric_underscore($str) 
		{
			return preg_match('/^[a-zA-Z0-9_.]+$/',$str);
			
		}
		
		if($query==1)
		{
			$msg1="x";
			header("location:employees.php?msg1=".$msg1);
		}
		
		else
		{
			$uncheck = validate_alphanumeric_underscore($user);
			if($uncheck == 0)
			{
				$msg1="unerr";
				header("location:employees.php?msg1=".$msg1);
				 
			}
			else
			{
				$dbinsert=array("username" =>$user,"password" => $pass,"type"=> $type, "email"=>$email);
				$insert=$db->insertdb($table,$dbinsert);
				$to = $_POST['email'];
				$subject = "Username and Password For Timekeepers";
				$message = 
					"Here are your new password details:"."\n".
					"Username :". $user." \n".
					"Password :". $pass ."\n".

					"Thank You"."\n".

					"Administrator,"."\n".
					"Timekeepers"."\n"."
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
					$msg1="ok";
					header("location:employees.php?msg1=".$msg1);
				}
				else
				{
					$msg1="err";
					header("location:employees.php?msg1=".$msg1);
				}
			}
		}
	}
?>
	
