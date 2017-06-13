<?php
	session_start();
	require_once "dbconnect.php";
	//require_once "header.php";

	
	if($_SESSION["loggedIn"] != true) {	
   		Header ("Location:../login.php");
		exit();
	}

	if (!isset($_SESSION['email'])) Header ("Location:../login.php") ;
	
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


	$array = array(
		'VOLUNTEER' => 'VID',
		'DATABASE_USER' => 'userID',
		'INCIDENTREPORT' => 'IID',
		'TRAINING' => 'TID');
	$type = $_GET['type'];
	$type2 = strtoupper($type);
	if($type2 == "ADMIN"){
		$type2 = "DATABASE_USER";
	}
	if($type2 != "ATTENDANCE"){
		$id = $_GET['id'];

		$sql = "DELETE FROM " . $type2 . " WHERE " . $array[$type2] . "='".$id."'"; 						
		//$sql = "call SP_UPDATE_PASSWORD('".$cnpw."','".$email."')";  I used the change form as a template. Here is the stored procedure we used as a template
		$result= mysql_query($sql, $conn) or die(mysql_error());
	}
	else{
		$id = explode( "/" , $id);
		$sql = "DELETE FROM " . $type2 . " WHERE TID ='".$id[0]."'and VID ='".$id[1]."'"; 						
		//$sql = "call SP_UPDATE_PASSWORD('".$cnpw."','".$email."')";  I used the change form as a template. Here is the stored procedure we used as a template
		$result= mysql_query($sql, $conn) or die(mysql_error());
	}
	
	Header("Location: search".$type.".php");

	
?>