<!DOCTYPE html>
<html lang="en">
 <head>
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
	<script src="docs/assets/js/bootstrap-alert.js"></script>

	<script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
	<script src="dateverify.js"></script>
	
	<script type="text/javascript">
	function checkform(str1,str2,str3)
	{
		document.getElementById("form_error").style.display="block";		
		var x=document.forms["taskedit"]["task"].value;
		var y=document.forms["taskedit"]["date"].value;
		var z=document.forms["taskedit"]["start"].value;
		var a=document.forms["taskedit"]["end"].value;
		var b=document.forms["taskedit"]["notes"].value;
		var c=document.forms["taskedit"]["client"].value;
		if(x == "" && y == "" && x.length == 0 && y.length == 0 && z == "" && a == "" && z.length == 0 && a.length == 0 && b.length == 0 && c.length && str3 =="#")
		{	
			document.getElementById("form_error").innerHTML = "All fields are mandatory!";		
			return false;
		}
		else if(c.length == 0)
		{	
			document.getElementById("form_error").innerHTML = "Please select a client's name";		
			return false;
		}
		else if(x.length == 0)
		{	
			document.getElementById("form_error").innerHTML = "Please fill a task name";		
			return false;
		}
		else if(y.length == 0)
		{	
			document.getElementById("form_error").innerHTML = "Please select a date";		
			return false;
		}
		else if(z.length == 0)
		{	
			document.getElementById("form_error").innerHTML = "Please select a start time";		
			return false;
		}
		else if(a.length == 0)
		{	
			document.getElementById("form_error").innerHTML = "Please select a end time";		
			return false;
		}
		else if(b.length == 0)
		{	
			document.getElementById("form_error").innerHTML = "Describe your task done";		
			return false;
		}
		else if(b.length == 0)
		{	
			document.getElementById("form_error").innerHTML = "Describe your task done";		
			return false;
		}
		else if(str3 == "#" || str3 == "")
		{	
			document.getElementById("form_error").innerHTML = "Please select a project";		
			return false;
		}
		else if(str1>str2)
		{
			document.getElementById("form_error").innerHTML = "Your start time is ahead of your end time...";
			return false;
		}
		else
		{
			document.forms['taskedit'].submit();
		}
}
function getpro(str1,str2)
	{
		var data = "keyword="+str1+"&pid="+str2;
		$.post("getproedit.php",data,function(response){ //alert(response);
		$('#project').html(response);});
	}
	
</script>
<link rel="stylesheet" type="text/css" href="lib/css/bootstrap.min.css"></link>
<link rel="stylesheet" type="text/css" href="lib/css/prettify.css"></link>
<link rel="stylesheet" type="text/css" href="src/bootstrap-wysihtml5.css"></link>
<?php
$db= new Database();
$db->connectdb();

$table1="client_info";
$parameters1="name";
$where1="status=1";
$res1=$db->select_db($table1,$parameters1,$where1);
?>
</head>

<body>
<div class="modal hide fade in" id="myModal">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">×</button>
      <h3>Feedback</h3>
    </div>
    <center><div class="modal-body">
   <form id="mail" method="POST" action="mail.php">
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
    <a class="brand" href="#">Ajatus Softwares</a>
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
    <ul class="nav">
        <li class=""><a href="userhome.php">Home</a></li>
	<li class="active"><a href="#">UserEdit</a></li>
    </ul>
  </div><!--/.nav-collapse -->
</div>
</div>
</div>



<div class="container-fluid"> <!--fluid start -->
      <div class="row-fluid">	<!--row-fluid1 start -->
             <h1>Hello, <?php echo ucwords($user); ?>!</h1>
			 <br />
      </div> <!-- /row-fluid1 -->

      <div class="row-fluid"><!--row-fluid2 start -->
<?php
					
				$db= new Database();
				$db->connectdb();

				$slno=$_GET['slno'];	
				$table="news";
				$parameters="*";
				$where= "slno=$slno";

				$result=$db->selectdb($table,$parameters,$where);




?>
		
		</div> <!-- /row-span12-1 -->
			
		<div class="hero-unit"><!--HERO -->	
			<div class="row-fluid well"><!--row-fluid2 start -->
			<div align="center"><h4>Edit your task done</h4>
			<br /><div class="alert alert-error" id = "form_error" style="display:none;"> </div>
			<form name= "taskedit" class="form-vertical" method="POST" action= "updatenews.php" >
				<br />
				
				<input type="hidden" value="<?php echo $result['slno']; ?>" name="slno"/>
				<input type="hidden" value="<?php echo $_GET['date']; ?>" name="date"/>
				  <p class="span8 offset3">      
				<label><b>Title</b>:</label>
				
				<input type="text" name="title" value="<?php echo $result['title'] ?>"/>
				
				  <textarea class="textarea"  style="width: 600px; height: 100px" name = "ndetails"><?php echo $result['news_detail'] ?></textarea>
				<input type = "submit" class="btn btn-primary" value = "Submit">
				</p>
			</form></div>
			</div> <!-- /span-row2 -->

								
		</div> <!-- /HERO -->
			
</div> <!--fluid -->
</div> <!--wrapper-->
</body>

   
<script src="lib/js/wysihtml5-0.3.0.js"></script>
<script src="lib/js/jquery-1.7.2.min.js"></script>
<script src="lib/js/prettify.js"></script>
<script src="lib/js/bootstrap.min.js"></script>
<script src="src/bootstrap-wysihtml5.js"></script>

<script>
	$('.textarea').wysihtml5();
</script>
 


    <!-- Le javascript
    ================================================== -->

  
<?php
}
?>
</html>

