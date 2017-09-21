<?php include('header.php'); 
require '../dbconnect.php';
session_start();
if(isset($_POST['submit']))
{
	$pname=$_POST['pname'];
	$seat_no=$_POST['seat_no'];
	$date=$_POST['date'];
	$date = date($date);
	$bookdate=date('Y-m-d H:i:s',strtotime('today IST'));
	$train_no=$_POST['TrainNumber'];
	$train_status = 'confirm';


	$statement = $db->prepare("SELECT * FROM train_status WHERE TrainNumber = ?");
	$statement->execute(array($train_no));
	$result = $statement->fetch()['available_seats'];

	if($result > $seat_no) 
	{
		$result = $result - $seat_no ;
		$random=str_shuffle("012345678915975369740582198745632109632587410756489156324");
		$pnr=substr($random,0,6);


		$statement = $db->prepare("UPDATE train_status SET available_seats=?,booked_seats=? WHERE TrainNumber=? AND available_Date = ?");
		$statement->execute(array($result,$seat_no,$train_no,$date));


		$statement = $db->prepare("INSERT INTO tickets (pnr,passenger_name,TrainNumber,no_of_seats,train_status,booking_date,booked_on) VALUES (?,?,?,?,?,?,?)");
        $statement->execute(array($pnr,$pname,$train_no,$seat_no,$train_status,$date,$bookdate));
		?>
		<div align="center" class="col-md-3">
		<table class="table tablebg">
			<tr>
				<td>Your Requested is completed </td>
			</tr>
			<tr>
				<td>You have booked : <?php echo $seat_no ;?> seats.</td>
			</tr>
			<tr>
				<td>Your PNR is : <?php echo $pnr ;?></td>
			</tr>
		</table>
		</div>
		<?php


	} else 

	{

	?>
	<div align="center" class="col-md-5">
		<table class="table tablebg">
			<tr>
				<td>Unable to book Desired Number of seats</td>
			</tr>
			<tr>
				<td>Available Seats : <?php echo $result ;?> seats.</td>
			</tr>
		</table>
	</div>
	<?php
	}

}		
?>
			 
			  <div class="col-md-12 forminput">
	

			  </div>
			</div>
		</div>
<?php include('../footer.php'); ?>
 

       