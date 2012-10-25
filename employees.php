<!DOCTYPE html>
<html lang="en">
<head>
<?php
	session_start();
	if(!isset($_SESSION['adminuser']))
	header('location:index.php');
else
{
	include("class_lib.php");
	$user=$_SESSION['adminuser'];
	$id= $_SESSION['id'];
	date_default_timezone_set('Asia/Calcutta');
	$setdate = date('d-m-Y', time());
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
	function validation()
	{
		var empl = document.forms['delemp']['user'].value;
		if(empl == "" || empl == "NULL" || empl == "#")
		{
			document.getElementById("form_error2").style.display="block";
			document.getElementById("form_error2").innerHTML = "Please select an Employee";
			return false;
		}
		else
		{
			document.forms['delemp'].submit();
		}
	}

	function valid()
	{
		var empl = document.forms['mkadmin']['user'].value;
		if(empl == "" || empl == "NULL" || empl == "#")
		{
			document.getElementById("form_error3").style.display="block";
			document.getElementById("form_error3").innerHTML = "Please select an Employee";
			return false;
		}
		else
		{
			document.forms['mkadmin'].submit();
		}
	}

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
			document.getElementById("form_error1").innerHTML = "Please choose a date";
			return false;
		}
		else
			document.forms['bydate'].submit();
	}
	function sendmail()
	{
		var subject= $('#subject').val();
		var message= document.forms["mail"]["message"].value;
		var data = "subject="+subject+"&message="+message;
		$.post("adminmail.php",data,function(response){ //alert(response);
		$('#submitmsg').html(response);});
	}
	function check_client()
	{
		var client=document.forms["client_access"]["client"].value;
		var user=document.forms["client_access"]["user"].value;
		var pass=document.forms["client_access"]["pass"].value;

		if(client.length==0 && user.length==0 && pass.length==0)
		{
			document.getElementById("form_error5").style.display="block";
			document.getElementById("form_error5").innerHTML = "All fields are mandatory";
			return false;	
		}
		else if(client.length==0)
		{
			document.getElementById("form_error5").style.display="block";
			document.getElementById("form_error5").innerHTML = "Please fill a client's name";
			return false;
		}
		else if(user.length==0)
		{
			document.getElementById("form_error5").style.display="block";
			document.getElementById("form_error5").innerHTML = "Please fill a username";
			return false;
		}
		else if(pass.length==0)
		{
			document.getElementById("form_error5").style.display="block";
			document.getElementById("form_error5").innerHTML = "Please fill a password";
			return false;
		}
		else
			document.forms['client_access'].submit();
	}

	function validation_client()
	{
		var client=document.forms["delaccess"]["client"].value;
		if(client=="#")
		{
			document.getElementById("form_error6").style.display="block";
			document.getElementById("form_error6").innerHTML = "Please select a client";
			return false;
		}
		else
			document.forms['delaccess'].submit();
	}
	
	</script>
</head>

<body>
<div class="modal hide fade in" id="myModal">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">×</button>
      <h3>Feedback</h3>
    </div>
    <center><div class="modal-body">
	<div id="submitmsg"></div>
   <form id="mail" method="POST">
<fieldset>
	<p><label for="name"><h4>Subject/Topic:</h4></label>
	<input type="text" autofocus = "autofocus" name="subject" id="subject" class="text ui-widget-content ui-corner-all" /></p>
	<p><label for="message"><h4>Message:</h4></label><br/>
	<textarea rows="10" cols="30" name="message" id="msg" value="" class="text ui-widget-content ui-corner-all">
	</textarea></p>
</fieldset>
    </div></center>
    <div class="modal-footer">
      <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
      <button class="btn btn-primary" id="mailb" type="button" onclick="sendmail();">Submit</button>
     </form></div>
 </div>
<div id="wrapper"  style="width:974px; margin: 0 auto;">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="brand" href="adminhome.php">Ajatus Software</a>
					<div class="btn-group pull-right">
    <a class="btn btn-primary" href="#"><i class="icon-briefcase icon-white"></i> Account</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
					    <li><a href="adminchange.php"><i class="icon-pencil"></i> Change Password</a></li>
					    <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
					    <li class="divider"></li>
					    <li><a data-toggle="modal" href="#myModal">Feedback</a></li>
					  </ul>
 </div>
					<div class="nav-collapse">
						<ul class="nav" role="navigation">
							<li><a href="admindash.php">Dashboard</a></li>
							<li><a href="admintt.php">Timesheet</a></li>
							<li  class="active"><a href="employees.php">Employees</a></li>
							<li class="dropdown">
<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Projects<b class="caret"></b></a>
			      				<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
							<li><a tabindex="-1" href="projects.php">Projects</a></li>
							<li><a tabindex="-1" href="manageprojects.php">Manage Projects</a></li>
							</ul>
							</li>
							<li><a href="emp_status_report.php">Reports</a></li>
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
<?php $table2="client_info";
$parameters2="name";
$where2="status=1 ORDER BY name";

$db=new Database();
$db->connectdb();

$res1=$db->select_db($table2,$parameters2,$where2);?>
					<?php
						if(isset($_GET['msg1']))
						{                
							$a=$_GET['msg1'];
							//echo $a;
							if($a=="ok")
							{	
								echo "<div class='alert alert-success'>";						
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Success: Employee Added!</h4>";
								echo "</div>";
							}
							elseif($a=="err")
							{
								echo "<div class='alert alert-error'>";
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Error: Please Try Again!</h4>";
								echo "</div>";
							}
							elseif($a == "unerr")
							{
								echo "<div class='alert alert-error'>";
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Error: Username shouldn't contain any special character(only dot(.) and _ are allowed)</h4>";
								echo "</div>";
							}
							else
							{
								echo "<div class='alert alert-error'>";
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>User already exists</h4>";
								echo "</div>";
							}
						}

						if(isset($_GET['msg2']))
						{
							$b=$_GET['msg2'];
							if($b=="ok")
							{
								echo "<div class='alert alert-success'>";						
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Success: Employee Removed!</h4>";
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
						
						if(isset($_GET['msg3']))
						{
							$c=$_GET['msg3'];
							if($c=="ok")
							{
								echo "<div class='alert alert-success'>";						
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Administrator Added!</h4>";
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

						if(isset($_GET['msg4']))
						{
							$c=$_GET['msg4'];
							if($c=="ok")
							{
								echo "<div class='alert alert-success'>";						
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Administrator Removed Successfully!</h4>";
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
						
						if(isset($_GET['msg5']))
						{                
							$a=$_GET['msg5'];
							//echo $a;
							if($a=="ok")
							{	
								echo "<div class='alert alert-success'>";						
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Client granted Access</h4>";
								echo "</div>";
							}
							elseif($a=="err")
							{
								echo "<div class='alert alert-error'>";
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Error: Please Try Again!</h4>";
								echo "</div>";
							}
							elseif($a == "unerr")
							{
								echo "<div class='alert alert-error'>";
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Error: Username shouldn't contain any special character(only dot(.) and _ are allowed)</h4>";
								echo "</div>";
							}
							else
							{
								echo "<div class='alert alert-error'>";
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Client Access already exists</h4>";
								echo "</div>";
							}
						}

						if(isset($_GET['msg6']))
						{
							$c=$_GET['msg6'];
							if($c=="ok")
							{
								echo "<div class='alert alert-success'>";						
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Access Removed Successfully!</h4>";
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
					?>
<div class="row-fluid">
		<div class="span4">
<h4>Add Employee</h4>
					<br /><br />
					<h4><div class="alert alert-error" id="form_error" style="display:none;"></div></h4>
					<form name="addemp" class="form-horizontal" method="POST" action="addemp.php" onsubmit="return check(user.value,pass.value,email.value);">
						<p><h5>Username:</h5><input type="text" name="user" placeholder = "Username" autofocus = "autofocus"></p>
						<p><h5>Password:</h5><input type="text" name="pass" placeholder = "Password"></p>
						<p><h5>Email:</h5><input type="text" name="email" placeholder = "Email"></p>
						<input class="btn btn-primary" type="submit" value="Submit" >
					</form>

</div>
<div class="span1"></div>
<div class="span4">
		<h4>Remove an Employee</h4>
		<br /><br />
		<h4><div class="alert alert-error" id="form_error2" style="display:none;"></div></h4>
		<form class="form-inline" name="delemp" method="POST" action="delete_emp.php"  onsubmit = "return validation()">
		<p><h5>Employees:</h5>
		<?php
			$db= new Database();
			$db->connectdb();
			$table="login";
			$parameters="username";
			$where = "status = 1 AND type = 'e' ORDER by username";
			$var=$db->select_db($table,$parameters,$where);
			echo "<select name='user'>";
			echo "<option value='#'> Choose.."."</option>";
			foreach($var as $name)
			{
			echo "<option value='" . $name['username'] . "'>" . $name['username'] . "</option>";
			}
			echo "</select>";
		?></p><br />
		<input class="btn btn-primary" type="submit" value="Remove" >
		</form>
</div></div><br />
<legend></legend>
<div class="row-fluid">
		<div class="span4">
<h4>Make Administrator</h4>
		<br /><br />
		<h4><div class="alert alert-error" id="form_error3" style="display:none;"></div></h4>
		<form class="form-inline" name="mkadmin" method="POST" action="addadmin.php"  onsubmit = "return valid()">
		<p><h5>Employees:</h5>
		<?php
			$db= new Database();
			$db->connectdb();
			$table="login";
			$parameters="username";
			$where = "status = 1 AND type = 'e' ORDER by username";
			$var=$db->select_db($table,$parameters,$where);
			echo "<select name='user'>";
			echo "<option value='#'> Choose.."."</option>";
			foreach($var as $name)
			{
			echo "<option value='" . $name['username'] . "'>" . $name['username'] . "</option>";
			}
			echo "</select>";
		?></p><br />
		<input class="btn btn-primary" type="submit" value="Make" >
		</form>
</div>
<div class="span1"></div>
<div class="span4">
<h4>Remove as Administrator</h4>
		<br /><br />
		<h4><div class="alert alert-error" id="form_error3" style="display:none;"></div></h4>
		<form class="form-inline" name="mkadmin" method="POST" action="del_admin.php"  onsubmit = "return valid()">
		<p><h5>Employees:</h5>
		<?php
			$db= new Database();
			$db->connectdb();
			$table="login";
			$parameters="username";
			$where = "status = 1 AND type = 'a' AND id!=".$id." ORDER by username";
			$var=$db->select_db($table,$parameters,$where);
			echo "<select name='user'>";
			echo "<option value='#'> Choose.."."</option>";
			foreach($var as $name)
			{
			echo "<option value='" . $name['username'] . "'>" . $name['username'] . "</option>";
			}
			echo "</select>";
		?></p><br />
		<input class="btn btn-primary" type="submit" value="Remove" >
		</form>
</div></div><br/>
<legend></legend>
<div class="row-fluid">
		<div class="span4">
<h4>Grant Client Access</h4>
					<br /><br />
					<h4><div class="alert alert-error" id="form_error5" style="display:none;"></div></h4>
					<form name="client_access" class="form-horizontal" method="POST" action="client_access.php" onsubmit="return check_client(user.value,pass.value,client.value);">
					<h5>Client:</h5><input type="text" name="client" autocomplete="off" data-provide="typeahead" data-items="3" data-source='[<?php 
          $len=count($res1);
          for($i=0;$i<$len;$i++)
          {
              echo '"'.$res1[$i]['name'].'"';
              if($i+1 != $len)
              echo ',';           
          }      
          ?>]' />
	  <p><h5>Username:</h5><input type="text" name="user" placeholder = "Username"></p>
	  <p><h5>Password:</h5><input type="text" name="pass" placeholder = "Password"></p>
	  <input class="btn btn-primary" type="submit" value="Add" > 
					</form>

</div>
<div class="span1"></div>
<div class="span4">
		<h4>Remove Client Access</h4>
		<br /><br />
		<h4><div class="alert alert-error" id="form_error6" style="display:none;"></div></h4>
		<form class="form-inline" name="delaccess" method="POST" action="delete_access.php"  onsubmit = "return validation_client();">
		<p><h5>Select a Client:</h5>
		<?php
			$db= new Database();
			$db->connectdb();
			$table="login";
			$parameters="username";
			$where = "status = 1 AND type = 'g' ORDER by username";
			$var=$db->select_db($table,$parameters,$where);
			echo "<select name='client'>";
			echo "<option value='#'> Choose.."."</option>";
			foreach($var as $name)
			{
			echo "<option value='" . $name['username'] . "'>" . $name['username'] . "</option>";
			}
			echo "</select>";
		?></p><br />
		<input class="btn btn-primary" type="submit" value="Remove" >
		</form>
</div></div><br />

				</div> <!-- /span9 -->
				<div class="span3">
					<div class="row-fluid well">
					<h5>Choose Date and Name to View Details:</h5><br /><br />
					<h4><div class="alert alert-error" id="form_error1" style="display:none;"></div></h4>
					<h5>Date:</h5>
					<form name="bydate" method="POST" action="adminhome.php" onsubmit="return ValidateForm();">
						<p><input name="dt" autocomplete="off" value="<?php echo $setdate;?>"  type="text" id="datepicker" /></p>
						<h5>Name:</h5>
						<p>
							<?php
								$db= new Database();
								$db->connectdb();
								$table="login";
								$parameters="username";
								$where ="status = 1 ORDER by username";
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
					<p><strong><a href="employees.php" >Employees</a></strong></p>
					<p><a href="projects.php" >Projects</a></p>
					<p><a href="emp_status_report.php">Reports</a></p>	
				</div> <!-- /row_fluid well -->						
			</div> <!-- /row fluid -->
		</div> <!--fluid container -->
</div> <!--wrapper -->
</body>	
  <script src="docs/assets/js/bootstrap-transition.js"></script>
    <script src="docs/assets/js/bootstrap-modal.js"></script>
    <!-- <script src="docs/assets/js/jquery.js"></script> -->
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
		
