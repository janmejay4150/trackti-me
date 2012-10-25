<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
	
	include("class_lib.php");
	date_default_timezone_set('Asia/Calcutta');
	$yesterday = date('Y-m-d', time()-86400);

	$db = new Database();
	$db->connectdb();
	
	$table1="login";
	$parameters1="id,email";
	$where1="email not in (SELECT l.email FROM login l,tasks t where l.id= t.eid and t.t_date='".$yesterday."')";

	$query1=$db->select_db($table1,$parameters1,$where1);

	$subject = "Please fill your timesheet!";
	$message = "From: The TimeKeepers"."<br />"."<br /><br />This is a reminder for not filling up your timesheet.Please do so at the earliest.<br /><br />Regards,<br />The TimeKeepers<br />";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type:text/html;charset=iso-8859-1' . "\r\n";
	$headers .= 'From: The'.'TimeKeepers'."\r\n" .
	'Reply-To: no-reply@ajatus.co.in'."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	

	foreach($query1 as $var)
	{
		$to=$var['email'];
		mail($to, $subject, $message,$headers);
	}
	


?>
</body>
</html>
