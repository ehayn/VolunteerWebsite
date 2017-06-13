<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<?php

	require_once "dbconnect.php";
	require_once "inc/util.php";
	require_once "header.php";
			
?>
    
      <div class="jumbotron">
        <h1>Delete Incident Form</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div>  
	</head>

	<body><!-- begin body -->

		<?php
		
		
		//Initialization of Variables
	
		$msg = "";	
		$title = "";
		$title2 = "";	
		
		if (isset($_POST['enter'])) //when the user clicks submit...  
			{
			
			//pulls info from text fields to php variables
			
			
			
			$title = trim($_POST['title']);
			$title2 = trim($_POST['title2']);
			

						
					
			if ($title == $title2)
			{	
			
				$sql = "DELETE FROM INCIDENTREPORT WHERE IID='".$title."'"; 						
				//$sql = "call SP_UPDATE_PASSWORD('".$cnpw."','".$email."')";  I used the change form as a template. Here is the stored procedure we used as a template
				$result= mysql_query($sql, $conn) or die(mysql_error());
				$msg = "Incident deleted";
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
			<form action="deleteincident.php" method="post"> <!-- form info -->
			
            
            Please enter the ID of the Incident you want to delete	
				<input class="form-control" type="text" maxlength = "50" value="<?php print $title; ?>" name="title" id="title"   /> <br />	
				
			Please reenter the ID of the Incident you want to delete	
				<input class="form-control" type="text" maxlength = "50" value="<?php print $title2; ?>" name="title2" id="title"   /> <br />	
                 
            
                 
            
                  
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
