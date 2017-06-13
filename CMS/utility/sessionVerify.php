<?php

	if (!isset($_SESSION['userName'])) Header ("Location:../CMS/logout.php") ;
	
	//
	if(!isset($_SESSION['timeout']))  Header ("Location:../CMS/logout.php") ;
  	else 
		if ($_SESSION['timeout'] + 60*60 < time()) {
			Header ("Location:../CMS/logout.php") ;
		}
		else {
			$_SESSION['timeout'] = time();	 
		}
	
	if($_SESSION['userPermissionSite'] == 2)
		Header("Location:../Volunteer/volunteer.php");

?>