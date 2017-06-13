<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<?php

	require_once "dbconnect.php";
	require_once "inc/util.php";
	require_once "header.php";
	
	//session_start();

	//error_reporting(0); //If loggedIn is false, it throws a php error on the website saying the variable isn't recognized.
					//This hides the error for clean reporting. Remove for testing pages
	//if($_SESSION["loggedIn"] != true) 
	//{
    		//echo("Access denied!");
   		//exit();
	//}
?>

    
      <div class="jumbotron">
        <h1>Delete Admin Form</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div>  
	</head>

	<body><!-- begin body -->

		<?php
		
		
		//Initialization of Variables
	
		$msg = "";	
		$email = "";
		$email2 = "";	
		
		if (isset($_POST['enter'])) //when the user clicks submit...  
			{
			
			//pulls info from text fields to php variables
			
			
			
			$email = trim($_POST['email']);
			$email2 = trim($_POST['email2']);
			

						
					
			if ($email == $email2)
			{	
				$sql = "DELETE FROM DATABASE_USER WHERE username = '".$email."'"; 						
				//$sql = "call SP_UPDATE_PASSWORD('".$cnpw."','".$email."')";  I used the change form as a template. Here is the stored procedure we used as a template
				$result= mysql_query($sql, $conn) or die(mysql_error());
				$msg = "Admin deleted";
			}
			else $msg = "The information entered does not match with the records in our database.";
					
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
			<form action="deleteadmin.php" method="post"> <!-- form info -->
			
            
            Please enter the email of the Admin you want to delete	
				<input class="form-control" type="email" maxlength = "50" value="<?php print $email; ?>" name="email" id="email"   /> <br />	
				
			Please Reenter the email of the Admin you want to delete
				<input class="form-control" type="email" maxlength = "50" value="<?php print $email2; ?>" name="email2" id="email2"   /> <br />	
                 
            
                 
            
                  
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
