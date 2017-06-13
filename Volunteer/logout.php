<?php  session_start(); //this must be the very first line on the php page, to register this page to use session variables
	session_destroy();
	
	$_SESSION["email"] = false;
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
    
	<title>Logout</title>    
   	<link href="template.css" rel="stylesheet" type="text/css" />

	</head>
    


	<body>
    
        <header>
        	<div id="topPan">
				<div id="ImgPan">
        			<img src="hopelogo.jpg" title="Hope Logo" alt="Hope Logo" width="150" height="150" border="0" />
        		</div>
        	</div>
		</header>
    

		<div id="bodyPan">
        	<h1>Volunteer Management Logout</h1>
        	<h4>Hope Resource Center</h4>
            
            You have been successfully logged out!
       	</div> 
	</body>
</html>

<?php
	Header('refresh:5;url= ../login.php');
?>


