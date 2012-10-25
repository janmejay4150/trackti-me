<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<?php
		date_default_timezone_set('Asia/Kolkata');
		$currdate = date('Y-m-d', time());
		$msg4="ok";	
		header("location:userhome.php?msg4=".$msg4."&dt=".$currdate);
		?>
	</body>
</html>
