<?php
		require_once "dbconnect.php";
		require_once "header.php";	
	
		$id = $_GET['id'];

		$sql = "SELECT * FROM VW_TRAINING_EDIT where TID = $id";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$row = mysql_fetch_assoc($result);	

		//Variables initilizaion
		$da = $row['Date'];  //Date
		$na = $row['Title']; //Training name
		$de = $row['Notes']; //Details

		$msg = "";  //printed message
		
		$dare="*"; //Validation check of email
		$nare="*"; //Validation check of training name



		if (isset($_POST['enter']))  //if the submit button is clicked...
			{
				//pulls form info into php variables
				$da = htmlentities(trim($_POST['date']));
				$na = htmlentities(trim($_POST['trainingName']));
				$de = htmlentities(trim($_POST['details']));
				
								
				//checks for blank fields
				
				
				if ($da== ""){
					$dare = "<span style=\"color:red\">*</span>";
				}
				if ($na== ""){
					$nare = "<span style=\"color:red\">*</span>";
				}
				
				if ( ($dare!="*") || ($nare!="*"))				
				{	
					$msg = "<br />Please enter data in these fields.<br />";
				}
				
				else {
					$na = mysql_real_escape_string($na);
					$de = mysql_real_escape_string($de);

					$sql = "UPDATE TRAINING SET Title = '".$na."', Date = '".$da."', Notes = '".$de."' where TID = '".$id."'";
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$msg = "Updated";
				}
			}
?>

					
					
<form action="editTraining.php?id=<?php print $id ?>" method="post"> <!-- Begin form -->
<div id="bodyPan">

</div>		
	
					

<div class="container">
    <div class="row">
	<div id="MiddleLeftPan">
			<h3>Edit Training</h3>
			<?php
				print $msg; //message is printed here if error occours
			?>	
		<div class="col-md-6">
    		Training Name:   <?php print $nare; ?><br />
            	<input class="form-control"  type="text" maxlength = "50" value="<?php print $na; ?>" name="trainingName" id="trainingName" onkeyup="showHint2(this.value)"    /> <br />	
		
			
			            
            Date: <?php print $dare; ?><br />
				<input class="form-control" type="date" maxlength = "50" value="<?php print $da; ?>" name="date" id="date"   />  <br />	
	    
 
            </div> 
            </div>
            
            <div class="col-md-6">
            Details: <br />
			    
			    <textarea  style="width:250px;height:150px;"  name="details" id="details" /><?php print $de ?></textarea> <br />
             
			
			<input name="enter" class="btn" type="submit" value="Submit" /><br /> <!-- Submit button -->
	    </div>
    </div>        
</div>

		</form> <!-- end form -->
	</body> <!--end body -->
</html><!--end html doc -->

