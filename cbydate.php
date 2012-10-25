<script>
	$(function() {
		$("#collapse").collapse({hide:true});
	});
</script>

<?php
	
	$id=base64_decode($_GET['id']);

	$db= new Database();
	$db->connectdb();

	$table2="login";
	$parameters2="username";
	$where2="status=1 AND id=".$id;

	$query2=$db->selectdb($table2,$parameters2,$where2);
	$emp=$query2['username'];
		
	echo "<div>";
	echo "<h3>Details for ".ucwords($emp)." on ".date('d-M-Y',strtotime($_GET['bt']))."</h3>";
	echo "<br />";

	
	$dt=strtotime($_GET['bt']);
	$date=date( 'Y-m-d', $dt);

	$previous=date("Y-m-d", $dt-86400);
	$next=date("Y-m-d", $dt+86400);
	
	$id=base64_decode($_GET['id']);

	$db= new Database();
	$db->connectdb();

	
	$table1= "tasks";
	$parameters1= "eid,taskname,t_start,t_end,pid,notes,client";
	$where1= "t_date='".$date."' and eid=".$id." AND status=1";

	$result=$db->select_db($table1,$parameters1,$where1);

	$table1= "projects p,tasks t";
	$para1= "p.name";
	
	$abc=$getid['id'];

	$total = 0;

?>
	<div class="accordion" id="accordion2">
		<div class="row-fluid show-grid">
			<div class="span1">
		  		
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
			$acin = 1;
			foreach($result as $var)
			{
				$last_date =$date;
				$date11 = strtotime($date);
				$date22 = strtotime($last_date);
				$difference = abs($date11 - $date22);
		   		$days = ceil($difference/(60*60*24*30));
				if($days == 0)
				{
					$end1 = date("H.i",strtotime($var['t_end']));
					$start1 = date("H.i",strtotime($var['t_start']));
					$start2 = strtotime($start1);
					$end2 = strtotime($end1);
					$duration1 =$end2-$start2;
					$years = abs(floor($duration1 / 31536000));
					$days = abs(floor(($duration1-($years * 31536000))/86400));
					$hours = abs(floor(($duration1-($years * 31536000)-($days * 86400))/3600));
					$mins = abs(floor(($duration1-($years * 31536000)-($days * 86400)-($hours * 3600))/60));
					$hrs = $hrs + $hours;
					$minutes = $minutes + $mins;
					if($minutes > 60)
					{
						$hrs = $hrs + 1;
						$minutes = $minutes%60;
					}

					$where1 = "p.pid='".$var['pid']."'";
					$result1 = $db->selectdb($table1,$para1,$where1);
		?>
		<div class="accordion-group" id = "<?php echo $acin;?>">
			
					<div class="row-fluid show-grid">
				<div class="accordion-heading" style="margin-left:42px;">
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $acin; ?>">
					<div class="span2">
  							<?php echo $var['client']; ?>
						</div>
						<div class="span2">
  							<?php echo $result1['name']; ?>
						</div>
	
						<div class="span3">
			<?php echo $var['taskname']; ?>
    					</div>
    					<div class="span1" style="margin-left:55px;">
			<?php echo $start1 ; ?>
						</div>
						<div class="span1">
			<?php echo $end1 ; ?>
						</div>
						<div class="span2" style="margin-left:31	px;">
			<?php echo $hours.'hr '.$mins. 'min'; ?>
						</div>		                       
					</div>	
           		</a>
        	</div>
    		<div id="collapse<?php echo $acin; ?>" class="accordion-body collapse">
        		<div class="accordion-inner">
            		<?php echo $var['notes']; ?>
            		</div>
    		</div>
    	</div>
		<?php
			}
			$acin++;
			}
		?>
			<div class="row-fluid show-grid">
		<div><br />
			<strong>Total : <?php echo $hrs. "hrs  ".$minutes. "mins"; ?></strong>
		</div>
	</div>
		
	</div>	
	
<?php	

	$id=base64_encode($id);

	echo "<ul class='pager'>";
    	echo "<li>";
    	echo "<a href='adminhome.php?bt=".$previous."&id=".$id."'>Previous</a>";
    	echo "</li>";
    	echo "<li>";
    	echo "<a href='adminhome.php?bt=".$next."&id=".$id."'>Next</a>";
    	echo "</li>";
    	echo "</ul>";
 	echo "</div>";
?>
