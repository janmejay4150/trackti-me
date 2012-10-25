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

	date_default_timezone_set('Asia/Kolkata');
	$currdate = date('Y-m-d', time());
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
	.modal{
		max-height: 700px;
		max-width: 800px;}
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
		$( "#datepicker,#datepicker1" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "input:submit", ".b" ).button();
		{$('#start,#end').timepicker({});}
		
	});
	</script>
	<script type="text/javascript">
	function checkform(str1,str2,str3)
	{
		var x=document.forms["taskinfo"]["task"].value;
		var y=document.forms["taskinfo"]["date"].value;
		var z=document.forms["taskinfo"]["start"].value;
		var a=document.forms["taskinfo"]["end"].value;
		var b=document.forms["taskinfo"]["notes"].value;
		var c=document.forms["taskinfo"]["client"].value;
		if(x == "" && y == "" && x.length == 0 && y.length == 0 && z == "" && a == "" && z.length == 0 && a.length == 0 && b.length == 0 && c.length == 0 && str3=="#")
		{	
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "All fields are mandatory!";		
			return false;
		}
		else if(c.length == 0)
		{	
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "Please select a client's name";		
			return false;
		}
		else if(x.length == 0)
		{	
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "Please fill a task name";		
			return false;
		}
		else if(y.length == 0)
		{	
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "Please select a date";		
			return false;
		}
		else if(z.length == 0)
		{	
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "Please select a start time";		
			return false;
		}
		else if(a.length == 0)
		{	
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "Please select a end time";		
			return false;
		}
		else if(b.length == 0)
		{	
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "Describe your task done";		
			return false;
		}
		else if(str3 == "#")
		{	
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "Please select a project";		
			return false;
		}
		else if(str1>str2)
		{
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "Your start time is ahead of your end time...";
			return false;
		}
		else
			document.forms['taskinfo'].submit();
	}

	function getpro(str)
	{
		var data = "keyword="+str;
		$.post("admin_getpro.php",data,function(response){ //alert(response);
		$('#project').html(response);});
	}
	function sendmail()
	{
		var subject= $('#subject').val();
		var message= document.forms["mail"]["message"].value;
		var data = "subject="+subject+"&message="+message;
		$.post("adminmail.php",data,function(response){ //alert(response);
		$('#submitmsg').html(response);});
	}
</script>
</head>

<body>
<div id="wrapper"  style="width:974px; margin: 0 auto;">
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
							<li class="active"><a href="admintt.php">Timesheet</a></li>
							<li><a href="employees.php">Employees</a></li>
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
<?php
		$db= new Database();
		$db->connectdb();
		
		$table0="tasks";
		$parameters0="*";
		$where0="t_date='".$currdate."' and status=1";
		
		$count0=$db->countdb($table0,$parameters0,$where0);
?> 
<?php
$table1="client_info";
$parameters1="name";
$where1="status=1";

$res1=$db->select_db($table1,$parameters1,$where1);
?>
      <div class="row-fluid">
		<div class="span9">
		<?php
			if(isset($_POST['dt']) || isset($_GET['msg2']) || isset($_GET['msg3']) || isset($_GET['msg1']) || isset($_GET['dt']))
			{
				echo "<p>";					
				include("admin_getbydate.php");
				echo "</p>";
			}
			elseif(isset($_GET['msg']))
			{
				$a=$_GET['msg'];
				if($a=="ok")
				{	
					echo "<div class='alert alert-success'>";
					echo "<a href='#' class='close' data-dismiss='alert'>×</a>";						
					echo "<h4>Success: Mail Sent!</h4>";
					echo "</div>";
				}
				else
				{
					echo "<div class='alert alert-error'>";
					echo "<a href='#' class='close' data-dismiss='alert'>×</a>";					
					echo "<h4>Error: Please Try Again!</h4>";
					echo "</div>";
				}
				
			}
				
			elseif($count0==0)
			{
				echo "<div class='hero-unit'>";
				echo "<p><h4>";
				echo "<p>";
				echo "Welcome to your TimeSheet..";
				echo "</p></h4>";
				echo "<p><h5>";
				echo "Please fill your day's work, see a day's report or edit them...its all so easy..";
				echo "</p></h5>";
				echo "</div>";				
			}
			else
			{
				echo "<p>";
				include("admin_getbydate.php");
				echo "</p>";
			}
?> 			
		</div> <!-- /span9 -->
			
		<div class="span3">
			<div class="row-fluid well">
				<h4>Select a Date to view details</h4><br />
				<div class="alert alert-error" id = "errormsg" style="display:none;"><a href='#' class='close' data-dismiss='alert'>×</a> </div>
				<form name="bydate" method="POST" action="admintt.php" onsubmit="return ValidateForm();">
				<p><input name="dt"  autocomplete="off" value="<?php echo $setdate;?>" type="text" id="datepicker"></p>
				<input type="submit" class="btn btn-primary" value="Submit" />
				</form>
				</div> <!-- /span-row1 -->
			
			<div class="row-fluid well">
			<h4>Fill up your tasks done</h4>
			<form name= "taskinfo" method="POST" action= "admin_inserttask.php" onsubmit="return checkform(start.value,end.value,project.value);">
				<div align= "left">
				<br /><div class="alert alert-error" id = "form_error" style="display:none;"><a href='#' class='close' data-dismiss='alert'>×</a></div>
				<label><b>Client</b></label>
				<input type="text" name="client" autocomplete="off" data-provide="typeahead" data-items="3" onchange="getpro(this.value)" data-source='[<?php 
                                  $len=count($res1);
                                  for($i=0;$i<$len;$i++)
                                  {
                                      echo '"'.$res1[$i]['name'].'"';
                                      if($i+1 != $len)
                                      echo ',';           
                                  }      
                                  ?>]' />                          
				<label><b>Project</b></label>
				<?php
				echo "<select name='project' id='project'>";
				echo "</select>";
				?>
				<label><b>Task</b>:</label>
				<input type="text" name="task"/>
				<label><b>Date</b>:</label>
				<input type="text" name="date" id="datepicker1">
				<label><b>Start Time</b>:</label>
				<input type="text" name="start" id="start" />
				<label><b>End Time</b>:</label>
				<input type="text" name="end" id="end"  />
				<label><b>Notes</b>:</label>
				<textarea name="notes" id="notes" rows="5" cols="5"></textarea><br /><br />
				<input type = "submit" class="btn btn-primary" value = "Submit">
				</div>	
			</form>
			</div> <!-- /span-row2 -->

									
		</div> <!-- /span3 -->
			</div><!-- /rowfluid2 -->
</div> <!--fluid -->
</div> <!--wrapper-->
</body>

    


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <!--<script src="docs/assets/js/jquery.js"></script> -->
    <script src="docs/assets/js/google-code-prettify/prettify.js"></script>
    <script src="docs/assets/js/bootstrap-transition.js"></script>
    <script src="docs/assets/js/bootstrap-alert.js"></script>
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
    <script src="docs/assets/js/application.js"></script>

   
<?php
}
?>
</html>

