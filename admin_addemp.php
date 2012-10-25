<!DOCTYPE html>
<html lang="en">
<head>
	<script type = "text/javascript">
		javascript:window.history.forward(1);
	</script>
<?php
	session_start();
	if(!isset($_SESSION['user']))
	header('location:index.php');
else
{
	include("class_lib.php");
	$user=$_SESSION['user'];
	$id= $_SESSION['id'];
?>
    <meta charset="utf-8">
    <title>Timesheet | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
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

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="docs/assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="docs/assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="docs/assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="docs/assets/ico/apple-touch-icon-57-precomposed.png">
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/flick/jquery-ui.css" type="text/css" />
	<script src="docs/assets/js/bootstrap-alert.js"></script>
	<script src="dateverify.js"></script>

	<script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "input:submit", ".b" ).button();
	});
	</script>
	
	<script type="text/javascript">
	function check(str1,str2,str3)
	{
		var x=document.forms["addemp"]["user"].value;
		var y=document.forms["addemp"]["pass"].value;
		var z=document.forms["addemp"]["email"].value;
		
		if(x == "" || y == "" || z == "" || x.length == 0 || y.length == 0 || z.length == 0)
		{
			document.getElementById("form_error").style.display="block";		
			if(x.length == 0 && y.length == 0 && z.length == 0)
			{
				document.getElementById("form_error").innerHTML = "All fields are mandatory!";		
				return false;
			}
			else if(x.length==0)
			{
				document.getElementById("form_error").innerHTML = "Please enter a Username";		
				return false;
			}
			else if(y.length==0)
			{
				document.getElementById("form_error").innerHTML = "Please enter a Password";		
				return false;
			}
			else
			{
				document.getElementById("form_error").innerHTML = "Please enter an email address";		
				return false;
			}
			return false;
		}
		else
		{	
			var b=eval(z);
			if(b == 1)
			{
				document.forms['addadmin'].submit();
			}
			else
			{		
				return false;
			}
		}	
	}

	function eval(str)
	{
		
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
	
	function ValidateForm()
	{
		var dt = document.forms['bydate']['dt'].value;
		if(dt == "" || dt == "NULL")
		{
			document.getElementById("form_error1").style.display="block";
			document.getElementById("form_error1").innerHTML = "Please choose a date to view the details.";
			return false;
		}
		else
			document.forms['bydate'].submit();
	}
	
	</script>
</head>

	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="brand" href="#">Ajatus Softwares</a>
					<div class="btn-group pull-right">
						<a href="logout.php" class="btn btn-primary btn-large">Logout</a>
					</div>
					<div class="nav-collapse">
						<ul class="nav">
							<li class=""><a href="adminhome.php">Home</a></li>
							<li class="active"><a href="#">Add Employee</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row-fluid">
				<h1>Hello, <?php echo ucwords($user); ?>!</h1>
				<br />
			</div> <!-- /row-fluid1 -->
			<div class="row-fluid">
				<div class="span9">
					<br /><br />
					<h4>Add Employee</h4>
					<br /><br />
					<?php
						if(isset($_GET['msg1']))
						{                
							$a=$_GET['msg1'];
							//echo $a;
							if($a=="ok")
							{	
								echo "<div class='alert alert-success'>";						
								echo "<h4>Success: Employee Added!</h4>";
								echo "</div>";
							}
							elseif($a=="err")
							{
								echo "<div class='alert alert-error'>";
								echo "<h4>Error: Please Try Again!</h4>";
								echo "</div>";
							}
							elseif($a == "unerr")
							{
								echo "<div class='alert alert-error'>";
								echo "<h4>Error: Username shouldn't contain any special character(only dot(.) and _ are allowed)</h4>";
								echo "</div>";
							}
							else
							{
								echo "<div class='alert alert-error'>";
								echo "<h4>User already exists</h4>";
								echo "</div>";
							}
						}
					?>
					<strong>
						<div style = "color: red;background-color:#F2DEDE;display:none;width:250px;padding:5px;border-radius:5px;" id = "form_error"> </div>
					</strong>
					<form name="addemp" class="form-horizontal" method="POST" action="addemp.php" onsubmit="return check(user.value,pass.value,email.value);">
						<p><h5>Username:</h5><input type="text" name="user" placeholder = "Username" autofocus = "autofocus"></p>
						<p><h5>Password:</h5><input type="text" name="pass" placeholder = "Password"></p>
						<p><h5>Email:</h5><input type="text" name="email" placeholder = "Email"></p>
						<input class="btn btn-primary" type="submit" value="Submit" >
					</form>
				</div> <!-- /span9 -->
				<div class="span3">
					<div class="row-fluid well">
					<h5>Choose Date and Name to View Details:</h5><br /><br />
					<strong>
						<div style = "color: red;background-color:#F2DEDE;display:none;width:250px;padding:5px;border-radius:5px;" id = "form_error1"> 
						</div>
					</strong>
					<h5>Date:</h5>
					<form name="bydate" method="POST" action="adminhome.php" onsubmit="return ValidateForm();">
						<p><input name="dt" type="text" id="datepicker" /></p>
						<h5>Name:</h5>
						<p>
							<?php
								$db= new Database();
								$db->connectdb();
								$table="login";
								$parameters="username";
								$where ="status = 1";
								$var=$db->select_db($table,$parameters,$where);
								echo "<select name='userdetail'>";
								foreach($var as $name)
								{
									echo "<option value='" . $name['username'] . "'>" . $name['username'] . "</option>";
								}
								echo "</select>";
							?>
						</p>
						<input type="submit" class="btn btn-primary"  value="View"/>
					</form>
				</div> <!-- /span3 -->
				<div class="row-fluid well">
					<p><strong><a href="admin_addemp.php" >Add an Employee</a></strong></p>
					<p><a href="admin_delemp.php" >Delete an Employee</a></p>
					<p><a href="admin_addadmin.php" >Add an Admin</a></strong></p>
					<p><a href="admin_addpro.php" >Add a Project</a></strong></p>
					<p><a href="admin_assgproj.php" >Assign Projects</a></strong></p>	
				</div> <!-- /row_fluid well -->						
			</div> <!-- /row fluid -->
		</div> <!--fluid container -->
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
<?php
}
?>
</html>
		
