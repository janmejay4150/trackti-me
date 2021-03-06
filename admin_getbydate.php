<script>
	$(function() {
		$("#collapse").collapse({hide:true});
	});
</script>

<?php
	
	date_default_timezone_set('Asia/Kolkata');
	$currdate = date('Y-m-d', time());

	if(isset($_GET['msg1']))
	{                
		$a=$_GET['msg1'];
		if($a=="ok")
		{	
			echo "<div class='alert alert-success'>";						
			echo "<h4>Success: Task Added!</h4>";
			echo "</div>";
		}
		else
		{
			echo "<div class='alert alert-error'>";						
			echo "<h4>Error: Please Try Again!</h4>";
			echo "</div>";
		}
	}

	if(isset($_GET['msg2']))
	{                
		$a=$_GET['msg2'];
		if($a=="ok")
		{	
			echo "<div class='alert alert-success'>";						
			echo "<h4>Success: Task Edited!</h4>";
			echo "</div>";
		}
		else
		{
			echo "<div class='alert alert-error'>";						
			echo "<h4>Error: Please Try Again!</h4>";
			echo "</div>";
		}
	}
	
	if(isset($_GET['msg3']))
	{                
		$a=$_GET['msg3'];
		if($a=="ok")
		{	
			echo "<div class='alert alert-success'>";						
			echo "<h4>Success: Task Deleted!</h4>";
			echo "</div>";
		}
		else
		{
			echo "<div class='alert alert-error'>";						
			echo "<h4>Error: Please Try Again!</h4>";
			echo "</div>";
		}
	}
	
	if($_POST['dt'])
	{			
		echo "<div>";
		echo "<h3>Details for ".date('d-M-Y',strtotime($_POST['dt']))."</h3>";
		echo "<br />";
		$dt=strtotime($_POST['dt']);
		$date=date( 'Y-m-d', $dt);
		$previous=date("Y-m-d", $dt-86400);
		$next=date("Y-m-d", $dt+86400);
	}
	else
	{
		if($_GET['dt']=="")
		{
			echo "<div>";
			
			echo "<h3>Details for ".date('d-M-Y',strtotime($currdate))."</h3>";
			echo "<br />";
			$dt=strtotime($currdate);
			$date=date( 'Y-m-d', $dt);
			$previous=date("Y-m-d", $dt-86400);
			$next=date("Y-m-d", $dt+86400);
		}
		else	
		{
			echo "<div>";
			echo "<h3>Details for ".date('d-M-Y',strtotime($_GET['dt']))."</h3>";
			echo "<br />";
			$dt=strtotime($_GET['dt']);
			$date=date( 'Y-m-d', $dt);
			$previous=date("Y-m-d", $dt-86400);
			$next=date("Y-m-d", $dt+86400);
		}
	}
	
	$db= new Database();
	$db->connectdb();
	
	$emp=$_SESSION['adminuser'];

	$where="username='".$emp."' AND status=1";
	$eid=$db->selectdb("login","id",$where);
	$id= $eid['id'];

	$table= "tasks";
	$parameters= "taskname,t_start,t_end,pid,notes,id,client";
	$where= "t_date='".$date."' AND eid=".$id." AND status=1";

	$result=$db->select_db($table,$parameters,$where);
	$count=$db->countdb($table,$parameters,$where); 

	$table1= "projects p,tasks t";
	$para1= "p.name";

	$table2= "login";
	$para2="username";

	$table3="tasks";

	$para4="SUM(TIME_TO_SEC(TIMEDIFF(t_end,t_start))) as total";
	$where4="eid=".$id." and t_date='".$date."'"." AND status=1";
	$query4=$db->selectdb($table3,$para4,$where4);
	
	if($count < 1)
	{
		echo "<div class='row-fluid show-grid'>";
		echo "<div class='span6'>";
		echo "No results to show..";	
		echo "</div>";
		echo "</div>";
	}
	else
	{
	?>
	<div class="accordion" id="accordion2">
		<div class="row-fluid show-grid">
			<div class="span1" style = "padding-top:9px;">
		  		
			</div>
			<div class="span2">
		  		<strong>Client</strong>
			</div>
			<div class="span2">
		  		<strong>Project</strong>
			</div>
			<div class="span3">
				<strong>Tasks</strong>
			</div>
			<div class="span1">
				<strong>Start</strong>
			</div>
			<div class="span1">
				<strong>End</strong>
			</div>
			<div class="span2">
				<strong>Duration</strong>
			</div>
		</div>	
   		<?php	
			$acin=1;						
			foreach($result as $var)
			{
				$para3="TIME_TO_SEC(TIMEDIFF('".$var['t_end']."','". $var['t_start']."')) as duration";
				$query1=$db->selectdb($table3,$para3);
				
				$result1=$query1['duration']; 

				$hours = floor($result1 / 3600);
				$minutes = floor(($result1 / 60) % 60);

				$where1 = "p.pid='".$var['pid']."' and p.status=1";
				$result2 = $db->selectdb($table1,$para1,$where1);
				
		?>
	<div class="accordion-group" id = "<?php echo $acin;?>">
			
		<div class="row-fluid show-grid">
			<div class="span1" style = "padding-top:9px;">
			<a href="adminttedit.php?id=<?php echo base64_encode($var['id']); ?>" ><i class="icon-edit"></i></a>&nbsp;&nbsp;
			<a href="admin_deletetask.php?did=<?php echo base64_encode($var['id']); ?>"><i class="icon-trash"></i></a>
		</div>
		<div class="accordion-heading" style="margin-left:42px;">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $acin; ?>">
				<div class="span2">
					<?php echo $var['client']; ?>
				</div>
				<div class="span2">
					<?php echo $result2['name']; ?>
				</div>
	
				<div class="span3">
					<?php echo stripslashes($var['taskname']); ?>
				</div>
    				<div class="span1" style="margin-left:55px;">
					<?php echo "<center>".date("H:i",strtotime($var['t_start']))."</center>" ; ?>
				</div>
				<div class="span1">
					<?php echo "<center>".date("H:i",strtotime($var['t_end']))."</center>"  ; ?>
				</div>
				<div class="span2">
					<?php echo "<center>".$hours.' hr '.$minutes. ' mins</center>'; ?>
				</div>		                       
		</div>	
           		</a>
        	</div>
	    		<div id="collapse<?php echo $acin; ?>" class="accordion-body collapse">
				<div class="accordion-inner">
		    			<?php echo stripslashes($var['notes']); ?>
		    		</div>
    			</div>
    		</div><!--row fluid -->
		<?php
			$acin++;
			}
		?>
	</div>	
	<div class="row-fluid show-grid">
		<div>
			<?php
				$total=$query4['total'];
				$hrs = floor($total / 3600);
				$min = floor(($total / 60) % 60);
				
			?>
			<strong>Total : <?php echo $hrs. " hrs  ".$min. " mins"; ?></strong>
		</div>
	</div>
	<?php
	}
							
	echo "<ul class='pager'>";
    	echo "<li>";
    	echo "<a href='admintt.php?dt=".$previous."'>Previous</a>";
    	echo "</li>";
    	echo "<li>";
    	echo "<a href='admintt.php?dt=".$next."'>Next</a>";
    	echo "</li>";
    	echo "</ul>";
 	echo "</div>";
?>




