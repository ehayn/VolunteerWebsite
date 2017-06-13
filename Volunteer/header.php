<?php


	require_once "dbconnect.php";
	session_start();
	if (!isset($_SESSION['userName'])) Header ("Location:../login.php") ;
	
	//
	if(!isset($_SESSION['timeout']))  Header ("Location:../login.php") ;
  	else{
		if ($_SESSION['timeout'] + 60*60 < time()) {
			Header ("Location:../login.php") ;
		}
		else {
			$_SESSION['timeout'] = time();	 
		}
	}
	
?>
<?php
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


if($_SESSION['userPermissionSite'] == 0){
		$siteSelect = '<li> <a href = "../CMS/CMS.php">Contact Management Site</a> </li>';
	}
else{
	$siteSelect = "";}
?>

	<!-- require_once "funct.php";  //imports the required functions
	require_once "dbconnect.php";
	
	
	$msg = ""; -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<!--
    Made By: Kyle Bruhn
    Date: 2/25/2014
    File Name: volunteer.php
-->
    
    <head>
        
    <title>Hope Resource Center</title>
	<link rel="shortcut icon" href="favicon.ico">
	
	<!-- Bootstrap-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link href="jumbotron-narrow.css" rel="stylesheet">

	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<!--End of Bootstrap-->
	<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />

	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="//datatables.net/download/build/nightly/jquery.dataTables.js"></script>
	<script src="jquery.jeditable.js" type="text/javascript"></script>

	<meta charset=utf-8 />
	
	</head>
	
	<body>  <!--begin body-->  

	
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Hope Resource Center</a>
        </div>
        <div class="collapse navbar-collapse">
	  <ul class = "nav navbar-nav navbar-right">
		<li><a href = "logout.php">Logout</a><li>
	  </ul>
          <ul class = "nav navbar-nav navbar-right">
		<li class = "dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Search Info<b class="caret"></b></a>
		<ul class ="dropdown-menu">
			<li><a href = searchAdmin.php> Search Admin Records </a></li>
          	<li><a href = searchVolunteer.php> Search Volunteer Records</a></li>
			<li><a href = searchIncidentReport.php> Search Incident Records </a></li>	
			<li><a href = searchTraining.php> Search Training Records </a></li>					
			<li><a href = searchAttendance.php> Search Attendance Records </a></li>
		</ul>

		<li class = "dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Enter Info <b class="caret"></b></a>
		<ul class ="dropdown-menu">
          	<li> <a href = "admin.php">Enter Admin</a> </li>
			<li> <a href = "volunteer.php">Enter Volunteer</a> </li>
          	<li> <a href = "incident.php">Enter Incident</a> </li>
          	<li> <a href = "training.php">Enter Training Attendance</a> </li>
			<li> <a href = "newtraining.php">Create New Training</a><li>
		</ul>
		<li class = "dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Features <b class="caret"></b></a>
			<ul class ="dropdown-menu">
				<li> <a href = "change.php"> Change Password</a> </li>
				<li> <a href = "forgot.php"> Forgot Password</a> </li>
				<?php echo $siteSelect ?>
				<li class="divider"></li>
				<li> <a href = "download.php?type=volunteer&r=<?php print curPageURL(); ?>"> Download Volunteer Info</a> </li>
				<li> <a href = "download.php?type=incident&r=<?php print curPageURL(); ?>"> Download Incident Info</a> </li>
				<li> <a href = "download.php?type=training&r=<?php print curPageURL(); ?>"> Download Training Info</a> </li>
			</ul>
		</li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <br>
    
	  
	  </body>