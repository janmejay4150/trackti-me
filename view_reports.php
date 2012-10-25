	<?php
		session_start();
		if(!isset($_SESSION['adminuser']))
			header('location:index.php');
		else
		{
			include("class_lib.php");
		
			$db= new Database();
			$db->connectdb();
			
			$eid = $_POST['uid'];
			$pid = $_POST['pid'];
			$cid = $_POST['cid'];
			$sdate = $_POST['sdate'];
			$edate = $_POST['edate'];
		
			$table = "emp_status_report";
			$parameters = "*";
			
			if(isset($_POST['uid']) && $_POST['uid'] != 0)
			{
				 
				$where="eid=$eid" ;
			}
			if(isset($_POST['pid']) && $_POST['pid'] != 0)
			{
				if(isset($where))
				{  
				  $where.=" AND pid=$pid" ;
				} 
				else
				{
					$where="pid=$pid" ;
				}
			}
			if(isset($_POST['cid']) && $_POST['cid'] != 0)
			{
				if(isset($where))
				{ 
					$where.=" AND cid=$cid" ; 
				}
				
				else
				{ 
					$where="cid=$cid" ;
				} 
			}
			if($_POST['sdate'] != 0)
			{
				//echo $where;
				if(isset($where))
				{
					$where.=" AND date >= '$sdate'";
				}
				
				else
				{
					$where ="date>='$sdate'";
				}
			}
			if($_POST['edate'] != 0)
			{
				//echo $where;
				if(isset($where))
				{
					$where.=" AND date <= '$edate'";
				}
				
				else
				{
					$where ="date<='$edate'";
				}
			}
			//echo $where;
			if(isset($where))
			{
				$where .= " ORDER BY date";
			}
			//echo $where;
			$result = $db->select_db($table,$parameters,$where);
			//print_r($result);
			//echo $where;
		}
		
	?>
	<div class="row-fluid show-grid">
						<center>
							<div class="span2">
								<strong>Date</strong>
							</div>
							<div class="span2">
								<strong>Resource</strong>
							</div>
							<div class="span2">
								<strong>Client Info</strong>
							</div>
							<div class="span3">
								<strong>Project Info</strong>
							</div>
							<div class="span3">
								<strong>Task Info</strong>
							</div>
						</center>
					</div>
				
					<?php
						$acin=1;
						foreach($result as $temp_var)
						{
							$user = $temp_var['user'];
							$client = $temp_var['client'];
							$project = $temp_var['project'];
							$t_date = date("d-m-Y",strtotime($temp_var['date']));
							$task = $temp_var['task'];
							$notes = $temp_var['notes'];							
					?>
					<div class="accordion-group" id = "<?php echo $acin;?>">
						<div class="row-fluid show-grid">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $acin; ?>">
									<center>
										<div class="span2">
											<?php echo $t_date; ?>
										</div>		
												
										<div class="span2">
											<?php echo $user; ?>
										</div>

										<div class="span2">
											<?php echo $client; ?>
										</div>
										
										<div class="span3">
											<?php echo $project; ?>
										</div>
										
										<div class="span3">
											<?php echo $task; ?>
										</div>
									</center>
								</a>		                       
							</div>	
						</div>
						<div id="collapse<?php echo $acin; ?>" class="accordion-body collapse">
							<div class="accordion-inner">
								<?php echo $notes; ?>
							</div>
						</div>
					</div><!--/accordian-group-->
					<?php
						$acin++;	
						}
					?>
				
