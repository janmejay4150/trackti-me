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
	document.getElementById("form_error").style.display="block";
	function check(str1,str2)
	{
		var x=document.forms["addadmin"]["user"].value;
		var y=document.forms["addadmin"]["pass"].value;
		if(x == "" || y == "" || x.length == 0 || y.length == 0)
		{
			document.getElementById("form_error").style.display="block";
			if(x.length == 0 && y.length == 0)
				document.getElementById("form_error").innerHTML ="Username and Password fields are empty";
			else if(x.length==0)
				document.getElementById("form_error").innerHTML ="Username field is empty";
			else
				document.getElementById("form_error").innerHTML ="Password field is empty";
		return false;
		}
		else
		{	document.forms['addadmin'].submit();}
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
<div id="wrapper"  style="width:930px;margin:0 auto;">
<div class="navbar navbar-fixed-top">
<div class="navbar-inner">
<div class="container-fluid">
    <a class="brand" href="#">Ajatus Softwares</a>
  <div class="btn-group pull-right">
    <a class="btn btn-primary" href="#"><i class="icon-briefcase icon-white"></i> Account</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="change.php"><i class="icon-pencil"></i> Change Password</a></li>
    <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
  </ul>
 </div>
  <div class="nav-collapse">
    <ul class="nav">
      <li class=""><a href="adminhome.php">Home</a></li>
      <li class="active"><a href="#">Add Admin</a></li>
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
<h4>Add Administrator</h4>
<br /><br />
<?php
if(isset($_GET['msg']))
{                
	$a=$_GET['msg'];
	if($a=="ok")
	{	
		echo "<div class='alert alert-success'>";						
		echo "<h4>Success: Admin Added!</h4>";
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
		echo "<h4>Admin already exists</h4>";
		echo "</div>";
	}
}
?>
<div class="alert alert-error" id="form_error" style="display:none;"><b></b></div>
<form class="form-horizontal" name="addadmin" method="POST" action="addadmin.php" onsubmit="return check(user.value,pass.value);">
    <p><h5>Username:</h5><input type="text" name="user" placeholder = "Username" autofocus = "autofocus"></p>
    <p><h5>Password:</h5><input type="text" name="pass" placeholder = "Password"></p>
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
				</div> <!-- /span-row2 -->

<div class="row-fluid well">
				<p><a href="employees.php" >Employees</a></p>
				<p><strong><a href="admin_addadmin.php" >Add an Admin</a></strong></p>
				<p><a href="admin_addpro.php" >Add a Project</a></p>
				<p><a href="admin_assgproj.php" >Assign Projects</a></p>	
				
			</div> <!-- /span-row3 -->						
		</div> <!-- /span3 -->
			</div><!-- /rowfluid2 -->
</div> <!--fluid -->
</div> <!--wrapper-->
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
