<?php  
session_start(); //this must be the very first line on the php page, to register this page to use session variables
session_destroy();
Header ("Location:../login.php");	
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Logout</title>
	</head>
	<body>
		<h3>You Have Been Logged Out</h3>
    </body>
</html>



