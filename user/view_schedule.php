<?php include('header.php'); 
require '../dbconnect.php';
session_start();
$flag=1;$flag1=1;
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if(isset($_POST['submit1']))
{ 
	$startdate=date('Y-m-d',strtotime($_POST['startdate']));
	$enddate=date('Y-m-d',strtotime($_POST['enddate']));
	$source_stn=test_input($_POST['source_stn']);
    $destination_stn=test_input($_POST['destination_stn']);	
    $statement = $db->prepare("SELECT trains.TrainNumber,trains.TrainName,trains.Category,train_status.available_seats,train_status.available_Date FROM trains,train_status WHERE Start=? AND End=? AND trains.TrainNumber IN (SELECT TrainNumber FROM train_status where available_Date between ? and ? ) AND trains.TrainNumber=train_status.TrainNumber");
	$statement->execute(array($source_stn , $destination_stn, $startdate, $enddate));
    $flag1=0;

	


?>	
			 
			  <div class="col-md-12 forminput">
				<table class="table tablebg">
					<tr>
						<th>Train Number</th>
						<th>Train Name</th>
						<th>Category</th>
						<th>Available Seats</th>
						<th>Available Date</th>
						<th>Booking</th>
					</tr>
<?php 
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) { 

?>
					<tr>
						<td><?php echo $row['TrainNumber'] ?> </td>
						<td><?php echo $row['TrainName'] ?> </td>
						<td><?php echo $row['Category'] ?> </td>
						<td><?php echo $row['available_seats']?></td>
						<td><?php echo $row['available_Date']?></td>
						<td><form action="book.php" method="post"><input type="submit" name="submit2" value="BOOK NOW" /><input type="date" style="display:none" name="availdate" value="<?=$row['available_Date']?>"/><input type="text" style="display:none" name="trainno" value="<?=$row['TrainNumber']?>"/><input type="text" style="display:none" name="trainname" value="<?=$row['TrainName']?>"/></form></td>
					</tr>
<?php } ?>			
				</table></div>
<?php include('footer.php');} ?>
	

<?php 
if(isset($_POST['submit']))
{ 
	$train_id=test_input($_POST['train_id']); 

    $flag=0;
    $statement = $db->prepare("SELECT * FROM trains WHERE TrainNumber= ?");
	$statement->execute(array($train_id));

	


?>	
			 
			  <div class="col-md-12 forminput">
				<table class="table tablebg">
					<tr>
						<th>Train Number</th>
						<th>Train Name</th>
						<th>Category</th>
						<th>Source Station</th>
						<th>Destination Station</th>
					</tr>
<?php 
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) { 

?>
					<tr>
						<td><?php echo $row['TrainNumber'] ?> </td>
						<td><?php echo $row['TrainName'] ?> </td>
						<td><?php echo $row['Category']?></td>
						<td><?php echo $row['Start']?></td>
						<td><?php echo $row['End']?></td>
					</tr>
<?php } ?>			
				</table>
	
	
				<table class="table tablebg">
				  <h2 style="color:#fff;">Train Schedule</h2>
					<tr>
						<th>Train ID</th>
						<th>stop number</th>
						<th>Station ID</th>
						<th>Arrival Time</th>
						<th>Departure Time</th>
					</tr>
<?php 
	$statement = $db->prepare("SELECT * FROM routes WHERE TrainNumber= ?");
	$statement->execute(array($train_id));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) { 

?>
					<tr>
						<td><?php echo $row['TrainNumber'] ?>  </td>
						<td><?php echo $row['StopNumber'] ?> </td>
						<td><?php echo $row['StationName'] ?> </td>
						<td><?php echo date('H:m | d-m-y',strtotime($row['ArrivalTime'])) ?>  </td>
						<td><?php echo date('H:m | d-m-y',strtotime($row['DepartureTime'])) ?>  </td>
					</tr>
				
			
<?php 
};
?>
</table></div>
<?php
include('footer.php'); 
}else { if($flag1!=0){
?>
			<div class="col-md-12">
				
				<form style="margin-top:50px;" class="form-horizontal forminput" action="" method="post">
				<div class="row col-md-12">
				<div class="form-group">
					  <label class="col-sm-3 control-label"  for="sel1">Start Date</label>
					   <div class="col-sm-5" >
					   <input type="date" name="startdate">
						</div>
				        </div>
			    <div class="form-group">
					  <label class="col-sm-3 control-label"  for="sel1">End Date</label>
					   <div class="col-sm-5" >
					   <input type="date" name="enddate">
						</div>
						</div>
						</div>
				<div class="form-group">
						<label class="col-sm-3 for="sel1">Source Station</label>
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
						<label class="col-sm-3 for="sel1">Destination</label>
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
					  <input type="submit" value="Submit" name="submit1" />
					</div>
				  </div>
				</form>
				
				<h2 align="center" style="color:white"> OR </h2>
				
				<form style="margin-top:50px;" class="form-horizontal forminput" action="" method="post">
				
				  <div class="form-group">
					  <label class="col-sm-3 control-label"  for="sel1">Select Train Name</label>
					   <div class="col-sm-6" >
					  <select class="form-control forminp" id="sel1" name="train_id">
					    <option value="">Select train Name ....</option>
					  
					  <?php

						$statement = $db->prepare("SELECT * FROM  trains");
						$statement->execute(array());
						$result = $statement->fetchAll(PDO::FETCH_ASSOC);
							foreach ($result as $row) {
						?>
							<option value="<?php echo $row['TrainNumber']; ?>"><?php echo $row['TrainName'];?></option>
						<?php
								}

						?>
						</select>
						</div>
					</div>
					 <div class="form-group">
					<div class="col-sm-offset-3 col-sm-10">
					  <input type="submit" value="Submit" name="submit" />
					</div>
				  </div>
				</form>
				</div>
<?php }} ?>
<?php 
if($flag==1 && $flag1==1){
include('footer.php');};
?>