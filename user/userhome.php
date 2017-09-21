<?php include('header.php'); ?>
			 
			  <div class="col-md-12 menu mycss">
			
						<div class="list-group homelist">
				<?php 
						session_start();
						if($_SESSION['sid']==session_id())
						{
							$_SESSION['myvar']=session_id();
				    ?>

			  <a href="../user/view_schedule.php" class="list-group-item" >View Schedule</a>
			  <a href="../user/userbooked.php" class="list-group-item">View Your Bookings</a>
			  <a href="../user/book.php"class="list-group-item">Book Now</a>
			  <a href="../user/PNR.php"class="list-group-item">PNR Status</a>
			  <a href="../user/cancel.php"class="list-group-item">Cancel Your Booking</a>
			  <a href="../user/trains_between_stations.php" class="list-group-item">Train Between Stations</a>
			  <a href="../user/logout.php"class="list-group-item">Logout</a>
				<?php 
				     	}
						else
						{
							header("location:login.php");
						}
					?>
			</div>
			
							  </div>
<?php include('footer.php'); ?>
 

       