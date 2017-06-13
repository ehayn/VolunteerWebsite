<?php
	require_once "dbconnect.php";
	require_once "header.php";
	
	
	$id = $_GET['id'];

	$sql = "SELECT * FROM VW_VOLUNTEER_EDIT where VID = $id";
	$result = mysql_query($sql, $conn) or die(mysql_error());
	$row = mysql_fetch_assoc($result);

	$fn = $row['FirstName'];  //first name
	$ln = $row['LastName'];  //last name
	$em = $row['Email'];  //Email
	$ph = $row['PhoneNumber']; //phone number
	$ad = $row['Street'];//Address Street
	$adc = $row['City'];  //Address City
	$ads = $row['STATE'];  //Address State
	$adz = $row['ZipCode'];  //Address Zip Code
	$sd = $row['StartDate'];  //Start date
	$spf = $row['SPFirstName'];  //Spouse first name
	$spl = $row['SPLastName'];  //Spouse last name
	$ed = $row['EndDate']; //End Date
	$bd = $row['BirthDate'];  //Birth Date
	$jb = $row['JobTitle'];;  //Job title
	//$pc = $row['PicLink']; //Picture
	$nt = $row['Notes']; //Notes

	$msg = "";  //printed message
	
	$fnre="*";  //validation check of first name
	$lnre="*";  //validation check of last name
	$emre="*"; //Validation check of email
	$phre = "*";  //Validation of phone number
	$adre = "*";  //Validation of Address Street
	$adcre = "*";  //Validation of Address City
	$adsre = "*";  //Validation of Address State
	$adzre = "*";  //Validation of Address Zip Code
	$sdre = "*";  //Validation of Start date
	$edre = "*";  //Validation of End Date
	$bdre = "*";  //Validation of Birth Date
	$jbre = "*";  //Validation of Job title

	if (isset($_POST['enter']))  //if the submit button is clicked...
	{
		//pulls form info into php variables
		
		$fn = htmlentities(trim($_POST['firstName']));
		$ln = htmlentities(trim($_POST['lastName']));
		$em = htmlentities(trim($_POST['email']));
		$ph = htmlentities(trim($_POST['phone']));
		$ad = htmlentities(trim($_POST['address']));
		$adc = htmlentities(trim($_POST['city']));
		$ads = htmlentities(trim($_POST['state']));
		$adz = htmlentities(trim($_POST['zipcode']));
		$sd = htmlentities(trim($_POST['sdate']));
		$spf = htmlentities(trim($_POST['spousef']));
		$spl = htmlentities(trim($_POST['spousel']));				
		$ed = htmlentities(trim($_POST['edate']));				
		$bd = htmlentities(trim($_POST['bdate']));
		$jb = htmlentities(trim($_POST['job']));
		//$pc = ($_FILES['file']['name']);
		$nt = htmlentities($_POST['notes']);
				

		
				
				
								
		//checks for blank fields
		if ($fn== ""){
			$fnre = "<span style=\"color:red\">*</span>";
		}
				
		if ($ln== ""){
			$lnre = '<span style="color:red">*</span>';
		}
				
		if ($em== ""){
			$emre = "<span style=\"color:red\">*</span>";
		}
				
		if ($ph== ""){
			$phre = '<span style="color:red">*</span>';
		}
				
		if ($ad== ""){
			$adre = "<span style=\"color:red\">*</span>";
		}
				
		if ($adc== ""){
			$adcre = "<span style=\"color:red\">*</span>";
		}
				
		if ($ads== ""){
			$adsre = "<span style=\"color:red\">*</span>";
		}
				
		if ($adz== ""){
			$adzre = "<span style=\"color:red\">*</span>";
		}
				
		if ($sd== ""){
			$sdre = '<span style="color:red">*</span>';
		}	
							
		if ($ed== ""){
			$edre = '<span style="color:red">*</span>';
		}
				
		if ($bd== ""){
			$bdre = "<span style=\"color:red\">*</span>";
		}
				
		if ($jb== ""){
			$jbre = '<span style="color:red">*</span>';
		}

		if (($fnre!="*") || ($lnre != "*") || ($emre!="*") || ($phre != "*") ||($adre!="*") || ($adcre!="*") ||($adsre!="*") ||($adzre!="*") ||($sdre != "*") || ($edre != "*") ||($bdre!="*") || ($jbre != "*"))				
		{	
			$msg = "<br />Please enter data in these fields.<br />";
		
		}		
		else {
					

		/////////////////////////Enters into into the database here///////////////////////////////////			
	
		$fn = mysql_real_escape_string($fn);
		$ln = mysql_real_escape_string($ln);
		$em = mysql_real_escape_string($em);
		$ph = mysql_real_escape_string($ph);
		$ad = mysql_real_escape_string($ad);
		$adc = mysql_real_escape_string($adc);
		$ads = mysql_real_escape_string($ads);
		$adz = mysql_real_escape_string($adz);
		$spf = mysql_real_escape_string($spf);
		$spl = mysql_real_escape_string($spl);
		$jb = mysql_real_escape_string($jb);
		$nt = mysql_real_escape_string($nt);

		$sql = "UPDATE VOLUNTEER SET FirstName = '".$fn."', LastName = '".$ln."', Email = '".$em."', PhoneNumber = '".$ph."', StartDate = '".$sd."', EndDate = '".$ed."', BirthDate = '".$bd."', JobTitle = '".$jb."', Notes = '".$nt."' where VID = $id";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	
		$sql = "SELECT SID FROM VOLUNTEER where VID = $id";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$row = mysql_fetch_array($result);
		$sid = $row[0];
		
		$sql = "UPDATE SPOUSE SET SPFirstName = '".$spf."', SPLastName = '".$spl."' where SID = $sid";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		
		$sql = "SELECT AI FROM VOLUNTEER where VID = $id";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$row = mysql_fetch_array($result);
		$ai = $row[0];

		$sql = "UPDATE ADDRESS SET Street = '".$ad."', City = '".$adc."', STATE = '".$ads."', ZipCode = '".$adz."' where AI = $ai";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$msg .= "The Volunteer's information has been updated";
		}
	}
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<body>

<form action="editUser.php?id=<?php print $id ?>" enctype = "multipart/form-data" method="post" class="container"> <!-- Begin form -->
			<div class="row">
<div id="bodyPan">
			<h3>Volunteer Edit</h3>
</div>		

<div id="bodyMiddlePan">
	<?php
				
				print $msg; //message is printed here if error occours
			?>
	<div id="MiddleLeftPan">
				
			<div class="col-md-4">
			First Name: <?php print $fnre; ?><br />
				 <input class="form-control" type="text" maxlength = "50" value="<?php print $fn; ?>" name="firstName" id="firstName" placeholder = "George" /> <br />	
			</div>
                 	<div class="col-md-4">
			Last Name: <?php print $lnre; ?><br />
				<input class="form-control" type="text" maxlength = "50" value="<?php print $ln; ?>" name="lastName" id="lastName" placeholder = "Washington" />  <br />
			</div>
            <div class="col-md-4">
            Email: <?php print $emre; ?><br />
				<input class="form-control" type="email" maxlength = "50" value="<?php print $em; ?>" name="email" id="email" placeholder = "firstpres@gmail.com" />  <br />	
	    </div>

            <div class="col-md-4">    
            Phone: <?php print $phre; ?><br />
				<input class="form-control" type="text" maxlength = "50" value="<?php print $ph; ?>" name="phone" id="phone" placeholder = "5555555555"  />  <br />
	    </div>

            <div class="col-md-4">    	
            Address: <?php print $adre; ?><br />
				<input class="form-control" type="text" maxlength = "100" value="<?php print $ad; ?>" name="address" id="address" placeholder = "1600 Pennsylvania Ave NW"  />  <br />
	    </div>
			
			<div class="col-md-4">    	
            City: <?php print $adcre; ?><br />
				<input class="form-control" type="text" maxlength = "100" value="<?php print $adc; ?>" name="city" id="city" placeholder = "Washington" />  <br />
	    </div>
		
			<div class="col-md-4">    	
            State: <?php print $adsre; ?><br />
				<input class="form-control" type="text" maxlength = "100" value="<?php print $ads; ?>" name="state" id="state"  placeholder = "DC" />  <br />
	    </div>
		
			<div class="col-md-4">    	
            Zip Code: <?php print $adzre; ?><br />
				<input class="form-control" type="text" maxlength = "100" value="<?php print $adz; ?>" name="zipcode" id="zipcode"  placeholder = "20500" />  <br />
	    </div>
            </div> 
            
            <div id="MiddleRightPan">
   	    <div class="col-md-4">
            Start Date: <?php print $sdre; ?><br />
				<input class="form-control" type="date" maxlength = "50" value="<?php print $sd; ?>" name="sdate" id="sdate"   />  <br />
	     </div>

             <div class="col-md-4">   	
            Spouse First Name: <br />
				<input class="form-control" type="text" maxlength = "50" value="<?php print $spf; ?>" name="spousef" id="spousef"   />  <br />
	    </div>
	    <div class="col-md-4">	
            Spouse Last Name: <br />
				<input class="form-control" type="text" maxlength = "50" value="<?php print $spl; ?>" name="spousel" id="spousel"   />  <br />
	    </div>
                	<div class="col-md-4">
			End Date: <?php print $edre; ?><br />
				<input class="form-control" type="date" maxlength = "50" value="<?php print $ed; ?>" name="edate" id="edate"   />  <br />
			</div>
	
            <div class="col-md-4">   
            Birthdate: <?php print $bdre; ?><br />
				<input class="form-control" type="date" maxlength = "50" value="<?php print $bd; ?>" name="bdate" id="bdate"   />  <br />
	    </div>

             <div class="col-md-4">   	
            Job title: <?php print $jbre; ?><br />
				<input class="form-control" type="text" maxlength = "50" value="<?php print $jb; ?>" name="job" id="job"  placeholder = "president" />  <br />
	    </div>
	    
	    
	    Notes:
				<textarea class="form-control" name="notes" id="notes"></textarea><br>
	    </div>
             
			</div>
			<br>
			
            
</div>
		</div><br>
		<input name="enter" class="btn" type="submit" value="Submit" /><br /> <!-- Submit button -->
		</form> <!-- end form -->
	</body> <!--end body -->
</html><!--end html doc -->
