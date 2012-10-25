<!DOCTYPE html>
<html>
	<head>
		
	</head>
	<body>
		<?php
		session_start();		
		if(!isset($_SESSION['user'])|| !isset($_SESSION['adminuser']))
			header('location:index.php');
		else
		{
		header('location:index.php');
		unset($_SESSION['adminuser']);
		unset($_SESSION['user']);
		unset($_SESSION['id']);
		unset($_SESSION['email']);
		unset($_SESSION['guest']);
		session_destroy();
		}
		?>
	</body>
</html>
