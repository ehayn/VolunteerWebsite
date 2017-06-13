<?php
		require_once "dbconnect.php";
		require_once "header.php";	
	
		$id = $_GET['id'];

		$sql = "SELECT * FROM VW_INCIDENT_EDIT where IID = $id";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$row = mysql_fetch_assoc($result);
		
		//Variables initilizaion
		$fn = $row['FirstName'];  //first name
		$ln = $row['LastName'];  //last name
		$da = $row['Date'];  //Date
		$dt = $row['Report'];  //Details

		$msg = "";  //printed message
		
		$fnre="*";  //validation check of first name
		$lnre="*";  //validation check of last name
		$dare="*"; //Validation check of date



		if (isset($_POST['enter']))  //if the submit button is clicked...
			{
				//pulls form info into php variables
				$fn = htmlentities(trim($_POST['firstName']));
				$ln = htmlentities(trim($_POST['lastName']));
				$da = htmlentities(trim($_POST['date']));
				$dt = htmlentities(trim($_POST['details']));
				
				
								
				//checks for blank fields
				if ($fn== ""){
					$fnre = "<span style=\"color:red\">*</span>";
				}
				
				if ($ln== ""){
					$lnre = '<span style="color:red">*</span>';
				}
				
				if ($da== ""){
					$dare = "<span style=\"color:red\">*</span>";
				}
				
				if (($fnre!="*") || ($lnre != "*") || ($dare!="*"))				
				{	
					$msg = "<br />Please enter data in these fields.<br />";
				}
				
				else {
					$fn = mysql_real_escape_string($fn);
					$ln = mysql_real_escape_string($ln);
					$dt = mysql_real_escape_string($dt);

					$sql = "call SP_FIND_VOLUNTEER_ID('".$fn."','".$ln."',@VolID)";
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$result = mysql_query("select @VolID as VolID", $conn) or die(mysql_error());
					$field = mysql_fetch_object($result);
					$vid = $field->VolID;

					$sql = "UPDATE INCIDENTREPORT SET Volunteer = '".$vid."', Date = '".$da."', Report = '".$dt."' where IID = '".$id."'";
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$msg = "Updated";
				}
			}
?>

<form action="editIncident.php?id=<?php print $id?>" method="post" class="container"> <!-- Begin form -->
		<div class="row">
<div id="bodyPan">
			<h3>Edit Registration</h3>
</div>		


<div id="bodyMiddlePan">
	<div id="MiddleLeftPan">
			<?php
				print $msg; //message is printed here if error occours
			?>	
			<div class="col-md-6">
			First Name: <?php print $fnre; ?><br />
				 <input class="form-control" type="text" list="browsersf" maxlength = "50" value="<?php print $fn; ?>" name="firstName" id="firstName" onkeyup="showHintfirst(this.value)"   /> <br />	
				<datalist id="browsersf" >
                 
				</datalist>

			Last Name: <?php print $lnre; ?><br />
				<input class="form-control" type="text" list="browsersl" maxlength = "50" value="<?php print $ln; ?>" name="lastName" id="lastName" onkeyup="showHintlast(this.value)"  />  <br />
            			<datalist id="browsersl" >

				</datalist>
            Date: <?php print $dare; ?><br />
				<input class="form-control" type="date" maxlength = "50" value="<?php print $da; ?>" name="date" id="date"   />  <br />	
 
            </div> 
	</div>
	
            <div id="MiddleRightPan">
            <div class="col-md-6">
            Details: <br />
				<textarea  class="form-control" style="width:250px;height:150px;"  name="details" id="details" /><?php print $dt ; ?> </textarea> <br />
             
			
			<input name="enter" class="btn" type="submit" value="Submit" /><br /> <!-- Submit button -->
			</div>
	    </div>
</div>
</div>
		</div>
		</form> <!-- end form -->
	</body> <!--end body -->
</html><!--end html doc -->

