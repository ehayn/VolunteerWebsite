<?php
	require_once "dbconnect.php";
	require_once "inc/util.php";
	require_once "mail/mail.class.php";
	
?>
<?php
	$type = $_GET['type'];
	$redirect = $_GET['r'];
	
	if($type == "volunteer")
	//if (isset($_POST['volunteer'])) 
	{ 
			
		$output = "";
		$table = "VW_VOLUNTEER"; // Enter Your Table Name 
		$sql = mysql_query("select * from $table");
		$columns_total = mysql_num_fields($sql);
		
		// Get The Field Name
		
		for ($i = 0; $i < $columns_total; $i++) {
		$heading = mysql_field_name($sql, $i);
		$output .= '"'.$heading.'",';
		}
		$output .="\n";
		
		// Get Records from the table
		
		while ($row = mysql_fetch_array($sql)) {
		for ($i = 0; $i < $columns_total; $i++) {
		$output .='"'.$row["$i"].'",';
		}
		$output .="\n";
		}
		
		// Download the file
		
		$filename = "VolunteerInfo.csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		
		echo $output;
		exit;

		
	}

	//if (isset($_POST['incident'])) 
	if($type == "incident")
	{
		$output = "";
		$table = "VW_INCIDENT"; // Enter Your Table Name 
		$sql = mysql_query("select * from $table");
		$columns_total = mysql_num_fields($sql);
		
		// Get The Field Name
		
		for ($i = 0; $i < $columns_total; $i++) {
		$heading = mysql_field_name($sql, $i);
		$output .= '"'.$heading.'",';
		}
		$output .="\n";
		
		// Get Records from the table
		
		while ($row = mysql_fetch_array($sql)) {
		for ($i = 0; $i < $columns_total; $i++) {
		$output .='"'.$row["$i"].'",';
		}
		$output .="\n";
		}
		
		// Download the file
		
		$filename = "IncidentReport.csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		
		echo $output;
		exit;
	}

	if ($type == "training")
	//if (isset($_POST['training'])) 
	{
		$output = "";
		$table = "VW_TRAINING"; // Enter Your Table Name 
		$sql = mysql_query("select * from $table");
		$columns_total = mysql_num_fields($sql);
		
		// Get The Field Name
		
		for ($i = 0; $i < $columns_total; $i++) {
		$heading = mysql_field_name($sql, $i);
		$output .= '"'.$heading.'",';
		}
		$output .="\n";
		
		// Get Records from the table
		
		while ($row = mysql_fetch_array($sql)) {
		for ($i = 0; $i < $columns_total; $i++) {
		$output .='"'.$row["$i"].'",';
		}
		$output .="\n";
		}
		
		// Download the file
		
		$filename = "TrainingReport.csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		
		echo $output;
		exit;
	}

	Header("Location:".$redirect);
?>
<?php
	require_once "header.php";
?>

    
      <div class="jumbotron">
        <h1>Report</h1>
	<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
      </div>  

	<form method="post">
	<div class ="col-md-4">
	<input style="display:inline;" name='volunteer' class="btn" type="image" src="contact.png" value="Download" /><br /> <!-- Submit button -->
	</div>
	<div class ="col-md-4">
        <input style="display:inline;" name='incident' class="btn" type="image" src="incident.jpg" value="D" /><br /> <!-- Submit button -->
	</div>
	<div class ="col-md-4">
	<input style="display:inline;" name='training' class="btn" type="image" src="training.jpg" value="Down" /><br /> <!-- Submit button -->
	</div>
	</form>

	</body> <!--end body -->
</html><!--end html doc -->


