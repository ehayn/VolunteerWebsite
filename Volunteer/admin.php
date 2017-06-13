<?php
	require_once "dbconnect.php";
	require_once "inc/util.php";
	require_once "mail/mail.class.php";
	require_once "header.php";

?>


    
      <div class="jumbotron">
        <h1>Admin Entry Form</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div>  

	<?php
		//Variables initilizaion
		$fn = "";  //first name
		$ln = "";  //last name
		$em = "";  //Email
		$pass = ""; //Password
		

		$msg = "";  //printed message
		
		$fnre="*";  //validation check of first name
		$lnre="*";  //validation check of last name
		$emre="*"; //Validation check of email
		


		if (isset($_POST['enter']))  //if the submit button is clicked...
			{
				//pulls form info into php variables
				$fn = htmlentities(trim($_POST['firstName']));
				$ln = htmlentities(trim($_POST['lastName']));
				$em = htmlentities(trim($_POST['email']));
				
				
				
								
				//checks for blank fields
				if ($fn== ""){
					$fnre = "<span style=\"color:red\">*</span>";
				}
				
				if ($ln== ""){
					$lnre = '<span style="color:red">*</span>';
				}
				
				if (!spamcheck($em)){
					$emre = "<span style=\"color:red\">*</span>";
					$msg = $msg . '<br/><b>Email is not valid.</b>';
				}
				

				if (($fnre!="*") || ($lnre != "*") || ($emre!="*"))
				{	
					$msg = "<br />Please enter data in these fields.<br />";
				}
				
				else {
					
					$fn = mysql_real_escape_string($fn);
					$ln = mysql_real_escape_string($ln);
					$em = mysql_real_escape_string($em);
					
					$sql = "Call SP_COUNT_ADMIN('".$fn."', '".$ln."', '".$em."', @count)";
					
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$result = mysql_query("select @count as c", $conn) or die(mysql_error());
					//$count = 0;
					$field = mysql_fetch_object($result);
					$count = $field->c;
					if ($count != 0){
						$msg = "<b> It appears this admin all ready exists in our database. </b>";
					}
					else{
						$code = randomCodeGenerator(50);
						$pass = sha1($code);
						
						$sql = "call SP_INSERT_ADMIN('".$fn."','".$ln."','".$em."','".$pass."')";
						$result = mysql_query($sql, $conn) or die(mysql_error());
						
						$subject = "Admin Password";
						$body = 'Your current password is ' . $code . '.  Please click the following link to <a href = "http://corsair.cs.iupui.edu:21477/Hope/Volunteer/change.php">change</a> your password.';
						$mailer = new Mail();
						if(($mailer->sendMail($em, $fn, $subject, $body)) == true){
							$msg = "<b>An email has been sent to the Admin's email address. Please have the new Admin change password immediately.</b>";
						}
						else{
								$msg = "Email not sent.";
						}
					}
				}
		}
	?>

		<form action="admin.php" method="post" class="container"> <!-- Begin form -->
		<div class="row">
<div id="bodyPan">
			<h3>Admin Registration</h3>
</div>		
	
			<?php
				print $msg; //message is printed here if error occours
			?>			

<div id="bodyMiddlePan">
	<div id="MiddleLeftPan">
			<div class="col-md-4">
			First Name: <?php print $fnre; ?><br />
				 <input class="form-control" type="text" maxlength = "50" value="<?php print $fn; ?>" name="firstName" id="firstName"   /> <br />	
			</div>
			<div class="col-md-4">
			Last Name: <?php print $lnre; ?><br />
				<input class="form-control" type="text" maxlength = "50" value="<?php print $ln; ?>" name="lastName" id="lastName"   />  <br />
			</div>
	    <div class="col-md-4">
            Email: <?php print $emre; ?><br />
				<input class="form-control" type="email" maxlength = "50" value="<?php print $em; ?>" name="email" id="email"   />  <br />	
             </div>
	     
			<br>
			<br>
			<br>
		</div>
		</div>
		<br>
			<input name="enter" class="btn" type="submit" value="Submit" /><br /> <!-- Submit button -->
            
</div>
		
		</form> <!-- end form -->
	</body> <!--end body -->
</html><!--end html doc -->


