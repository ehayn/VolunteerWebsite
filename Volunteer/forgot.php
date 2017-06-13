<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<?php
	require_once "dbconnect.php";
	require_once "inc/util.php";
	require_once "mail/mail.class.php";
	//require_once "header.php";


?>

        <h1>Passphrase Change Form</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div>  
	</head>

	<body><!-- begin body -->

		<?php
		
		
		//Initialization of Variables
	
		$msg = "";	
		$email = "";
		$pw = "";

		
		
		
		if (isset($_POST['enter'])) //when the user clicks submit...  
			{
			
			//pulls info from text fields to php variables
			
			$email = htmlentities(trim($_POST['email']));
			$email = mysql_real_escape_string($email);

						$code = randomCodeGenerator(10);
						$pw = sha1($code);
						
						$sql = "UPDATE DATABASE_USER SET Password='".$pw."' WHERE Email='".$email."'";
						$result = mysql_query($sql, $conn) or die(mysql_error());
						
						$subject = "Admin Password";
						$body = 'Your current password is ' . $code . '.  Please click the following link to <a href = "http://corsair.cs.iupui.edu:21467/Hope2/change.php">change</a> your password.';
						$mailer = new Mail();
						if(($mailer->sendMail($email, $email, $subject, $body)) == true){
							$msg = "<b>An email has been sent to the Admin's email address. Please have the new Admin change password immediately.</b>";
							Header('refresh:5;url= ../Hope2/login.php');
								
						}				
					

			
					
		}?> <!-- End PHP -->
        
        <header>
            

	</div>
			
        <div id="bodyPan">
        	<h3>Hope Resource Center </h3>
 		</div>  
        </header>
        
		<!-- prints user info -->
        <div id ="info"><!--div for style reasons -->
        	<div id="bodyMiddlePan">
			<form action="forgot.php" method="post"> <!-- form info -->
			
            
            Please enter your Email:
				 <input class="form-control" type="text" maxlength = "50" value="<?php print $email; ?>" name="email" id="email"   /> <br />	

                  
            <!--Submit button-->      
			<input name="enter" class="btn" type="submit" value="Submit" />
            
            <?php
				print $msg; //error messages are printed here
			?>
            <br />

					</form><!-- End form -->
                    </div>
			</div>
	</body> <!--end body -->
</html><!--end html doc -->
