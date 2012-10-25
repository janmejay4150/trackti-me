<script>
	$(function() {
		$("#collapse").collapse({hide:true});
	});
</script>

<?php
	
	date_default_timezone_set('Asia/Kolkata');
	$currdate = date('Y-m-d', time());

	if($_POST['dt'])
	{			
		echo "<div>";
		echo "<h3>Details for ".date('d-M-Y',strtotime($_POST['dt']))."</h3>";
		echo "<br />";
		$dt=strtotime($_POST['dt']);
		$date=date( 'Y-m-d', $dt);
		$previous=date("Y-m-d", $dt-86400);
		$next=date("Y-m-d", dt+86400);

		$pid=$_POST['project'];
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
			$pid=base64_decode($_GET['pd']);
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
			$pid=base64_decode($_GET['pd']);
		}
	}
	
	$db= new Database();
	$db->connectdb();
	
	

	$table= "tasks";
	$parameters= "taskname,t_start,t_end,pid,notes,id,client,eid";
	$where= "t_date='".$date."' AND pid=".$pid." AND status=1";

	$result=$db->select_db($table,$parameters,$where);
	$count=$db->countdb($table,$parameters,$where); 

	$table1= "projects p,tasks t";
	$para1= "p.name";

	$table2= "login";
	$para2="username";

	$table3="tasks";

	$para4="SUM(TIME_TO_SEC(TIMEDIFF(t_end,t_start))) as total";
	$where4="pid=".$pid." and t_date='".$date."'"." AND status=1";
	$query4=$db->selectdb($table3,$para4,$where4);

	if($count < 1)
	{
		echo "<div class='row-fluid show-grid'>";
		echo "<div class='span12'>";
		echo "<h4>No results for today..</h4>";	
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
		  		<strong>Resource</strong>
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

				$where2="status=1 AND id=".$var['eid'];
				$query2= $db->selectdb($table2,$para2,$where2);
				$username=$query2['username'];
				
		?>
	<div class="accordion-group" id = "<?php echo $acin;?>">
			
		<div class="row-fluid show-grid">
				<div class="span1">
				</div>
		<div class="accordion-heading" style="margin-left:42px;">
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $acin; ?>">
				<div class="span2">
					<?php echo ucwords($username); ?>
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
	$pd=base64_encode($pid);
							
	echo "<ul class='pager'>";
    	echo "<li>";
    	echo "<a href='guesthome.php?dt=".$previous."&pd=".$pd."'>Previous Day</a>";
    	echo "</li>";
    	echo "<li>";
    	echo "<a href='guesthome.php?dt=".$next."&pd=".$pd."'>Next Day</a>";
    	echo "</li>";
    	echo "</ul>";
 	echo "</div>";
?>




