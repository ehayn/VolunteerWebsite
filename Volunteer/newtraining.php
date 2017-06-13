<?php
	require_once "dbconnect.php";
	require_once "header.php";

?>
	<!-- require_once "funct.php";  //imports the required functions
	require_once "dbconnect.php";
	
	$msg = ""; -->

    
      <div class="jumbotron">
        <h1>New Training Form</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div> 

	<?php
		//Variables initilizaion
		$stop = false;
		$da = "";  //Date
		$na = ""; //Training name
		$dt = ""; //Details

		$msg = "";  //printed message
		
		$dare="*"; //Validation check of email
		$nare="*"; //Validation check of training name



		if (isset($_POST['enter']))  //if the submit button is clicked...
			{
				//pulls form info into php variables
				$da = htmlentities(trim($_POST['date']));
				$na = htmlentities(trim($_POST['trainingName']));
				$dt = htmlentities(trim($_POST['details']));
				
				
								
				//checks for blank fields				
				if ($da== ""){
					$dare = "<span style=\"color:red\">*</span>";
				}
				if ($na== ""){
					$nare = "<span style=\"color:red\">*</span>";
				}
				
				if (($dare!="*") || ($nare!="*"))				
				{	
					$msg = "<br />Please enter data in these fields.<br />";
					$stop = true;
				}
				
				if(strlen($da) > 10){
					$stop = true;
					$da = "";
					$msg .= "<br />Date has an invalid date.<br />";
				} 
				if($stop){}
				else {
					$na = mysql_real_escape_string($na);
					$dt = mysql_real_escape_string($dt);

					/////////////////////////Enters into into the database here///////////////////////////////////			
					//$sql = "select count(*) as c from VOLUNTEER where FirstName = '" .$fn. "' and LastName = '" .$ln. "'";
					$sql = "call SP_COUNT_NEWTRAIN('".$na."','".$da."',@count)";
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$result = mysql_query("select @count as c", $conn) or die(mysql_error());
					//$count = 0;
					$field = mysql_fetch_object($result);
					$count = $field->c;
					if ($count > 0){
						$msg = "<b> It appears this training all ready exists in our database. </b>";
					}
					else{
						//$sql = "select vid as VolID from VOLUNTEER where FirstName = '" .$fn. "' and LastName = '" .$ln. "'";
						$sql = "call SP_INSERT_NEWTRAIN('".$na."', '".$da."', '".$dt."')";
						$result = mysql_query($sql, $conn) or die(mysql_error());
						if ($result){
							$msg = "<b> The training has been created. </b>";
						}
						
					}


					/////////////////////////Enters into into the database here///////////////////////////////////			
	
					
					//first check if the username already exists in the database
					//$sql = "select count(*) as c from USER where username = '" . $uname. "'";

					
					//$result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
					//$count = 0;
					//$field = mysql_fetch_object($result); //the query results are objects, in this case, one object
					//$count = $field->c;
					//if ($count != 0)
					//{	Header ("Location:login.php?l=r") ;
												
					//}
					//else //the username doesn't exist yet
					//{	
						
						//$sql = "insert into USER values(blaaaaaaaaaaaaaaaaaa.............)"; 
						
						//$result= mysql_query($sql, $conn) or die(mysql_error());
						//if ($result) $msg = "<b>Your information is entered into the database. </b>";					
					//}				
		
					}
			}//end submit button command
		?>

		<form action="newtraining.php" method="post"> <!-- Begin form -->
<div id="bodyPan">

</div>		
	
					

<div class="container">
    <div class="row">
	<div id="MiddleLeftPan">
			<h3>Training Registration</h3>
			<?php
				print $msg; //message is printed here if error occours
			?>	
		<div class="col-md-6">
    		Training Name:   <?php print $nare; ?><br />
            	<input class="form-control" type="text" maxlength = "50" value="<?php print $na; ?>" name="trainingName" id="trainingName"   /> <br />	
					
            
            Date: <?php print $dare; ?><br />
				<input class="form-control" type="date" maxlength = "50" value="<?php print $da; ?>" name="date" id="date"   />  <br />	
	    
 
            </div> 
            </div>
            
            <div class="col-md-6">
            Details: <br />
			    
			    <textarea  style="width:250px;height:150px;"  name="details" id="details"/> <?php print $dt ?></textarea> <br />
             
			
			<input name="enter" class="btn" type="submit" value="Submit" /><br /> <!-- Submit button -->
	    </div>
    </div>        
</div>

		</form> <!-- end form -->
	</body> <!--end body -->
</html><!--end html doc -->


