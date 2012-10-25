<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset="utf-8">
		<title>Timesheet|Recover Password</title>
		<link href="/blog/favicon.png" rel="icon">
		<link href="docs/assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;}
	#ui-datepicker-div{
	display: none;
	}
    </style>
    <link href="docs/assets/css/bootstrap-responsive.css" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="docs/assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="docs/assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="docs/assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="docs/assets/ico/apple-touch-icon-57-precomposed.png">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/flick/jquery-ui.css" type="text/css" />
		<!--script type = "text/javascript">
		javascript:window.history.forward(1);
	</script-->
	<!--script type = "text/javascript">
			function validation()
			{
				var str = document.getElementById("email").value;
				var atpos=str.indexOf("@ajatus.co.in");
				var dotpos=str.lastIndexOf(".");
				if (atpos<1 || dotpos<atpos+2 || dotpos+2>=str.length)
				{
					document.getElementById("form_error").style.display="block";
					document.getElementById("form_error").innerHTML = "email should be \'anyname@ajatus.co.in\'";
					return false;
				}
				else
					return true;
			}
	</script-->
	<h3><center>Please Enter Your email ID to get your passwod back</h3>
	<hr>
	</head>

	<body>
		<form class="form-horizontal" method = "post" action = "mailpassword.php">
			<div class="control-group">
				<label class="control-label" for="inputEmail"><h4>Email :</h4></label>
				<div class="controls">
					<p><input type="text" id="email" name = "email" placeholder="Email" autofocus = "autofocus" required = "required"></p>
					<button type="submit" class="btn btn-primary">Submit</button>
					<p/>
					<!--strong>
						<div style = "color: red;background-color:#F2DEDE;display:none;width:250px;padding:5px;border-radius:5px;" id = "form_error"></div>
					</strong-->
					<?php
						if(isset($_GET['msg']))
						{                
							$a=$_GET['msg'];
							//echo $a;
							if($a=="ok")
							{	
								echo "<div class='alert alert-success'>";						
								echo "<h3>Success: Your Login Details has been sent to your Email address</h3>";
								echo "To go to Login page &nbsp;";
								echo "<a href = 'index.php'> Click here</a>";
								echo "</div>";
							}
							elseif($a=="err")
							{
								echo "<div class='alert alert-error'>";
								echo "<h3>Error: There is no account with this Email ID.</h3>";
								echo "</div>";
							}
						}
					?>
				</div>
			</div>
		</form>
	</body>
	<script src="docs/assets/js/bootstrap-transition.js"></script>
    <script src="docs/assets/js/bootstrap-modal.js"></script>
    <script src="docs/assets/js/bootstrap-dropdown.js"></script>
    <script src="docs/assets/js/bootstrap-scrollspy.js"></script>
    <script src="docs/assets/js/bootstrap-tab.js"></script>
    <script src="docs/assets/js/bootstrap-tooltip.js"></script>
    <script src="docs/assets/js/bootstrap-popover.js"></script>
    <script src="docs/assets/js/bootstrap-button.js"></script>
    <script src="docs/assets/js/bootstrap-collapse.js"></script>
    <script src="docs/assets/js/bootstrap-carousel.js"></script>
    <script src="docs/assets/js/bootstrap-typeahead.js"></script>
</html>
