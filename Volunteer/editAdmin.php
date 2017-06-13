<?php
		require_once "dbconnect.php";
		require_once "inc/util.php";
		require_once "header.php";	
	
		$id = $_GET['id'];

		$sql = "SELECT * FROM DATABASE_USER where userID = $id";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$row = mysql_fetch_assoc($result);

		//Variables initilizaion
		$fn = $row['firstName'];  //first name
		$ln = $row['lastName'];  //last name
		$em = $row['username'];  //Email
				

		$msg = "";  //printed message
		
		$fnre="*";  //validation check of first name
		$lnre="*";  //validation check of last name
		$emre="*"; //Validation check of email
		


		if (isset($_POST['enter']))  //if the submit button is clicked...
			{
				//pulls form info into php variables
				$fn = htmlentities(trim($_POST['firstName']));
				$ln = htmlentities(trim($_POST['lastName']));
				$em = htmlentities(trim($_POST['email']));
				
				
				
								
				//checks for blank fields
				if ($fn== ""){
					$fnre = "<span style=\"color:red\">*</span>";
				}
				
				if ($ln== ""){
					$lnre = '<span style="color:red">*</span>';
				}
				
				if (!spamcheck($em)){
					$emre = "<span style=\"color:red\">*</span>";
					$msg = $msg . '<br/><b>Email is not valid.</b>';
				}
				

				if (($fnre!="*") || ($lnre != "*") || ($emre!="*"))
				{	
					$msg = "<br />Please enter data in these fields.<br />";
				}
				
				else {
					
					$fn = mysql_real_escape_string($fn);
					$ln = mysql_real_escape_string($ln);
					$em = mysql_real_escape_string($em);

					$sql = "UPDATE DATABASE_USER SET firstName = '".$fn."', lastName = '".$ln."', username = '".$em."' where userID = $id";
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$msg = "Updated";
				}
			}
?>


<form action="editAdmin.php?id=<?php print $id ?>" method="post" class="container"> <!-- Begin form -->
		<div class="row">
<div id="bodyPan">
			<h3>Edit Admin</h3>
</div>		
	
			<?php
				print $msg; //message is printed here if error occours
			?>			

<div id="bodyMiddlePan">
	<div id="MiddleLeftPan">
			<div class="col-md-4">
			First Name: <?php print $fnre; ?><br />
				 <input class="form-control" type="text" maxlength = "50" value="<?php print $fn; ?>" name="firstName" id="firstName"   /> <br />	
			</div>
			<div class="col-md-4">
			Last Name: <?php print $lnre; ?><br />
				<input class="form-control" type="text" maxlength = "50" value="<?php print $ln; ?>" name="lastName" id="lastName"   />  <br />
			</div>
	    <div class="col-md-4">
            Email: <?php print $emre; ?><br />
				<input class="form-control" type="email" maxlength = "50" value="<?php print $em; ?>" name="email" id="email"   />  <br />	
             </div>
	     
			<br>
			<br>
			<br>
		</div>
		</div>
		<br>
			<input name="enter" class="btn" type="submit" value="Submit" /><br /> <!-- Submit button -->
            
</div>
		
		</form> <!-- end form -->
	</body> <!--end body -->
</html><!--end html doc -->
