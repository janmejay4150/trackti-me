<?php
session_start();
	if(!isset($_SESSION['user']))
	header('location:index.php');
	else
{

?>

<!DOCTYPE html>
<html lang="en">
 <head>
<?php
	include("class_lib.php");
	$user=$_SESSION['user'];
	$id= $_SESSION['id'];

	date_default_timezone_set('Asia/Kolkata');
	$currdate = date('Y-m-d', time());
?>
    <meta charset="utf-8">
    <title>Timesheet | Employee</title>
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
	function checkpass()
	{//alert("ok");
		var x=document.forms["change"]["currpwd"].value;
		var y=document.forms["change"]["newpwd"].value;
		var z=document.forms["change"]["cnewpwd"].value;
		
		if(x == "" || y == "" || z == "" || x.length == 0 || y.length == 0 || z.length == 0)
		{
			if(x.length == 0 && y.length == 0 && z.length == 0)
			{
				document.getElementById("form_error").style.display="block";				
				document.getElementById("form_error").innerHTML = "All fields are mandatory!";		
				return false;
			}
			else if(x.length==0)
			{
				document.getElementById("form_error").style.display="block";				
				document.getElementById("form_error").innerHTML = "Please enter current password";		
				return false;
			}
			else if(y.length==0)
			{
				document.getElementById("form_error").style.display="block";				
				document.getElementById("form_error").innerHTML = "Please enter a new password";		
				return false;
			}
			else
			{
				document.getElementById("form_error").style.display="block";				
				document.getElementById("form_error").innerHTML = "Please retype your new password";		
				return false;
			}
		}
		else if(y!=z)
		{
			document.getElementById("form_error").style.display="block";			
			document.getElementById("form_error").innerHTML = "Passwords do not match";		
			return false;
		}
		else
		{	
				document.forms['change'].submit();
		}
			
}
	function sendmail()
	{
		var subject= $('#subject').val();
		var message= document.forms["mail"]["message"].value;
		var data = "subject="+subject+"&message="+message;
		$.post("mail.php",data,function(response){ //alert(response);
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
    <a class="brand" href="userhome.php">Ajatus Software</a>
  <div class="btn-group pull-right">
    <a class="btn btn-primary" href="#"><i class="icon-briefcase icon-white"></i> Account</a>
  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="change.php"><i class="icon-pencil"></i> Change Password</a></li>
    <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
    <li class="divider"></li>
    <li><a data-toggle="modal" href="#myModal">Feedback</a></li>
  </ul>
 </div>
  <div class="nav-collapse">
	<ul class="nav" role="navigation">
		<li><a href="userdash.php">Dashboard</a></li>
		<li class="active"><a href="userhome.php">Timesheet</a></li>
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
      <div class="row-fluid">
		<div class="span9">
<div class="alert alert-error" id="form_error" style="display:none;"><a href='#' class='close' data-dismiss='alert'>×</a><b></b></div>
		<form class="form-horizontal" name="change" method="POST" action="changepwd.php" onsubmit="return checkpass();">
<?php
		if(isset($_GET['msg1']))
		{                
			$a=$_GET['msg1'];
			if($a=="no")
			{	
				echo "<div class='alert alert-error'>";						
				echo "<h4>Your entered current password wrong!</h4>";
				echo "</div>";
			}
			elseif($a=="ok")
			{
				echo "<div class='alert alert-success'>";
				echo "<h4>Password successfully changed!</h4>";
				echo "</div>";
			}
			else
			{
				echo "<div class='alert alert-error'>";
				echo "<h4>Error: Please try again</h4>";
				echo "</div>";
			}
		}
?>
		    <legend><b>Change password</b><br /><font size="2px">Note: you can't re-use your old password once you change it!</font></legend>
		    <div class="control-group">
		      <label class="control-label">Current Password</label>
		      <div class="controls">
			<input type="password" id="currpwd" name="currpwd" placeholder="Current Password">
		      </div>
		    </div>
		    <div class="control-group">
		      <label class="control-label">New Password</label>
		      <div class="controls">
			<input type="password" id="newpwd" name="newpwd" placeholder="New Password">
		      </div>
		    </div>
			 <div class="control-group">
		      <label class="control-label">Retype Password</label>
		      <div class="controls">
			<input type="password" id="cnewpwd" name="cnewpwd" placeholder="Retype Password">
		      </div>
		    </div><br />
		    <div class="control-group">
		      <div class="controls">
			 <button type="submit" class="btn btn-success" >Change</button>
			 <button type="reset" class="btn btn-warning">Reset</button>
		      </div>
		    </div>
	       </form>
		</div> <!-- /span9 -->
			
		<div class="span3">
			
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

