<?php
	include("class_lib.php");
	$db= new Database();
	$db->connectdb();
	$email = $_POST['email'];
	$table = "login";
	$parameters = "username,password";
	$where = "email='".$email."'";
	$result = $db->selectdb($table,$parameters,$where);
	$count = $db->countdb($table,$parameters,$where);
	//print_r($result);
	$user = $result[0];
	$pass = $result[1];
	$subject = "Username and Password For Timekeepers";
	$message = 
			"Here are your Login details:"."\n".
			"Username : ". $user." \n".
			"Password : ". $pass ."\n".

			"Thank You"."\n".

			"Administrator,Please don't repeat this mistake again"."\n".
			"Timekeepers"."\n"."
			_____________________________________________________"."\n".
			"THIS IS AN AUTOMATED RESPONSE."."\n"."
			***DO NOT RESPOND TO THIS EMAIL****";
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type:text/html;charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Timkeepers'."\r\n" .
			'X-Mailer: PHP/' . phpversion();
		$mailsend=mail($email, $subject, $message,$headers);
		if($count == 1 && $mailsend == 1)
		{
			$msg="ok";
			header("location:recover-password.php?msg=".$msg);
		}
		else
		{
			$msg="err";
			header("location:recover-password.php?msg=".$msg);
		}
?>
