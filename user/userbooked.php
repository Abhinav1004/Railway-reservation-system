<?php include('header.php'); 
require '../dbconnect.php';
session_start();

$statement = $db->prepare("SELECT * FROM tickets WHERE passenger_name=? ");
	$statement->execute(array($_SESSION['username']));
?>

  <div class="col-md-12 forminput">
			<table class="table tablebg">
					<tr>
						<th>PNR</th>
						<th>Train Number</th>
						<th>No. Of Seats</th>
						<th>Train Status</th>
						<th>Train Date</th>
						<th>Booked On</th>
					</tr>
					
<?php 
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) { 

?>
					<tr>
						<td><?php echo $row['pnr'] ?></td>
						<td><?php echo $row['TrainNumber'] ?></td>
						<td><?php echo $row['no_of_seats'] ?></td>
						<td><?php echo $row['train_status'] ?></td>
						<td><?php echo date('d-m-y',strtotime($row['booking_date'])) ?></td>
						<td><?php echo date('d-m-y H:i:s',strtotime($row['booked_on'])) ?></td>
					</tr>
<?php } ?>
				</table></div>
<?php include('../footer.php'); ?>