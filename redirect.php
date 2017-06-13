<?php

session_start();//Session Variables
require_once "CMS/utility/sessionVerify.php";//Check Session timer
require_once "CMS/utility/dbconnect.php";
require_once "CMS/utility/utility.php";
require_once "CMS/utility/mail/mail.class.php";

?>
<!DOCTYPE html>
<!-- saved from url=(0040)http://getbootstrap.com/examples/signin/ -->
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="CMS/bootstrap/images/hopeicon.ico">

    <title>Site Selection</title>

    <!-- Bootstrap core CSS -->
    <link href="CMS/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="CMS/css/login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	</head>

<body>   
		
	<div class="container" style="text-align:center">
	<div align = "center">
		<br><br><a href="http://hoperesourcectr.org/"><img src="CMS/images/hopelogo.jpg" width="105" height="99" alt=""></a></br>
		<h1>Hope Resource Center</h1>
	</div>
	
		<h2 align="center" class="form-signin-heading">Site Selection</h2>
		</br></br>
	<form class="form-signin" action="Volunteer/volunteer.php">
		<button class="btn btn-lg btn-custom btn-block" value="Login" >Volunteer Management Site</button>
	</form></br>
	
	<form class="form-signin" action="CMS/CMS.php">
		<button class="btn btn-lg btn-custom btn-block" value="Login" >Contact Management Site</button>
	</form>
	
	<!-- Change Password Modal -->
	
	
	</div> 
	
</body>
</html>
