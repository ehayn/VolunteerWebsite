<?php
	require_once "dbconnect.php";
	require_once "header.php";
	
?>
			<title>Volunteer Incident Form</title>


	<script>
function showHintfirst(str)
{
var xmlhttp;
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="Enter text";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        document.getElementById("browsersf").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","gethintfirst.php?q="+str,true);
xmlhttp.send();
}

function showHintlast(str)
{
var xmlhttp;
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="Enter text";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        document.getElementById("browsersl").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","gethintlast.php?q="+str,true);
xmlhttp.send();
}

</script>


	
    
      <div class="jumbotron">
        <h1>Volunteer Incident Form</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div>  

	<?php
		//Variables initilizaion
		$stop = false;
		$fn = "";  //first name
		$ln = "";  //last name
		$da = "";  //Date
		$dt = "";

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
					$stop = true;
				}
				
				if(strlen($da) > 10){
					$stop = true;
					$da = "";
					$msg .= "<br />Date has an invalid date.<br />";
				} 
				if($stop){}
				else {
					$fn = mysql_real_escape_string($fn);
					$ln = mysql_real_escape_string($ln);
					$dt = mysql_real_escape_string($dt);

					/////////////////////////Enters into into the database here///////////////////////////////////
					//$sql = "select count(*) as c from VOLUNTEER where FirstName = '" .$fn. "' and LastName = '" .$ln. "'";
					$sql = "call SP_COUNT_VOLUNTEER_TRAINING('".$fn."','".$ln."',@count)";
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$result = mysql_query("select @count as c", $conn) or die(mysql_error());
					//$count = 0;
					$field = mysql_fetch_object($result);
					$count = $field->c;
					if ($count == 0){
						$msg = "<b> It appears this volunteer does not exist in our database. </b>";
					}
					else{		
						//$sql = "select vid as VolID from VOLUNTEER where FirstName = '" .$fn. "' and LastName = '" .$ln. "'";
						$sql = "call SP_FIND_VOLUNTEER_ID('".$fn."','".$ln."',@VolID)";
						$result = mysql_query($sql, $conn) or die(mysql_error());
						$result = mysql_query("select @VolID as VolID", $conn) or die(mysql_error());
						//$VolID = 0;
						$field = mysql_fetch_object($result);
						$VolID  = $field->VolID;
					
						//$sql = "select count(*) as c from INCIDENTREPORT where Volunteer = '" .$VolID. "' and Date = '" .$da. "'";
						$sql = "call SP_COUNT_INCIDENT('".$VolID."', '".$da."', @count)";
						$result = mysql_query($sql, $conn) or die(mysql_error());
						$result = mysql_query("select @count as c", $conn) or die(mysql_error());
						//$count = 0;
						$field = mysql_fetch_object($result);
						$count = $field->c;
					
						if ($count != 0){
							$msg = "<b> It appears this incident has all ready been reported. </b>";
						}
						else {
							//$sql = "insert into INCIDENTREPORT values('.null.','".$VolID."','".$da."','".$dt."')";
							$sql = "call SP_INSERT_INCIDENT('".$VolID."','".$da."','".$dt."')";
							$result = mysql_query($sql, $conn) or die(mysql_error());
						
							if ($result){
								$msg = "<b> The incident has been recorded </b>";
							}
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

		<form action="incident.php" method="post" class="container"> <!-- Begin form -->
		<div class="row">
<div id="bodyPan">
			<h3>Incident Registration</h3>
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
				<textarea  class="form-control" style="width:250px;height:150px;"  name="details" id="details"/><?php print $dt ?> </textarea> <br />
             
			
			<input name="enter" class="btn" type="submit" value="Submit" /><br /> <!-- Submit button -->
			</div>
	    </div>
</div>
</div>
		</div>
		</form> <!-- end form -->
	</body> <!--end body -->
</html><!--end html doc -->


