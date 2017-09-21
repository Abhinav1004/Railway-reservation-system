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

    $pname=test_input($_POST['pname']);
    $date=test_input($_POST['date']);
    $seat_no=test_input($_POST['seat_no']);
    $train_no=test_input($_POST['TrainNumber']);
} 

?>

			<script>
			function validate_from()
			{
				var x=document.forms["adform"]["pname"].value;
				if(x==null || x=="")
				{
					alert("Enter your name");
					return false;
				}
				x=document.forms["adform"]["date"].value;
				if(x==null || x=="")
				{
					alert("Enter date");
					return false;
				}
				x=document.forms["adform"]["seat_no"].value;
				if(x==null || x=="")
				{
					alert("Enter seat_no no.");
					return false;
				}
				x=document.forms["adform"]["TrainNumber"].value;
				if(x==null || x=="")
				{
					alert("Enter TrainNumber no.");
					return false;
				}
				
			}
		</script>
			 
			  <div class="col-md-12 forminput">
				<form style="margin-top:25px;" name="adform" action="tickets.php" onsubmit="return validate_from()" method="post" class="form-horizontal" >
				  <div class="form-group">
					<label  class="col-sm-3 control-label">Passenger Name</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="inputEmail3" placeholder="Name" name="pname">
					</div>
				  </div>
				  <div class="form-group">
					<label  class="col-sm-3 control-label">Train Date</label>
					<div class="col-sm-8">
					  <input type="date" class="form-control" id="inputdate3" <?php if(!empty($_POST['availdate'])){ ?> value="<?=$_POST['availdate']?>" <?php } ?> name="date"/>
					</div>
				  </div>
				  <div class="form-group">
					<label  class="col-sm-3 control-label">Number of seats</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="inputEmail3" placeholder="Number of seat_no" name="seat_no">
					</div>
				  </div>
				  <div class="form-group">
					  <label  class="col-sm-3 control-label" for="sel1">Select Train Name</label>
					  <div class="col-sm-8" >
					  <select  class="form-control forminp selectform" id="sel1" name="TrainNumber">
					   <?php if(!empty($_POST['availdate'] && $_POST['trainno'])){ ?> <option value="<?=$_POST['trainno']?>"><?=$_POST['trainname']?> <?php } else { ?>
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
				
			  </div>
<?php include('../footer.php'); ?>
 

       