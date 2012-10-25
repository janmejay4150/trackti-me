<script>
	$(function() {
		$("#collapse").collapse({hide:true});
	});
</script>

<?php
			//include("class_lib.php");
			
	if($_POST['dt'] || $_GET['dt'])
	{
			if($_POST['dt'])
			{
			$db= new Database();
			$db->connectdb();
			$date=$_POST['dt'];
			$date1=explode("-",$date);
			$datef=$date1[2]."-".$date1[1]."-".$date1[0];
		

			$table2="news";
			$parameters2="*";
			$where2="status=1 AND date='$datef'";

			$res=$db->select_db($table2,$parameters2,$where2);
			}
			else if($_GET['dt'])
			{
			$db= new Database();
			$db->connectdb();
			$date=$_GET['dt'];
			$date1=explode("-",$date);
			$datef=$date1[2]."-".$date1[1]."-".$date1[0];
			

			$table2="news";
			$parameters2="*";
			$where2="status=1 AND date='$datef'";

			$res=$db->select_db($table2,$parameters2,$where2);
			}
	
	//$emp=$query2['username'];
		
	echo "<div>";
	echo "<h3>News details of $date </h3>";
	echo "<br />";


?>
	<div class="accordion" id="accordion2">
		<div class="row-fluid show-grid">
			<div class="span1">
		  		
			</div>
			<div class="span2 offset3">
				<strong>News Title</strong>
			</div>
			
		</div>	
   		<?foreach($res as $var){?>
		<div class="accordion-group" id = "<?php echo $var['slno'];?>">
			
					<div class="row-fluid show-grid">
				<div class="accordion-heading" style="margin-left:42px;">
				<div class="span1" style = "padding-top:9px;">
			<a href="newsedit.php?slno=<?php echo $var['slno']; ?>&date=<?=$date?>" style="margin-left:-28px;" ><i class="icon-edit"></i></a>&nbsp;&nbsp;
			<a href="deletenews.php?slno=<?php echo $var['slno']; ?>" style="margin-left:-5px;"><i class="icon-trash"></i></a>
		</div>
				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $var['slno']; ?>">
				
					
						<div class="span3">
  							<?php echo $var['title']; ?>
						</div>
	
							                       
					</div>	
           		</a>
        	</div>
    		<div id="collapse<?php echo $var['slno']; ?>" class="accordion-body collapse">
        		<div class="accordion-inner">
            		<?php echo $var['news_detail']; ?>
            		</div>
    		</div>
    	</div><?}?>

		
	</div>
		
	</div>	
	<?}?>

