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
	date_default_timezone_set('Asia/Kolkata');
	$setdate = date('d-m-Y', time());
	$user=$_SESSION['adminuser'];
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
	<link rel="stylesheet" href="styles/token-input.css" type="text/css" />
	<link rel="stylesheet" href="styles/token-input-facebook.css" type="text/css" />
	<script type="text/javascript" src="src/jquery.tokeninput.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "input:submit", ".b" ).button();
	});
	</script>	
	<script type="text/javascript">
	function check(str1)
	{
		var x=document.forms["complproj"]["project"].value;
		if(x == "#" || x.length == 0)
		{
			document.getElementById("form_error").style.display="block";
			document.getElementById("form_error").innerHTML = "Please select a project";
			return false;
		}
		else
		{	document.forms['complproj'].submit();}
	}
	function check1(str1)
	{
		var x=document.forms["reopen"]["project"].value;
		if(x == "#" || x.length == 0)
		{
			document.getElementById("form_error2").style.display="block";
			document.getElementById("form_error2").innerHTML = "Please select a project";
			return false;
		}
		else
		{	document.forms['reopen'].submit();}
	}
	function check2(str1)
	{
		var x=document.forms["projmodify"]["project"].value;
		if(x == "#" || x.length == 0)
		{
			document.getElementById("form_error3").style.display="block";
			document.getElementById("form_error3").innerHTML = "Please select a project";
			return false;
		}
		else
		{	document.forms['reopen'].submit();}
	}
	function check3(str1)
	{
		var x=document.forms["clientmodify"]["client"].value;
		if(x == "#" || x.length == 0)
		{
			document.getElementById("form_error3").style.display="block";
			document.getElementById("form_error3").innerHTML = "Please select a client";
			return false;
		}
		else
		{	document.forms['reopen'].submit();}
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
	
	function getinfo(str)
	{
		var data = "keyword="+str;
		$.post("getproinfo.php",data,function(response){ //alert(response);
		var gdata=response;
		var str1=gdata.split("`");
		$('#pname').attr("value",str1[0]);
		$('#pdetails').html(str1[1]);
	});
	}
	
	function getclient(str)
	{
		var data = "keyword="+str;
		$.post("getclientinfo.php",data,function(response){ //alert(response);
		var gdata=response;
		var str1=gdata.split("`");
		$('#cname').attr("value",str1[0]);
		$('#caddress').html(str1[1]);
		$('#ccity').attr("value",str1[2]);
		$('#cstate').attr("value",str1[3]);
		$('#cpostcode').attr("value",str1[4]);
		$('#cph').attr("value",str1[5]);
		$('#cfax').attr("value",str1[6]);
		$('#cmail').attr("value",str1[7]);
		$('#cwsite').attr("value",str1[8]);
	});
	}
	function sendmail()
	{
		var subject= $('#subject').val();
		var message= $('#msg').html();
		var data = "subject="+subject+"&message="+message;
		$.post("mail.php",data,function(response){ //alert(response);
		$('#submitmsg').html(response);});
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
    <a class="brand" href="adminhome.php">Ajatus Softwares</a>
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
							<li><a href="employees.php">Employees</a></li>
							<li class="dropdown active">
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
<div class="row-fluid">
		<div class="span6">
			<h3>Complete a Project</h3>
			<legend></legend>
			<?php
			if(isset($_GET['msg1']))
				{                
					$a=$_GET['msg1'];
					if($a=="ok")
					{	
						echo "<div class='alert alert-success'>";
						echo "<h4>Success: Project Completed!</h4>";
						echo "</div>";
					}
					else
					{
						echo "<div class='alert alert-error'>";
						echo "<h4>Error: Please Try Again!</h4>";
						echo "</div>";
					}
				}
	
			?>
			<h4><div class="alert alert-error" id="form_error" style="display:none;"></div></h4>
			<form class="form-horizontal" name="complproj" method="POST" action="complpro.php" onsubmit="return check(project.value);">
				<p>
					<p><h5>Projects:</h5></p>
					<?php
						$db= new Database();
						$db->connectdb();
						$table="projects";
						$parameters="name,pid";
						$where = "status = 1 ORDER BY name";
						$var=$db->select_db($table,$parameters,$where);
						echo "<select name='project' autofocus = 'autofocus'>";
						echo "<option value='#'>Select a Project</option>";
						foreach($var as $name)
						{
						echo "<option value='" . $name['pid'] . "'>" . $name['name'] . "</option>";
						}
						echo "</select>";
						echo "<br />";
						
					?>
				</p><br />
			<input class="btn btn-primary" type="submit" value="Submit" >
			</form>
		</div>
		<div class="span6">
			<h3>Restore a Project</h3>
			<legend></legend>
			<?php
			if(isset($_GET['msg2']))
				{                
					$a=$_GET['msg2'];
					if($a=="ok")
					{	
						echo "<div class='alert alert-success'>";
						echo "<h4>Success: Project Restored!</h4>";
						echo "</div>";
					}
					else
					{
						echo "<div class='alert alert-error'>";
						echo "<h4>Error: Please Try Again!</h4>";
						echo "</div>";
					}
				}
	
			?>
			<h4><div class="alert alert-error" id="form_error2" style="display:none;"></div></h4>
			<form class="form-horizontal" name="reopen" method="POST" action="reopen.php" onsubmit="return check1(project.value);">
				<p>
					<p><h5>Projects:</h5></p>
					<?php
						$db= new Database();
						$db->connectdb();
						$table="projects";
						$parameters="name,pid";
						$where = "status = 0 ORDER BY name";
						$var=$db->select_db($table,$parameters,$where);
						echo "<select name='project' autofocus = 'autofocus'>";
						echo "<option value='#'>Select a Project</option>";
						foreach($var as $name)
						{
						echo "<option value='" . $name['pid'] . "'>" . $name['name'] . "</option>";
						}
						echo "</select>";
					?>
				</p><br />
			<input class="btn btn-primary" type="submit" value="Submit" >
			</form>
		</div>
</div>
<br />
<br />
<br />
<h3>Edit Project Information</h3>
<legend></legend>
					<?php
						if(isset($_GET['msg3']))
							{                
								$a=$_GET['msg3'];
								if($a=="ok")
								{	
									echo "<div class='alert alert-success'>";
									echo "<h4>Project Modified</h4>";
									echo "</div>";
								}
								else
								{
									echo "<div class='alert alert-error'>";
									echo "<h4>Error: Please Try Again!</h4>";
									echo "</div>";
								}
							}
	
					?>
<h4><div class="alert alert-error" id="form_error3" style="display:none;"></div></h4>
						<form class="form-horizontal" name="projmodify" method="POST" action="projmodify.php" onsubmit="return check2(project.value);">
							<p>
								<p><h5>Projects:</h5></p>
								<?php
									$db= new Database();
									$db->connectdb();
									$table="projects";
									$parameters="name,pid";
									$where = "status = 1 ORDER BY name";
									$var=$db->select_db($table,$parameters,$where);
									echo "<select name='project' id='project' autofocus = 'autofocus' onchange='getinfo(this.value)'>";
									echo "<option value='#'>Select a Project</option>";
									foreach($var as $name)
									{
									echo "<option value='" . $name['pid'] . "'>" . $name['name'] . "</option>";
									}
									echo "</select>";
								?>
							</p><br />
								<p><h5>Project Name:</h5></p>
							<input type="text" name="pname" id="pname" required="required"/><br />
								<p><h5>Project Details:</h5></p>
							<textarea id="pdetails" name="pdetails"></textarea><br /><br />	
						<input class="btn btn-primary" type="submit" value="Submit" >
					</form>
<br />
<br />
<br />
<h3>Edit Client Information</h3>
<legend></legend>
					<?php
						if(isset($_GET['msg4']))
							{                
								$a=$_GET['msg4'];
								if($a=="ok")
								{	
									echo "<div class='alert alert-success'>";
									echo "<h4>Client Info Modified</h4>";
									echo "</div>";
								}
								else
								{
									echo "<div class='alert alert-error'>";
									echo "<h4>Error: Please Try Again!</h4>";
									echo "</div>";
								}
							}
	
					?>
<h4><div class="alert alert-error" id="form_error3" style="display:none;"></div></h4>
<form class="form-horizontal" name="clientmodify" method="POST" action="clientmodify.php" onsubmit="return check3(client.value);">
<p>
			<p><h5>Clients:</h5></p>
			<?php
				$db= new Database();
				$db->connectdb();
				$table="client_info";
				$parameters="name,cid";
				$where = "status = 1 ORDER BY name";
				$var=$db->select_db($table,$parameters,$where);
				echo "<select name='client' id='client' autofocus = 'autofocus' onchange='getclient(this.value)'>";
				echo "<option value='#'>Select a Client</option>";
				foreach($var as $name)
				{
				echo "<option value='" . $name['cid'] . "'>" . $name['name'] . "</option>";
				}
				echo "</select>";
			?>
</p><br />
<p><h5>Name:</h5></p><input type="text" required="required" name="cname" id="cname"/><br />
<p><h5>Address:</h5></p></br><textarea rows="3" cols="5" name="caddress" id="caddress"></textarea><br/>
<p><h5>City:</h5></p><input type ="text" name="city" id="ccity"/><br />
<p><h5>State:</h5></p><input type ="text" name="state" id="cstate"/><br/>
<p><h5>Postal Code:</h5></p><input type="text" name="postcode" id="cpostcode"/><br/>
<p><h5>Phone:</h5></p><input required="required" type ="text" name="cph" id="cph"/><br/>
<p><h5>Fax:</h5></p><input type="text" name="fax" id="cfax"/><br/>
<p><h5>Email:</h5></p><input required="required" type="text" name="cmail" id="cmail"/><br/>
<p><h5>Website:</h5></p><input type="text" name="cwsite" id="cwsite" /><br/><br />

<input type="submit" class="btn btn-primary"  value="Submit"/>
</form>
	</div> <!-- /span9 -->

<div class="span3">
<br /><br />
					<div class="row-fluid well">
					<h5>Choose Date and Name to View Details:</h5><br /><br />
					<h4><div class="alert alert-error" id="form_error1" style="display:none;"></div></h4>
					<h5>Date:</h5>
					<form name="bydate" method="POST" action="adminhome.php" onsubmit="return ValidateForm();">
						<p><input name="dt" type="text" value="<?php echo $setdate;?>" id="datepicker" required = "required"/></p>
						<h5>Name:</h5>
						<p>
							<?php
								$db= new Database();
								$db->connectdb();
								$table="login";
								$parameters="username";
								$where ="status = 1 ORDER BY username";
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
				<p><strong><a href="projects.php" >Projects</a></strong></p>
				<p><a href="emp_status_report.php" >Reports</a></p>	
				
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
