<?php
session_start();
	if(!isset($_SESSION['adminuser']))
	header('location:index.php');
	else
{

?>

<!DOCTYPE html>
<html lang="en">
 <head>
<?php
	include("class_lib.php");
	date_default_timezone_set('Asia/Calcutta');
	$setdate = date('d-m-Y', time());
	$user=$_SESSION['adminuser'];
	$id= $_SESSION['id'];

	date_default_timezone_set('Asia/Kolkata');
	$currdate = date('Y-m-d', time());
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
	<script type="text/javascript">
	function sendmail()
	{
		var subject= $('#subject').val();
		var message= document.forms["mail"]["message"].value;
		var data = "subject="+subject+"&message="+message;
		$.post("adminmail.php",data,function(response){ //alert(response);
		$('#submitmsg').html(response);});
	}
	</script>
	<style>
		#timesheet{
		width:600px;
		
		background-color: #F6F6F6;
		padding: 0;
		}
		#timesheet table{
		width:100%;
		}
		#timesheet table tr td{
		border-bottom: 1px #DDD solid;
		padding: 10px;
		width: 50%;
		}
		#timesheet table .tdleft{
		border-left: 1px #DDD solid;
		}
		#timesheet table tr td div{
		display: block;
		color: #999;
		font-size: 11px;
		padding: 0 0 2px 0;
		line-height: 1.3em;
		font-weight: normal;
		}
		#timesheet table tr td span{
		font-size: 22px;
		line-height: 1.2em;
		font-weight: normal;
		}
	</style>
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
	<textarea rows="10" cols="30" name="message" id="msg" class="text ui-widget-content ui-corner-all">
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
							<li class="active"><a href="admindash.php">Dashboard</a></li>
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
<?php
		$db= new Database();
		$db->connectdb();
		
		$table="news";
		$parameters="*";
		$where="status=1 ORDER BY slno DESC  LIMIT 5";
		
		$news=$db->select_db($table,$parameters,$where);

		$dt=strtotime($currdate); 
		$date=date( 'Y-m-d', $dt);
		$previous=date("Y-m-d", $dt-86400);

		$table1="tasks";
		$parameters1="ROUND((SUM(TIME_TO_SEC( TIMEDIFF( t_end, t_start ) ))/3600),2) AS DURATION";
		
		$where1="status=1 AND t_date='".$date."' AND eid=".$id;
		$where2="status=1 AND t_date='".$previous."' AND eid=".$id;

		$today=$db->selectdb($table1,$parameters1,$where1);
		$yesterday=$db->selectdb($table1,$parameters1,$where2);
		
		$count1=$today['DURATION'];
		$count2=$yesterday['DURATION'];

		if($count1==NULL)
			$todayhrs="0.00";
		else
			$todayhrs=$today['DURATION'];

		if($count2==NULL)
			$yesterdayhrs="0.00";
		else
			$yesterdayhrs=$yesterday['DURATION'];


		$table2="DUAL";
		$parameters2="WEEKOFYEAR('".$currdate."') AS WEEKNUM";

		$query2=$db->selectdb($table2,$parameters2);
		$weeknum=$query2['WEEKNUM'];

		$year=date('Y',strtotime($currdate));
		
		$string1="'".$year.$weeknum." SUNDAY'";
		
		$parameters3="STR_TO_DATE(".$string1.", '%X%V %W') AS Day1";
		$query3=$db->selectdb($table2,$parameters3);
		$day1=$query3['Day1'];

		$string2="'".$year.$weeknum." SATURDAY'";

		$parameters4="STR_TO_DATE(".$string2.", '%X%V %W') AS Day7";
		$query4=$db->selectdb($table2,$parameters4);
		$day7=$query4['Day7'];

		$where4="t_date BETWEEN '".$day1."' AND '".$day7."'AND status=1 AND eid =".$id;
		$query5=$db->selectdb($table1,$parameters1,$where4);

		$count3=$query5['DURATION'];

		if($count3==NULL)
			$thisweek="0.00";
		else
			$thisweek=$query5['DURATION'];

		$lweeknum=$weeknum-1;

		$string3="'".$year.$lweeknum." SUNDAY'";
		
		$parameters5="STR_TO_DATE(".$string3.", '%X%V %W') AS lday1";
		$query6=$db->selectdb($table2,$parameters5);
		$lday1=$query6['lday1'];

		$string4="'".$year.$lweeknum." SATURDAY'";

		$parameters6="STR_TO_DATE(".$string4.", '%X%V %W') AS lday7";
		$query4=$db->selectdb($table2,$parameters6);
		$lday7=$query4['lday7'];

		$where5="t_date BETWEEN '".$lday1."' AND '".$lday7."'AND status=1 AND eid =".$id;
		$query7=$db->selectdb($table1,$parameters1,$where5);

		$count4=$query7['DURATION'];

		if($count4==NULL)
			$lastweek="0.00";
		else
			$lastweek=$query7['DURATION'];


		$mdayfirst = date('Y-m-01');
		$mdaylast = date('Y-m-t'); 

		$month=date('m',strtotime($currdate)); 

		if($month==1)
		{
			$lastmonth=12;
			$year1=$year-1;
		}
		else
		{
			$lastmonth=$month-1;
			$year1=$year;
		}

			
		$firstdate= $year1."-".$lastmonth."-01";
		$lastdateofmonth=date('t',$lastmonth);
		$lastdate=$year1."-".$lastmonth."-".$lastdateofmonth;
		$fdt=strtotime($firstdate);
		$lfirstdate=date('Y-m-d',$fdt);
		$ldt=strtotime($lastdate);
		$llastdate=date('Y-m-d',$ldt);

		$where6="t_date BETWEEN '".$mdayfirst."' AND '".$mdaylast."'AND status=1 AND eid =".$id;
		$query8=$db->selectdb($table1,$parameters1,$where6);

		$count5=$query8['DURATION'];

		if($count5==NULL)
			$thismonth="0.00";
		else
			$thismonth=$query8['DURATION'];

		$where7="t_date BETWEEN '".$lfirstdate."' AND '".$llastdate."'AND status=1 AND eid =".$id;
		$query9=$db->selectdb($table1,$parameters1,$where7);

		$count6=$query9['DURATION'];

		if($count6==NULL)
			$lastmonth="0.00";
		else
			$lastmonth=$query9['DURATION'];

?> 
      <div class="row-fluid">
		<div class="span9">
		<?php
			if(isset($_GET['msg']))
			{
				$a=$_GET['msg'];
				if($a=="ok")
				{	
					echo "<div class='alert alert-success'>";
				echo "<a href='#' class='close' data-dismiss='alert'>×</a>";						
					echo "<h4>Success: Mail Sent!</h4>";
					echo "</div>";
					echo "<br /><br /><br /><center>";
					echo "<div id='timesheet'>";
					echo "<table>";
					echo "<tr><td>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours Today</div>";
					echo "<span>".$todayhrs."</span>";
					echo "</td>";
					echo "<td class='tdleft'>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours Yesterday</div>";
					echo "<span>".$yesterdayhrs."</span>";
					echo "</td></tr>";
					echo "<tr><td>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours This Week</div>";
					echo "<span>".$thisweek."</span>";
					echo "</td>";
					echo "<td class='tdleft'>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours Last Week</div>";
					echo "<span>".$lastweek."</span>";
					echo "</td></tr>";
					echo "<tr><td>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours This Month</div>";
					echo "<span>".$thismonth."</span>";
					echo "</td>";
					echo "<td class='tdleft'>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours Last Month</div>";
					echo "<span>".$lastmonth."</span>";
					echo "</td></tr>";
					echo "</table>";
					echo "</div>";
					echo "</center>";
					}
				else
				{
					echo "<div class='alert alert-error'>";
					echo "<a href='#' class='close' data-dismiss='alert'>×</a>";					
					echo "<h4>Error: Please Try Again!</h4>";
					echo "</div>";
					echo "<br /><br /><br /><center>";
					echo "<div id='timesheet'>";
					echo "<table>";
					echo "<tr><td>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours Today</div>";
					echo "<span>".$todayhrs."</span>";
					echo "</td>";
					echo "<td class='tdleft'>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours Yesterday</div>";
					echo "<span>".$yesterdayhrs."</span>";
					echo "</td></tr>";
					echo "<tr><td>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours This Week</div>";
					echo "<span>".$thisweek."</span>";
					echo "</td>";
					echo "<td class='tdleft'>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours Last Week</div>";
					echo "<span>".$lastweek."</span>";
					echo "</td></tr>";
					echo "<tr><td>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours This Month</div>";
					echo "<span>".$thismonth."</span>";
					echo "</td>";
					echo "<td class='tdleft'>";
					echo "<div><i class='icon-time'></i>&nbsp;Hours Last Month</div>";
					echo "<span>".$lastmonth."</span>";
					echo "</td></tr>";
					echo "</table>";
					echo "</div>";
					echo "</center>";
				}
				
			}
			else
			{
				echo "<br /><br /><br /><center>";
				echo "<div id='timesheet'>";
				echo "<table>";
				echo "<tr><td>";
				echo "<div><i class='icon-time'></i>&nbsp;Hours Today</div>";
				echo "<span>".$todayhrs."</span>";
				echo "</td>";
				echo "<td class='tdleft'>";
				echo "<div><i class='icon-time'></i>&nbsp;Hours Yesterday</div>";
				echo "<span>".$yesterdayhrs."</span>";
				echo "</td></tr>";
				echo "<tr><td>";
				echo "<div><i class='icon-time'></i>&nbsp;Hours This Week</div>";
				echo "<span>".$thisweek."</span>";
				echo "</td>";
				echo "<td class='tdleft'>";
				echo "<div><i class='icon-time'></i>&nbsp;Hours Last Week</div>";
				echo "<span>".$lastweek."</span>";
				echo "</td></tr>";
				echo "<tr><td>";
				echo "<div><i class='icon-time'></i>&nbsp;Hours This Month</div>";
				echo "<span>".$thismonth."</span>";
				echo "</td>";
				echo "<td class='tdleft'>";
				echo "<div><i class='icon-time'></i>&nbsp;Hours Last Month</div>";
				echo "<span>".$lastmonth."</span>";
				echo "</td></tr>";
				echo "</table>";
				echo "</div>";
				echo "</center>";

			}
			?> 	
		</div> <!-- /span9 -->
			
		<div class="span3">
			<div class="row-fluid well">
				<h3>Ajatus Times</h3><br />
				<ul>
				<?php foreach($news as $news1){?>
				<li><a href="#newsModal<?=$news1['slno']?>" data-toggle="modal"><?=$news1['title']?></a></li><?}?>
				</ul>
						<a href="#" style="float: right;">Read more</a>
			</div> <!-- /span-row1 -->

<?foreach($news as $news1){?>
				<div id="wrapper"  style="width:974px; margin: 0 auto;">
			<div class="modal hide fade in" id="newsModal<?=$news1['slno']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><?=$news1['title']?></h3>
  </div>
  <div class="modal-body">
    <p><?=$news1['news_detail']?></p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
   </div>
  </div>
</div><?}?>
<br /><br /><br />
			
			
			<div class="row-fluid well">
				<h3>Alerts</h3><br />
				<ul style="list-style-type:none; margin-left:0px;">
					<li><i class="icon-bell"></i> Congrats! Your team has won the match </li>
					<li><i class="icon-bell"></i> Your haven't filled your timesheet yesterday </li>
				</ul>
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

