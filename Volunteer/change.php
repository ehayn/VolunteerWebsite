<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<?php

	require_once "dbconnect.php";
	require_once "inc/util.php";
	require_once "header.php";
		
?>

    
      <div class="jumbotron">
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
		$npw = "";
		$npw2 = "";
		
		
		
		
		if (isset($_POST['enter'])) //when the user clicks submit...  
			{
			
			//pulls info from text fields to php variables
			
			$email = htmlentities(trim($_POST['email']));
			$pw = htmlentities(trim($_POST['password']));
			$npw = htmlentities(trim($_POST['newpassword'])); 
			$npw2 = htmlentities(trim($_POST['newpassword2']));

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
				$cnpw = sha1($npw);
						
					
					if ($cpw != $code)
					{	
						$msg = "Your current password is invalid.";
					}
					else if ($npw != $npw2)
					{	
						$msg = "Your new passwords do not match.";
					}
					else
					{	
						//$sql = "UPDATE ADMIN SET Password='".$npw."' WHERE Email='".$email."'"; 						
						$sql = "call SP_UPDATE_PASSWORD('".$cnpw."','".$email."')";
						$result= mysql_query($sql, $conn) or die(mysql_error());
						$msg = "Password Changed";
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
			<form action="change.php" method="post"> <!-- form info -->
			
            
            Please enter your Email:
				 <input class="form-control" type="text" maxlength = "50" value="<?php print $email; ?>" name="email" id="email"   /> <br />	
                 
            Please enter your Current Password: 
				 <input class="form-control" type="password" maxlength = "50" value="<?php print $pw; ?>" name="password" id="password"   /> <br />	
                 
            Please enter your new Password: 
				 <input class="form-control" type="password" maxlength = "50" value="<?php print $npw; ?>" name="newpassword" id="newpassword"   /> <br />	
			
			Please reenter your new Password: 
				 <input class="form-control" type="password" maxlength = "50" value="<?php print $npw; ?>" name="newpassword2" id="newpassword2"   /> <br />	
                  
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