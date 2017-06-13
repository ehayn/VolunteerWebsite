<?php  session_start(); //this must be the very first line on the php page, to register this page to use session variables
	$_SESSION['timeout'] = time(); //record the time at the user login 

	require_once "dbconnect.php";

	//always initialized variables to be used
	$msg = "";	
	$email = "";
	$pw = "";

	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">


	<head>
	<!-- Bootstrap-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link href="jumbotron-narrow.css" rel="stylesheet">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<!--End of Bootstrap-->

	</head>

	<body>

      <div class="jumbotron">
        <h1>Login</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div>  


		<?php
			if (isset($_POST['enter']))
			{
				
				
				//take the information submitted and verify inputs
				$email =  htmlentities(trim($_POST['email']));
				$pw = htmlentities(trim($_POST['pw']));	
					
				$email = mysql_real_escape_string($email);
				$pw = mysql_real_escape_string($pw);				
			
				//$data = "select Password from ADMIN where Email = '" . $email. "'";
				//$code = mysql_query($data) or die(mysql_error());
				//$code = mysql_fetch_array($code);
				//$code = $code['Password'];

				$sql = "call SP_VALIDATE_PASSWORD('".$email."', @pass)";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				$result = mysql_query("select @pass as pass", $conn) or die(mysql_error());
				$field = mysql_fetch_object($result);
				$code = $field->pass;
				
				$cpw = sha1($pw);
				if ($cpw == $code)
					{							
						$_SESSION['email'] = $email;
						$_SESSION["loggedIn"] = true;						
						
						Header ("Location:volunteer.php");	
					}
				else $msg = "The information entered does not match with the records in our database.";
				
				
				
				
				/*
				
				$sql = "Call SP_COUNT_USER('".$email."', '".$pw."',@count)"; //Stored procedure. Change to actual procedure				
				
				$result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
				$result = mysql_query("select @count as c", $conn) or die(mysql_error()); 
				$field = mysql_fetch_object($result); //the query results are objects, in this case, one object
				$count = $field->c;
				print $count;
						
				if ($count > 0)
					{							
						$sql = "Call SP_COUNT_ADMIN('".$email."', '".$pw."',@uid)"; //Stored procedure. Change to actual procedure
						$result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
						$result = mysql_query("select @uid as id", $conn) or die(mysql_error()); 
						$field = mysql_fetch_object($result); //the query results are objects, in this case, one object
						$email = $field->id;					
						
						$_SESSION['email'] = $email;
						$_SESSION["loggedIn"] = true;
						
						
						Header ("Location:volunteer.php");	
					}
				else $msg = "The information entered does not match with the records in our database.";
				*/
				
				
			} 
			
	
		?>

		<form action="login.php" method="post">
        <header>
        	
			
        </header>
        
       <div id="bodyPan">
        <h1>Volunteer Management Login</h1>
        <h4>Hope Resource Center</h4>
       </div> 
       
       
       
       <div id="bodyMiddlePan">
		<?php 
				print $msg;
				$msg = "";
		?>
        
			<br />
			<div id="MiddleLeftPan">
				<div class ="col-md-4">
					Email: <input class="form-control" type="text" maxlength = "50" value="" name="email" id="email"   /> <br />
					Password: <input class="form-control" type="password" maxlength = "50" value="" name="pw" id="pw"   /> <br />
					<input name="enter" class="btn" type="submit" value="submit" />
				</div>
			</div>

			<br />
			<br />
			</div>


			<br /><br />
			<!--<a href = "change.php">Change Password</a><br />-->
		</form>

    
        
	</body>
</html>
