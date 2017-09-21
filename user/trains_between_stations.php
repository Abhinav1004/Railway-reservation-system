<?php include('header.php'); 
require '../dbconnect.php';
session_start();
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if(isset($_POST['submit']))
{ 
	$source_stn=test_input($_POST['source_stn']);
    $destination_stn=test_input($_POST['destination_stn']);	
    	 


    $statement = $db->prepare("SELECT * FROM trains WHERE Start=? AND End=? ");
	$statement->execute(array($source_stn , $destination_stn));


?>
			  <div class="col-md-12 forminput">
			<table class="table tablebg">
					<tr>
						<th>Train Number</th>
						<th>Train Name</th>
						<th>Train Type</th>
						<th>Source Station</th>
						<th>Destination Station</th>
					</tr>
					
<?php 
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) { 

?>
					<tr>
						<td><?php echo $row['TrainNumber'] ?></td>
						<td><?php echo $row['TrainName'] ?></td>
						<td><?php echo $row['Category'] ?></td>
						<td><?php echo $row['Start'] ?></td>
						<td><?php echo $row['End'] ?></td>
					</tr>
<?php } ?>
				</table>
				
<?php 
	} else {  
?>
				<form class="form-horizontal" style="margin-top:300px;margin-left:50px;" action="" method="post">
				  <div class="form-group">
					  <label class="col-sm-2 for="sel1">Source Station</label>
					  <div class="col-sm-7">
					  <select class="form-control forminp" id="sel1" name="source_stn">
					    <option value="">Select Station ....</option>
					  
					  <?php

						$statement = $db->prepare("SELECT DISTINCT Start FROM  trains");
						$statement->execute(array());
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
						?>
							<option value="<?php echo $row['Start']; ?>"><?php echo $row['Start'];?></option>
						<?php
								}

						?>
						</select>
						</div>
					</div>
				  <div class="form-group">
					  <label class="col-sm-2 for="sel1">Destination Station</label>
					  <div class="col-sm-7">
					  <select class="form-control forminp" id="sel1" name="destination_stn">
					    <option value="">Select Station ....</option>
					  
					  <?php

						$statement = $db->prepare("SELECT DISTINCT End FROM  trains");
						$statement->execute(array());
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
						?>
							<option value="<?php echo $row['End']; ?>"><?php echo $row['End'];?></option>
						<?php
								}

						?>
						</select>
						</div>
					</div>
				  <div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
					  <a><input type="submit" value="Submit" name="submit" /></a>
					</div>
				  </div>
				</form>
<?php  } ?>
			  </div>
<?php include('../footer.php'); ?>
 

       