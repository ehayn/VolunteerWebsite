<?php
	require_once "dbconnect.php";
	require_once "header.php";
	
?>
	    
      <div class="jumbotron">
        <h1>Volunteer Entry Form</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div>  

	<?php
		//Variables initilizaion
		$stop = false;
		$maxsizepic = 1048576;
		$acceptablepic = array('image/jpeg','image/jpg','image/gif','image/png');
		$errorspic = array();
		$maxsizefile = 2097152;
		$errorsfile = array();
		$acceptablefile = array('application/pdf', 'text/plain','image/jpeg','image/jpg','image/gif','image/png');
		$fn = "";  //first name
		$ln = "";  //last name
		$em = "";  //Email
		$ph = "";  //phone number
		$ad = "";  //Address Street
		$adc = "";  //Address City
		$ads = "";  //Address State
		$adz = "";  //Address Zip Code
		$sd = "";  //Start date
		$spf = "";  //Spouse first name
		$spl = "";  //Spouse last name
		$ed = "";  //End Date
		$bd = "";  //Birth Date
		$jb = "";  //Job title
		$pc = ""; //Picture
		$nt = ""; //Notes

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
		$fire = "*"; //Validation of Picture


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
				$pc = htmlentities(($_FILES['file']['name']));
				$nt = htmlentities($_POST['notes']);

				$ads = strtoupper($ads);

				//$sd = date('Y-m-d', strtotime($sd));
				//$ed = date('Y-m-d', strtotime($ed));
				//$bd = date('Y-m-d', strtotime($ed));
				

		
				
				
								
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
				
				if ($adz== "" || strlen($adz) != 5){
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
				if ($_FILES['file']['size'] >= $maxsizepic){
					$errorspic[] = 'File too large. File must be less than 1 megabyte.';
				}
				if ((!in_array($_FILES['file']['type'], $acceptablepic)) && (!empty($_FILES['file']["type"]))){
					$errorspic[] = 'Invalid file type. Only JPEG, JPG, GIF, and PNG types are acceptable.';
				}
				foreach($_FILES['images']['tmp_name'] as $key => $tmp_name){
					if ($_FILES['images']['size'][$key] >= $maxsizefile){
						$errorsfile[] = "" . $key.$_FILES['images']['name'][$key] . 'is too large. File must be less than 2 megabytes.';
					}
					if ((!in_array($_FILES['images']['type'][$key], $acceptablefile)) && ($key.$_FILES['images']['name'][$key] != "0")){
						print($_FILES['images']['type'][$key]);
						$errorsfile[] = "" . $key.$_FILES['images']['name'][$key] .'has an invalid file type. Only PDF, JPEG, JPG, GIF, and PNG types are acceptable.';
					}
				}

				
					if (($fnre!="*") || ($lnre != "*") || ($emre!="*") || ($phre != "*") ||($adre!="*") || ($adcre!="*") ||($adsre!="*") ||($adzre!="*") ||($sdre != "*") || ($edre != "*") ||($bdre!="*") || ($jbre != "*"))				
					{	
						$msg .= "<br />Please enter data in these fields.<br />";
						$stop = true;
					}
					if (count($errorspic) > 0){
						foreach($errorspic as $error){
							$msg .= "<br />". $error . "<br />";
						}
						$stop = true;
					}
					if (count($errorsfile) > 0){
						foreach($errorsfile as $error){
							$msg .= "<br />". $error . "<br />";
						}
						$stop = true;
					}
				if(strlen($sd) > 10){
					$stop = true;
					$sd = "";
					$msg .= "<br />Start date has an invalid date.<br />";
				} 
				if(strlen($ed) > 10){
					$stop = true;
					$ed = "";
					$msg .= "<br />End date has an invalid date.<br />";
				} 
				if(strlen($bd) > 10){
					$stop = true;
					$bd = "";
					$msg .= "<br />Birth date has an invalid date.<br />";
				}
				
				if($stop){
					
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
					
					//$sql = "select count(*) as c from VOLUNTEER where FirstName = '" .$fn. "' and LastName = '" .$ln. "' and email = '" .$em. "'";
					$sql = "Call SP_COUNT_VOLUNTEER_TRAINING('".$fn."', '".$ln."', @count)";
					
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$result = mysql_query("select @count as c", $conn) or die(mysql_error());
					//$count = 0;
					$field = mysql_fetch_object($result);
					$count = $field->c;
					if ($count != 0){
						$msg = "<b> It appears this volunteer all ready exists in our database. </b>";
					}
					else{
						$sql = "call SP_COUNT_SPOUSE('".$spf."', '".$spl."', @count)";
						$result = mysql_query($sql, $conn) or die(mysql_error());
						$result = mysql_query("select @count as c", $conn) or die(mysql_error());
						//$count = 0;
						$field = mysql_fetch_object($result);
						$count = $field->c;
					
						if (($count != 0) and ($spf != "")){
							$msg = "<b>It appears that the spouse has all ready been entered in the database. </b>";
						}
						else{
							if($spf != "" and $spl != ""){
								$sql = "call SP_INSERT_SPOUSE('".$spf."','".$spl."')";
								$result = mysql_query($sql, $conn) or die(mysql_error());
							}
						
							if ($result){
								$sql = "call SP_COUNT_ADDRESS('".$ad."', '".$adc."', '".$ads."', '".$adz."', @count)";
								$result = mysql_query($sql, $conn) or die(mysql_error());
								$result = mysql_query("select @count as c", $conn) or die(mysql_error());
								//$count = 0;
								$field = mysql_fetch_object($result);
								$count = $field->c;
								
								if($count == 0){
									$sql = "call SP_INSERT_ADDRESS('".$ad."', '".$adc."', '".$ads."', '".$adz."')";
									$result = mysql_query($sql, $conn) or die(mysql_error());
								}
								
								$sql = "call SP_FIND_SPOUSE_ID('".$spf."','".$spl."', @SID)";
								$result = mysql_query($sql, $conn) or die(mysql_error());
								$result = mysql_query("select @SID as SID", $conn) or die(mysql_error());
								$field = mysql_fetch_object($result);
								$SID = $field->SID;
								
								$sql = "call SP_FIND_ADDRESS_ID('".$ad."', '".$adc."', '".$ads."', '".$adz."', @AI)";
								$result = mysql_query($sql, $conn) or die(mysql_error());
								$result = mysql_query("select @AI as AI", $conn) or die(mysql_error());
								$field = mysql_fetch_object($result);
								$AI = $field->AI;								

								
								if (empty($_FILES["file"]["name"])){
									if(!is_dir("upload/". $fn . $ln . "/")){
										mkdir("upload/" . $fn . $ln . "/", 0700);
									}
									$pc = "upload/" . $fn . $ln . "/";
								}
								if ($_FILES["file"]["error"] > 0){
									$msg = "An error occurred while uploading the file.";
								}
								else{
									
									if(!is_dir("upload/". $fn . $ln . "/")){
										mkdir("upload/" . $fn . $ln . "/", 0700);
									}

   									if (file_exists("upload/" . $fn . $ln . "/" . $pc)){
										$msg = "file all ready exists." . $pc;
									}
									else{
      										move_uploaded_file($_FILES["file"]["tmp_name"],
										"upload/" . $fn . $ln . "/" . $pc);
										$pc = "upload/" . $fn . $ln . "/" . $pc;
									}
								}
								
								
								$sql = "call SP_INSERT_PICTURE('".$pc."')";
								$result = mysql_query($sql, $conn) or die(mysql_error());

								$sql = "call SP_FIND_PICTURE('".$pc."', @pid)";
								$result = mysql_query($sql, $conn) or die(mysql_error());
								$result = mysql_query("select @pid as PID", $conn) or die(mysql_error());
								$field = mysql_fetch_object($result);
								$pid = $field->PID;


      								$sql = "call SP_INSERT_VOLUNTEER('".$fn."', '".$ln."', '".$SID."', '".$em."','".$ph."','".$AI."','".$sd."','".$ed."','".$bd."','".$jb."', '".$pid."','".$nt."')";
																
								$result = mysql_query($sql, $conn) or die(mysql_error());

								$sql = "call SP_FIND_VOLUNTEER_ID('".$fn."', '".$ln."', @vid)";
								$result = mysql_query($sql, $conn) or die(mysql_error());
								$result = mysql_query("select @vid as VID", $conn) or die(mysql_error());
								$field = mysql_fetch_object($result);
								$vid = $field->VID;

								if (empty($_FILES['images']['name'])){
									$file_name = "";
								}
								else{
								foreach($_FILES['images']['tmp_name'] as $key => $tmp_name){
				
									$file_name = $_FILES['images']['name'][$key];
									$file_tmp = $_FILES['images']['tmp_name'][$key];
								
								if(!is_dir("upload/". $fn . $ln . "/files")){
										mkdir("upload/" . $fn . $ln . "/files/", 0700);
									}

   								if (file_exists("upload/" . $fn . $ln . "/files/" . $file_name)){
										$msg = "file all ready exists." . $file_name;
									}
						
								else{
      										move_uploaded_file($file_tmp,
										"upload/" . $fn . $ln . "/files/" . $file_name);
										$file_name = "upload/" . $fn . $ln . "/files/" . $file_name;

										

										$sql = "call SP_INSERT_FILE('".$vid."', '".$file_name."')";
										$result = mysql_query($sql, $conn) or die(mysql_error());
									}
								}
								
								

								}
								
								

								if ($result){
									$msg =  "<b>Your information is entered into the database. </b>";	
								}
							}
						}
					}
			
		
				}
			}//end submit button command
		?>
		
		<form action="volunteer.php" enctype = "multipart/form-data" method="post" class="container"> <!-- Begin form -->
			<div class="row">
<div id="bodyPan">
			<h3>Volunteer Registration</h3>
</div>		

<div id="bodyMiddlePan">
	<div id="MiddleLeftPan">
			<?php
				print $msg; //message is printed here if error occours
			?>	
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
            Phone: (Format: 1234567890) <?php print $phre; ?><br />
				<input class="form-control" type="text" maxlength = "10" value="<?php print $ph; ?>" name="phone" id="phone" placeholder = "5555555555" />  <br />
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
            State: (Format: IN) <?php print $adsre; ?><br />
				<input class="form-control" type="text" maxlength = "2" value="<?php print $ads; ?>" name="state" id="state"  placeholder = "DC"/>  <br />
	    </div>
		
			<div class="col-md-4">    	
            Zip Code: <?php print $adzre; ?><br />
				<input class="form-control" type="text" maxlength = "5" value="<?php print $adz; ?>" name="zipcode" id="zipcode"  placeholder = "20500" />  <br />
	    </div>
            </div> 
            
            <div id="MiddleRightPan">
   	    <div class="col-md-4">
            Start Date: (Format: mm/dd/yyyy) <?php print $sdre; ?><br />
				<input class="form-control" type="date" maxlength = "10" value="<?php print $sd; ?>" name="sdate" id="sdate"   />  <br />
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
			End Date: (Format: mm/dd/yyyy) <?php print $edre; ?><br />
				<input class="form-control" type="date" maxlength = "10" value="<?php print $ed; ?>" name="edate" id="edate"   />  <br />
			</div>
	
            <div class="col-md-4">   
            Birthdate: (Format: mm/dd/yyyy) <?php print $bdre; ?><br />
				<input class="form-control" type="date" maxlength = "10" value="<?php print $bd; ?>" name="bdate" id="bdate"  />  <br />
	    </div>

             <div class="col-md-4">   	
            Job title: <?php print $jbre; ?><br />
				<input class="form-control" type="text" maxlength = "50" value="<?php print $jb; ?>" name="job" id="job"  placeholder = "president" />  <br />
	    </div>
	    
	    <div class ="col-md-4">
	    Picture:
				<input class="form-control" type="file" name="file" id="file"><br>
	    </div>
	
	    <div class ="col-md-4">
	    Files:
				<input class="form-control" type = "file" name = "images[]" multiple = "multiple"><br>
	    </div>
	    <div class ="col-md-4">
	    Notes:
				<textarea class="form-control" name="notes" id="notes"><?php print $nt ?></textarea><br>
	    </div>
             
			</div>
			<br>
			
            
</div>
		</div><br>
		<input name="enter" class="btn" type="submit" value="Submit" /><br /> <!-- Submit button -->
		</form> <!-- end form -->
	</body> <!--end body -->
</html><!--end html doc -->

