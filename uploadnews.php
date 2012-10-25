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
	<script src="docs/js/bootstrap-alert.js"></script>
	<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
	<script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
	<script src="js/dateverify.js"></script>
	<script>
	$(function() {
		$( "#datepicker1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		
	});
	</script>
	<link rel="stylesheet" href="styles/token-input.css" type="text/css" />
	<link rel="stylesheet" href="styles/token-input-facebook.css" type="text/css" />
	<script type="text/javascript" src="src/jquery.tokeninput.js"></script>

	<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css"></link>
<link rel="stylesheet" type="text/css" href="lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="src/bootstrap-wysihtml5.css"></link>




	<script type="text/javascript">
	function check(str1,str2)
	{       
		var x=document.forms["addproj"]["project"].value;
		var y=document.forms["addproj"]["clientdetail"].value;
		if(x == "" || x.length == 0)
		{
			document.getElementById("form_error").style.display="block";
			document.getElementById("form_error").innerHTML = "Project Name field is empty";
			return false;
			
		}
		else if(y == "#" || y.length == 0)
		{
			document.getElementById("form_error").style.display="block";
			document.getElementById("form_error").innerHTML = "Please specify client";
			return false;
			
		}
		else
		{	document.forms['addproj'].submit();}
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
	function validation()
	{
		var proj = document.forms['assgproj']['project'].value;
		var empl = document.forms['assgproj']['users'].value;
		if(proj == "" || proj == "NULL" || empl == "" || empl == "NULL")
		{
			document.getElementById("form_error2").style.display="block";
			document.getElementById("form_error2").innerHTML = "All fields are required";
			return false;
		}
		else
		{
				document.forms['assgproj'].submit();
		}
	}
	function getpro(str)
	{
		var data = "keyword="+str;
		$.post("getallpro.php",data,function(response){ //alert(response);
		$('#allproject').html(response);});
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
   <form id="mail" method="POST" action="adminmail.php">
<fieldset>
	<p><label for="email"><h4>Your Email Id:</h4></label>
	<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all" autofocus = "autofocus"/></p>
	<p><label for="name"><h4>Subject/Topic:</h4></label>
	<input type="text" name="subject" id="subject" class="text ui-widget-content ui-corner-all" /></p>
	<p><label for="message"><h4>Message:</h4></label><br/>
	<textarea rows="10" cols="50" name="message" id="message" value="" class="text ui-widget-content ui-corner-all">
	</textarea></p>
</fieldset>
    </div><center>
    <div class="modal-footer">
      <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
      <button class="btn btn-primary" type="submit">Submit</button>
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
   <ul class="nav">
      <li><a href="admintt.php">My Timesheet</a></li>	
      <li class="active"><a href="projects.php">Projects</a></li>
      <li><a href="manageprojects.php">Manage Project</a></li>
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

<?php
	if($_POST['dt'] || $_GET['dt'])
	{
		?>
		<div class="row-fluid">
			<div class="span9"><br /><br />

		<br /><?					
		include("newsbydate.php");
		?>
		<br /><br />
		<br /><br />
		  
		</div>
		 <?
	}
if(isset($_GET['msg1']))
	{                
		$a=$_GET['msg1'];
		if($a=="ok")
		{	
			echo "<div class='alert alert-success'>";
			echo "<h4>Success: News Added!</h4>";
			echo "</div>";
		}
		else
		{
			echo "<div class='alert alert-error'>";
			echo "<h4>Error: Please Try Again!</h4>";
			echo "</div>";
		}
	}
if(isset($_GET['msgdel']))
	{                
		$a=$_GET['msgdel'];
		if($a=="ok")
		{	
			echo "<div class='alert alert-success'>";
			echo "<h4>Success: News Deleted!</h4>";
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
<?if(!$_POST && !$_GET['dt']){?>
<div class="row-fluid">
	<div class="span9">
<br /><br />
<h4>Upload News</h4>
<br />
<h4><div class="alert alert-error" id="form_error" style="display:none;"></div></h4>
<form class="form-horizontal" name="addnews" method="POST" action="addnews.php">
	<p>
	
	
		
	</p>
	
	
    <p><h5>Title:</h5><input type="text" name="title" id = "title" autofocus = "autofocus" required = "required"></p>
    <p class="well">
 <textarea class="textarea" placeholder="Enter text ..." style="width: 600px; height: 100px" name = "ndetails"></textarea>
 </p>
   <input class="btn btn-primary" type="submit" id="clsubmit" value="Submit" >
</form>

<br /><br />

	
	
	<br /><br />
  
</div> <!-- /span9 -->
<script src="lib/js/wysihtml5-0.3.0.js"></script>
<script src="lib/js/jquery-1.7.2.min.js"></script>
<script src="lib/js/prettify.js"></script>
<script src="lib/js/bootstrap.min.js"></script>
<script src="src/bootstrap-wysihtml5.js"></script>

<script>  var $a = jQuery.noConflict();
	$a('.textarea').wysihtml5();
</script>

<script type="text/javascript" charset="utf-8">
 var $b = jQuery.noConflict();
	$b(prettyPrint);
</script>
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
<?}?>

<div class="span3">
					<div class="row-fluid well">
					<h5>Choose Date to View News Details:</h5><br /><br />
					<h4><div class="alert alert-error" id="form_error1" style="display:none;"></div></h4>
					<h5>Date:</h5>
					<form name="bydate" method="POST" action="uploadnews.php" >
						<p><input name="dt"  autocomplete="off" value="<?php echo $setdate;?>" type="text" id="datepicker1" /></p>
						
						<input type="submit" class="btn btn-primary"  value="View"/>
					</form>
				</div> <!-- /span-row2 -->
				
<div class="row-fluid well">
				<p><a href="employees.php" >Employees</a></p>
				<p><a href="projects.php" >Projects</a></p>
				<p><a href="emp_status_report.php" >Reports</a></p>	
				<p><strong><a href="uploadnews.php">News</a></strong></p>
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
