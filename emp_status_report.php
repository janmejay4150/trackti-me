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
		function sendmail()
		{
			var subject= $('#subject').val();
			var message= document.forms["mail"]["message"].value;
			var data = "subject="+subject+"&message="+message;
			$.post("adminmail.php",data,function(response){ //alert(response);
			$('#submitmsg').html(response);});
		}
		</script>
		<script>
		$(function() {
			$("#collapse").collapse({hide:true});
			
			// For the "FROM" datepicker when changed
			
			$( "#from" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1,
				onSelect: function( selectedDate ) {
					$( "#to" ).datepicker( "option", "minDate", selectedDate );
					
		 	    var fromdt = selectedDate;
			    var todt = $('#to').val();			
			    var clntid = $('#clientdetail').val();
			    var projid = $('#projectdetail').val();
			    var empid = $('#userdetail').val();
	        
				$.post("view_reports.php", { uid: empid,cid: clntid,pid: projid,sdate:fromdt,edate: todt },function(data) {
				$('#accordion2').html(data);
			});    		
				}
			});
			
			// For the "TO" datepicker when changed
			
			$( "#to" ).datepicker({
				dateFormat: "yy-mm-dd",
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1,
				onSelect: function( selectedDate ) {
					$( "#from" ).datepicker( "option", "maxDate", selectedDate );
					var fromdt = $('#from').val();
					var todt = selectedDate;			
					var clntid = $('#clientdetail').val();
					var projid = $('#projectdetail').val();
					var empid = $('#userdetail').val();
					
						$.post("view_reports.php", { uid: empid,cid: clntid,pid: projid,sdate:fromdt,edate: todt },function(data) {
						$('#accordion2').html(data);
					});
				}
			});
			
			// This acts when the resource name is changed.
			
			$('#userdetail').change(function(){//alert("user");
				$("#from,#to").attr("value","");
				$("#clientdetail option[value='0'],#projectdetail option[value='0']").attr('selected', 'selected');
				
				var empid = $(this).val();
				var clntid = $('#clientdetail').val();
				var projid = $('#projectdetail').val();
				var fromdt = $('#from').val();
				var todt = $('#to').val();
				$.post("view_reports.php", { uid: empid,cid: clntid,pid: projid,sdate:fromdt,edate: todt },function(data) {
					$('#accordion2').html(data);
					$.post("drop_down.php",{uid: empid},function(data){//alert(response);
					$("#clientdetail").html(data);
					});
				});
			});
			
			
			// This acts when the client name is changed.
			
			$('#clientdetail').change(function(){ 		
				$("#projectdetail option[value='0']").attr('selected', 'selected');
				var clntid = $(this).val();
				var empid = $('#userdetail').val();
				var projid = $('#projectdetail').val();
				var fromdt = $('#from').val();
				var todt = $('#to').val();
				$.post("view_reports.php", { uid: empid,cid: clntid,pid: projid,sdate:fromdt,edate: todt },function(data) {
					$('#accordion2').html(data);
					$.post("drop_down.php",{cid: clntid},function(data){
					$("#projectdetail").html(data);
					});
				});
			});
			
			// This acts when the project name is changed.
			
			$('#projectdetail').change(function(){ 		
				var projid = $(this).val();
				var clntid = $('#clientdetail').val();
				var empid = $('#userdetail').val();
				var fromdt = $('#from').val();
				var todt = $('#to').val();
				$.post("view_reports.php", { uid: empid,cid: clntid,pid: projid,sdate:fromdt,edate: todt },function(data) {
					$('#accordion2').html(data);
				});
			});		
		});
		</script>
	</head>

	<body>
	
<!-- Emailing of Feedback -->

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
 
<!-- Emailing of Feedback Ends Here -->

<!-- Navigation Bar -->

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

<!-- Navigation Bar Ends Here -->

			<div class="container">
				<div class="row-fluid" style = "padding-left:10px;">
					<h1>Hello, <?php echo ucwords($user); ?>!</h1>
					<br/>
				</div> <!-- /row-fluid1-->
			</div><!--/container-->
			<div class="container">
				<div class="span12">
					<h4>Status Reports</h4>
					<div class="row-fluid well" style = "margin-left:-15px;">

									
						<?php
						
							$db= new Database();
							$db->connectdb();
						
	/* <!-- Fetching all required dropdown values from Database --> */
							
							$table_login="login";
							$parameters="id,username";
							$var=$db->select_db($table_login,$parameters);
							
							$table_client="client_info";
							$parameters1="cid,name";
							$var1=$db->select_db($table_client,$parameters1);
							
							
							$table_project="projects";
							$parameters2="pid,name";
							$var2=$db->select_db($table_project,$parameters2);
							
	/* <!-- Fetching all required dropdown values from Database Ends here --> */
	
	/* <!-- Reports Default Populated by --> */
							
							//$table_tasks="tasks";
							$table_tasks="emp_status_report";
							$parameters3="*";
							//$where="status = 1";
							$para = "username";
							$para1="name";
							$para2="name";
							
							//$var3=$db->select_db($table_tasks,$parameters3,$where);
							$var3=$db->select_db($table_tasks,$parameters3);

	/* <!-- Report default population ends here --> */
		
						?>					



<!-- Placing the Dropdowns on the page -->

						<form name="reports" id = "reports" method="POST" action="view_reports.php" style = "margin: 0 0 -8px;">
							<div class="row-fluid show-grid">
								<center>
									<div class="span3">
										<?php
											echo "<select class = 'input-medium' name='userdetail' id = 'userdetail'>";
											echo "<option value = 0>All Resources</option>";
											foreach($var as $name)
											{
												echo "<option value='" . $name['id'] . "'>" . $name['username'] . "</option>";
											}
											echo "</select>";
										?>
									</div>
									<div class="span3">
										<?php
											echo "<select class = 'input-medium' name='clientdetail' id = 'clientdetail'>";
											echo "<option value = 0>All Clients</option>";
											foreach($var1 as $name1)
											{
												echo "<option value='" . $name1['cid'] . "'>" . $name1['name'] . "</option>";
											}
											echo "</select>";
										?>
									</div>
									<div class="span3">
										<?php
											echo "<select class = 'input-medium' name='projectdetail' id = 'projectdetail'>";
											echo "<option value = 0>All Projects</option>";
											foreach($var2 as $name2)
											{
												echo "<option value='" . $name2['pid'] . "'>" . $name2['name'] . "</option>";
											}
											echo "</select>";
										?>
									</div>
									<div class="span3">
										From:<input class = "input-small" type="text" id="from" name="sdate"/>
										To:<input class = "input-small" type="text" id="to" name="edate"/>							
									</div>
								</center>
							</div><!--/row-fluid-->	
						</form>
					</div><!--/row-fluid-->
				</div><!--/span12-->
				
<!-- Placing the Dropdowns on the page ends here -->

<!-- Table Header for The Reports -->

				<div class = "span12" id = "showdata">
					<div class="row-fluid well" style = "margin-left:-15px;">
						<div class="accordion" id="accordion2">
							<div class="row-fluid show-grid">
								<center>
									<div class="span1" style="padding-left:26px;">
										<strong>Date</strong>
									</div>
									<div class="span2" style="padding-left:25px;">
										<strong>Resource</strong>
									</div>
									<div class="span2">
										<strong>Client</strong>
									</div>
									<div class="span2">
										<strong>Project</strong>
									</div>
									<div class="span3" style="padding-right:20px;">
										<strong>Task Done</strong>
									</div>
									<div class="span2" style="padding-right:34px;">
										<strong>Duration</strong>
									</div>
								</center>
							</div>

<!-- Table Header for The Reports Ends Here -->

<!-- Reports fetched, are placed in rows...starts here -->

							<?php
								$acin=1;
								foreach($var3 as $temp_var)
								{
								/*	$eid = $temp_var['eid'];
									$cid = $temp_var['cid'];
									$pid = $temp_var['pid'];
									$t_date = date("d-m-Y",strtotime($temp_var['t_date']));
									$where1="id = $eid"; 
									$where2="cid = $cid";
									$where3="pid = $pid";
									$task_name = $temp_var['taskname'];
									$notes = $temp_var['notes'];
									$ename = $db->selectdb($table_login,$para,$where1);
									$cname = $db->selectdb($table_client,$para1,$where2);
									$pname=$db->selectdb($table_project,$para2,$where3);*/
									
									$t_date=$temp_var['date'];
									$ename=$temp_var['user'];
									$cname=$temp_var['client'];
									$pname=$temp_var['project'];
									$task_name=$temp_var['task'];
									$notes=$temp_var['notes'];
									$start_time=strtotime($temp_var['t_start']);
									$end_time=strtotime($temp_var['t_end']);
									$duration=round(abs($start_time - $end_time) / 60,2);

							?>
							<div class="accordion-group" id = "<?php echo $acin;?>">
								<div class="row-fluid show-grid">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $acin; ?>">
											<center>
												<div class="span1">
													<?php echo $t_date; ?>
												</div>
												
												<div class="span2">
													<!-- <?php echo $ename['username']; ?> -->
													<?php echo ucwords($ename); ?>
												</div>

												<div class="span2">
													<!-- <?php echo $cname['name']; ?> -->
													<?php echo ucwords($cname); ?>
												</div>
										
												<div class="span2">
													<!-- <?php echo $pname['name']; ?> -->
													<?php echo ucwords($pname); ?>
												</div>
										
												<div class="span3">
													<!-- <?php echo $task_name ; ?> -->
													<?php echo ucwords($task_name); ?>
												</div>
												
												<div class="span2">
													<?php echo $duration." mins"; ?>
											</div>
											</center>
										</a>		                       
									</div>	
								</div>
								<div id="collapse<?php echo $acin; ?>" class="accordion-body collapse">
									<div class="accordion-inner">
										<?php echo ucwords($notes); ?>
									</div>
								</div>
							</div><!--/accordian-group-->
							<?php
								$acin++;	
								}
							?>
						</div><!--/accordion-->
					</div><!--/row-fluid-->
				</div> <!-- /span12 -->

<!-- Reports fetched, are placed in rows...ends here -->				
				
			</div> <!-- /container -->
		</div> <!--wrapper-->
	</body>
	<script src="docs/assets/js/bootstrap-transition.js"></script>
	<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
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
	
  <!--  <?php
		echo "<ul class='pager'>";
			echo "<li>";
				echo "<a href='#'>Previous</a>";
			echo "</li>";
			echo "<li>";
				echo "<a href='#'>Next</a>";
			echo "</li>";
    	echo "</ul>";
	}
    ?> -->
</html>
