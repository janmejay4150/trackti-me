<?php
# Logging in with Google accounts requires setting special identity, so this example shows how to do it.
require 'openid.php';
try {
    # Change 'localhost' to your domain name.
    $openid = new LightOpenID('www.timesheet.ajatus.in');
    if(!$openid->mode) {
        if(isset($_GET['login'])) {
            $openid->identity = 'https://www.google.com/accounts/o8/site-xrds?hd=ajatus.co.in';
	    $openid->required = array('namePerson/friendly', 'contact/email','picture');
            header('Location: ' . $openid->authUrl());
        }
?>
<html>
<head></head>
<body>
<form action="?login" method="post">
    <input type="submit" value="Login with Ajatus ID"/>
</form>

<?php
    } elseif($openid->mode == 'cancel') {
        echo 'User has canceled authentication!';
    } else {

		session_start();		
		include("class_lib.php");

		unset($_SESSION['adminuser']);
		unset($_SESSION['user']);
		unset($_SESSION['id']);

        
		$attr=$openid->getAttributes('contact/email');
		$email=$attr['contact/email'];
	
		$login="login";
		$id="*";
		$cond="email='".$email."'";

		$db= new Database();
		$db->connectdb();

		$result=$db->selectdb($login,$id,$cond);
		$_SESSION['id']=$result['id'];

		$uname=$result['username'];
		$pwd=$result['password'];
		
		if ($db->logincheck($uname,$pwd))

		{
			if($result['type']=='e')
			{
				$_SESSION['user']=$result['username'];		
				header('Location:http://www.timesheet.ajatus.in/userdash.php');
			}
			else
			{
				$_SESSION['adminuser']=$result['username'];
				header('location:http://www.timesheet.ajatus.in/admindash.php');
			}
		}
		else
		{
			$msg="err";
			session_destroy();			
			header("location:index.php?msg=".$msg);
		}
	
    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}
?>
</body>
</html>
