<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      
	
	//if this is a page that requires login always perform this session verification
	//require_once "inc/sessionVerify.php";



	require_once "dbconnect.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="EN" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title>Process Query Strings</title>
	<style type = "text/css">
  		h1, h2 {
    		text-align: center;
  		}
		table
		{
		border-collapse:collapse;
		}
		table,th, td
		{
		border: 1px solid black;
		}
		td
		{
		padding:15px;
		}
	</style>

	<script>
	
	function showHint(str)
	{ //read more about Ajax at - http://www.w3schools.com/ajax/
		if (str=="")
  		{
  			document.getElementById("txtHint").innerHTML="";
  			return;
  		} 
		if (window.XMLHttpRequest)
  		{// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
		else
  		{// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
		xmlhttp.onreadystatechange=function()
  		{
  			if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
    				document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    			}
  		}
		xmlhttp.open("GET","getHint.php?q="+str,true);
		xmlhttp.send();
		}
	</script>

	</head>

	<body>
	<?php
		if (!isset($_SESSION['email']))
				 Header ("Location:logout.php") ;
	?>
	<form name="input" action="lab5.php" method="post">
		Search

		<br/><br/>
		Search by First Name: <br/><br/>
		<input type = "text" id = "theInput" name = "theInput" onkeyup = "showHint(this.value)" />
		<!--<select name="fn">
		
		</select>
		-->
              <div id="txtHint"><b>Person info will be listed here.</b></div>

		<br />
<input type="submit" value="Submit">

	</form>


		<br/><br/>

		<a href="logout.php">Logout</a>

	</body>
</html>

<?php

function GetName()
{	$res = "";
    	$sql = "select FirstName from LAB4_REGISTRATION order by FirstName";
	global $DB;
	$result = $DB->GetAll($sql);
	foreach ($result as $row)
	{ 
		$res = $res.'<option value = "'.$row['FirstName'].'">'.$row['FirstName'].'</option>';

	}
	return $res;
}

?>

