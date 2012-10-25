<?php
	session_start();
	if(!isset($_SESSION['user']))
		header('location:index.php');
else
{
	$to = "swateek.jena@ajatus.co.in";
	if($_POST['subject']== "" || $_POST['message'] == "" || strlen($_POST['message'])<1 )
	{
		echo "<div class='alert alert-error'>";
		echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
		echo "<h4>All fields are compulsory</h4>";
		echo "</div>";
	}
	else
	{  	
		$id=$_SESSION['id']; 
	
		include("class_lib.php");
		$table="login";		
		$parameters="email";
		$where="status=1 AND id=".$id;

		$db=new Database();
		$db->connectdb();

		$query=$db->selectdb($table,$parameters,$where);
		$email=$query['email'];

		$subject = $_POST['subject'];
		$message = "From: ".$email."<br />".$_POST['message'];
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type:text/html;charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$email."\r\n" ."<br />".
		'Reply-To: swateek.jena@ajatus.co.in'."\r\n" ."<br />".
		'X-Mailer: PHP/' . phpversion();
		$replyto = $email;
		$replysubject = "Thank You for contacting us";
		$replymessage = "Your feedback is important to us and we'll get back to you shortly. Thank you for your patience."."<br /><br /><br />"."Regards,"."<br />"."The Timekeepers";
		$replyheaders  = 'MIME-Version: 1.0' . "\r\n";
		$replyheaders .= 'Content-type:text/html;charset=iso-8859-1' . "\r\n";
		$replyheaders .= 'From: TimeKeepers'."\r\n" .'X-Mailer: PHP/' . phpversion();
		if(mail($to, $subject, $message,$headers) && mail($replyto, $replysubject, $replymessage,$replyheaders))
		{
			echo "<div class='alert alert-success'>";
			echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
			echo "<h4>Successfully Sent!</h4>";
			echo "</div>";
		}
		else
		{
			echo "<div class='alert alert-error'>";
			echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
			echo "<h4>Error: Please try again!</h4>";
			echo "</div>";
		}
	}	
}

?>
