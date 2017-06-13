<?php
	require_once "dbconnect.php";
	require_once "header.php";

	
?>
	
	<script>
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


</script>


	<script>
function showHint2(str)
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
        document.getElementById("browsers2").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","gethint2.php?q="+str,true);
xmlhttp.send();
}


</script>

	
	    
      <div class="jumbotron">
        <h1>Volunteer Training Form</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div> 

	<?php
		//Variables initilizaion
		$stop = false;
		$fn = "";  //first name
		$ln = "";  //last name
		$da = "";  //Date
		$na = ""; //Training name

		$msg = "";  //printed message
		
		$fnre="*";  //validation check of first name
		$lnre="*";  //validation check of last name
		$dare="*"; //Validation check of email
		$nare="*"; //Validation check of training name



		if (isset($_POST['enter']))  //if the submit button is clicked...
			{
				//pulls form info into php variables
				$fn = htmlentities(trim($_POST['firstName']));
				$ln = htmlentities(trim($_POST['lastName']));
				$da = htmlentities(trim($_POST['date']));
				$na = htmlentities(trim($_POST['trainingName']));
				
				
								
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
				if ($na== ""){
					$nare = "<span style=\"color:red\">*</span>";
				}
				if(strlen($da) > 10){
					$stop = true;
					$da = "";
					$msg .= "<br />Date has an invalid date.<br />";
				} 

				
				if (($fnre!="*") || ($lnre != "*") || ($dare!="*") || ($nare!="*"))				
				{	
					$msg = "<br />Please enter data in these fields.<br />";
					$stop = true;
				}
				if($stop){}
				else {
					$fn = mysql_real_escape_string($fn);
					$ln = mysql_real_escape_string($ln);
					$na = mysql_real_escape_string($na);

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
						$sql = "call SP_FIND_VOLUNTEER_ID('".$fn."', '".$ln."', @VolID)";
						$result = mysql_query($sql, $conn) or die(mysql_error());
						$result = mysql_query("select @VolID as VolID", $conn) or die(mysql_error());
						//$VolID = 0;
						$field = mysql_fetch_object($result);
						$VolID  = $field->VolID;

						
						//$sql = "select count(*) as c from TRAINING where Title = '" .$na. "'";
						$sql = "call SP_COUNT_TRAINING('" .$na. "', @count)";
						$result = mysql_query($sql, $conn) or die(mysql_error());
						$result = mysql_query("select @count as c", $conn) or die(mysql_error());
						//$count = 0;
						$field = mysql_fetch_object($result);
						$count = $field->c;
						if ($count == 0){
							$msg = "<b> It appears this training does not exist in our database. </b>";
						}
						else{

							
							//$sql = "select TID as TrainID from TRAINING where Title = '" .$na. "'";
							$sql = "call SP_FIND_TRAINING_ID('".$na."', @TID)";
							$result = mysql_query($sql, $conn) or die(mysql_error());
							$result = mysql_query("select @TID as TrainID", $conn) or die(mysql_error());
							//$TrainID = 0;
							$field = mysql_fetch_object($result);
							$TrainID = $field->TrainID;
					
							//$sql = "select count(*) as c from ATTENDANCE where TID = '" .$TrainID. "' and VID = '" .$VolID. "'";
							$sql = "call SP_COUNT_ATTENDANCE('".$TrainID."', '".$VolID."', @count)";
							$result = mysql_query($sql, $conn) or die(mysql_error());
							$result = mysql_query("select @count as c", $conn) or die(mysql_error());
							//$count = 0;
							$field = mysql_fetch_object($result);
							$count = $field->c;
					
							if ($count != 0){
								$msg = "<b> It appears this person has all ready attended this training. </b>";
							}
							else {
								//$sql = "insert into ATTENDANCE values('".$TrainID."','".$VolID."')";
								$sql = "call SP_INSERT_ATTENDANCE('".$TrainID."', '".$VolID."')";
								$result = mysql_query($sql, $conn) or die(mysql_error());
						
								if ($result){
									$msg = "<b> The volunteer's attendance has been recorded. </b>";
								}
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

		<form action="training.php" method="post"> <!-- Begin form -->
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
            	<input class="form-control" list="browsers2" type="text" maxlength = "50" value="<?php print $na; ?>" name="trainingName" id="trainingName" onkeyup="showHint2(this.value)"    /> <br />	
		<datalist id="browsers2">

		</datalist>
			
			First Name: <?php print $fnre; ?><br />
				 <input class="form-control" list="browsersf" type="text" maxlength = "50" value="<?php print $fn; ?>" name="firstName" id="firstName" onkeyup="showHintfirst(this.value)"  /> <br />	
				<datalist id="browsersf" >
		 
				</datalist>
			Last Name: <?php print $lnre; ?><br />
				<input class="form-control" list="browsersl" type="text" maxlength = "50" value="<?php print $ln; ?>" name="lastName" id="lastName" onkeyup="showHintlast(this.value)" />  <br />
				<datalist id="browsersl" >
		 
				</datalist>
            
            Date: <?php print $dare; ?><br />
				<input class="form-control" type="date" maxlength = "50" value="<?php print $da; ?>" name="date" id="date" min="1900-01-01" max = "2100-01-01"  />  <br />	
	    
 
            </div> 
            </div>
            
            <div class="col-md-6">
            			
			<input name="enter" class="btn" type="submit" value="Submit" /><br /> <!-- Submit button -->
	    </div>
    </div>        
</div>

		</form> <!-- end form -->
	</body> <!--end body -->
</html><!--end html doc -->


