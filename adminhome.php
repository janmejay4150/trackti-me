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
				date_default_timezone_set('Asia/Calcutta');
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
						padding: 9px 0;
						}
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
	<script src="docs/assets/js/bootstrap-alert.js"></script>
	<script src="dateverify.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "input:submit", ".b" ).button();
	});
	</script>
	<script type="text/javascript">
	function checkadmin(str1,str2)
	{
		var x=document.forms["admin"]["user"].value;
		var y=document.forms["admin"]["pass"].value;
		if(x == "NULL" || y == "NULL" || x.length == 0 || y.length == 0)
				alert("Empty Fields!");
			else
				document.forms['admin'].submit();
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
			<div class="row-fluid">
				<div class="span9">
					<?php
						if(isset($_POST['dt']))
						{
							echo "<p>";					
							include("bydate.php");
							echo "</p>";
						}
						elseif(isset($_GET['bt']) && isset($_GET['id']))
						{
							echo "<p>";					
							include("cbydate.php");
							echo "</p>";
						
						}
						elseif(isset($_GET['msg']))
						{
							$a=$_GET['msg'];
							if($a=="ok")
							{	
								echo "<div data-dismiss='alert' class='alert alert-success'>";						
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Success: Mail Sent!</h4>";
								echo "</div>";
								echo "<div class='hero-unit'>";
								echo "<p><h5>";
								echo "<p>";
								echo "select a Name or a Date to view employee details...";
								echo "</p>";
								echo "I never could have done what I have done without the habits of punctuality, order, and diligence, without the determination to concentrate myself on one subject at a time - Charles Dickens";
								echo "</p></h5>";
								echo "</div>";
							}
							else
							{
								echo "<div data-dismiss='alert' class='alert alert-error'>";						
								echo "<a href='#' class='close' data-dismiss='alert'>×</a>";
								echo "<h4>Error: Please Try Again!</h4>";
								echo "</div>";
								echo "<div class='hero-unit'>";
								echo "<p><h5>";
								echo "<p>";
								echo "select a Name or a Date to view employee details...";
								echo "</p>";
								echo "I never could have done what I have done without the habits of punctuality, order, and diligence, without the determination to concentrate myself on one subject at a time - Charles Dickens";
								echo "</p></h5>";
								echo "</div>";
							}
				
						}
						else
						{
							echo "<div class='hero-unit'>";
							echo "<p><h5>";
							echo "<p>";
							echo "select a Name or a Date to view employee details...";
							echo "</p>";
							echo "I never could have done what I have done without the habits of punctuality, order, and diligence, without the determination to concentrate myself on one subject at a time - Charles Dickens";
							echo "</p></h5>";
							echo "</div>";
						}
					?> 			
				</div> <!-- /span9 -->
				<div class="span3">
					<div class="row-fluid well">
					<h5>Choose Date and Name to View Details:</h5><br /><br />
					<h4><div class="alert alert-error" id="form_error1" style="display:none;"></div></h4>
					<h5>Date:</h5>
					<form name="bydate" method="POST" action="adminhome.php" onsubmit="return ValidateForm();">
						<p><input autocomplete="off" value="<?php echo $setdate;?>" name="dt" type="text" id="datepicker" /></p>
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
						<p><a href="projects.php">Projects</a></p>
						<p><a href="emp_status_report.php">Reports</a></p>	
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

