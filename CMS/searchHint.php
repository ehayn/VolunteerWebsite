<?php
// gets the ajax-sent string from the other file
$q=$_REQUEST["q"];
$s1=$_REQUEST["s1"]; 
$s2=$_REQUEST["s2"]; 
$hint="";
$hint2="";


//contacts to database
$conn = mysql_connect("localhost", "ehayn", "ehayn") or die(mysql_error());
$select = mysql_select_db("ehayn1db", $conn);

if ($s1 == "con"){
	if($s2 == "con1"){
		//gets data from the database
		$sql = "SELECT DISTINCT firstName FROM CONTACT";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		//gets the last names from the data
		while($row = mysql_fetch_array($result))
			{
				$a[] = $row['firstName'];
			}
	}
	if($s2 == "con2"){
		//gets data from the database
		$sql = "SELECT DISTINCT lastName FROM CONTACT";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		//gets the last names from the data
		while($row = mysql_fetch_array($result))
			{
				$a[] = $row['lastName'];
			}
	}
	
		if($s2 == "con3"){
		//gets data from the database
		$sql = "SELECT DISTINCT City FROM CONTACT_ADDRESS";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		//gets the last names from the data
		while($row = mysql_fetch_array($result))
			{
				$a[] = $row['City'];
			}
	}
	
		if($s2 == "con4"){
		//gets data from the database
		$sql = "SELECT DISTINCT State FROM CONTACT_ADDRESS";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		//gets the last names from the data
		while($row = mysql_fetch_array($result))
			{
				$a[] = $row['State'];
			}
	}
	
		if($s2 == "con5"){
		//gets data from the database
		$sql = "SELECT DISTINCT lastName FROM CONTACT";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		//gets the last names from the data
		while($row = mysql_fetch_array($result))
			{
				$a[] = $row['lastName'];
			}
	}
	
		if($s2 == "con6"){
		//gets data from the database
		$sql = "SELECT DISTINCT name FROM ORGANIZATION";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		//gets the last names from the data
		while($row = mysql_fetch_array($result))
			{
				$a[] = $row['name'];
			}
	}
}

if ($s1 == "org"){
	if($s2 == "org1"){
		//gets data from the database
		$sql = "SELECT DISTINCT name FROM ORGANIZATION";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		//gets the last names from the data
		while($row = mysql_fetch_array($result))
			{
				$a[] = $row['name'];
			}
	}
	if($s2 == "org2"){
		//gets data from the database
		$sql = "SELECT DISTINCT City FROM ORGANIZATION_ADDRESS";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		//gets the last names from the data
		while($row = mysql_fetch_array($result))
			{
				$a[] = $row['City'];
			}
	}
	
		if($s2 == "org3"){
		//gets data from the database
		$sql = "SELECT DISTINCT State FROM ORGANIZATION_ADDRESS";
		$result = mysql_query($sql, $conn) or die(mysql_error());

		//gets the last names from the data
		while($row = mysql_fetch_array($result))
			{
				$a[] = $row['State'];
			}
	}
}

	//if the string isn't null, it checks it against the substrings of the data from the database that are the correct length
	//if it gets a match it attaches that to the variable "hint"
	if ($q != "") {
		$q=strtolower($q); $len=strlen($q);
		foreach($a as $name) {
			if (stristr($q, substr($name,0,$len))) { 
					if ($hint=="") {
							$hint='<option value="'.$name.'">'.$name.'</option>';
					}
					else {
							$hint .= '<option value="'.$name.'">'.$name.'</option>';
					}
			}
			else
				$hint2 ='<option value="No Suggestions"></option>';
		}
	}
	
	// Output "no suggestion" if no hint were found
	// or output the correct values
	if($hint != ""){
		echo $hint;
	}
	else{
		echo $hint2;
	}
//}
?>