<?php include('header.php'); ?>

<?php 

include("../dbconnect.php");
$flag1=0;$flag2=0;$flag3=0;$flag4=0;
session_start();
try{
if(!empty($_SESSION['myvar']))
{   
    $flag4=1;
	throw new Exception("You are logged in as an User. Please logout first <a href='../user/logout.php' style='color:red'>here</a>");
}
}
catch(Exception $w)
{
	$error_message1=$w->getMessage();
}

if(!empty($_SESSION['myvar1']))
{
	header("location: adminhome.php");
}

if(isset($_POST['form_login'])) 
{
    
    try {

        if(empty($_POST['user_name'])) {
			$flag1=1;
            throw new Exception('User Name can not be empty');
        }
        
        if(empty($_POST['password'])) {
			$flag2=1;
            throw new Exception('Password can not be empty');
        }
    
        
        $password = $_POST['password']; // admin
        $password = md5($password);
    
    
        $num=0;
                
        $statement = $db->prepare("SELECT * FROM admin_table WHERE username=? AND password=?");
        $statement->execute(array($_POST['user_name'],$password));       
        
        $num = $statement->rowCount();
        
        if($num>0) 
        {
            session_start();
            $_SESSION['sid'] = session_id();
			$_SESSION['username'] = $_POST['user_name'];
            header("location: adminhome.php");
        }
        else
        {
			$flag3=1;
            throw new Exception('Invalid Username and/or password');
        }

    }
    
    catch(Exception $e) {
        $error_message = $e->getMessage();
    }
    
}

?>
 <?php if($flag4!=1) {
	 ?>
			  <div class="col-md-12 forminput">
			  
				
				<form class="form-horizontal" method="post" action="">
				  <div class="form-group">
				  <?php if(isset($_POST['form_login']) && $flag3==1){ ?><label class="col-md-12" style="text-align:center"><?php echo $error_message;?></label><br><?php } ?>
					<label  class="col-sm-3 control-label">Admin Name</label>
					<div class="col-sm-8">
					  <input type="text" class="form-control" id="inputEmail3" placeholder="Admin Name" name="user_name">
					  <?php if(isset($_POST['form_login']) && $flag1==1){ ?><label><?php echo $error_message; } ?></label>
					</div>
				  </div>
				  <div class="form-group">
					<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
					<div class="col-sm-8">
					  <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
					  <?php if(isset($_POST['form_login']) && $flag2==1){ ?><label><?php echo $error_message; } ?></label>
					</div>
				  </div>
				 
				  <div class="form-group">
					<div class="col-sm-offset-3 col-sm-8">
					  <a><input type="submit" value="LOGIN" name="form_login" /></a>
					</div>
				  </div>
				</form>
				
			  </div>
 <?php }
 else {
	 echo "<h2 style='color:white;text-align:center'>$error_message1</h2>";
 } ?>
<?php include('footer.php'); ?>
 

       