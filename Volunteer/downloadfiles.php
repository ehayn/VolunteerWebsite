<?php
/*
	require 'ZipArchive.php';
	require_once "dbconnect.php";
	$array = array();
	$id = $_GET['vid'];

	$sql = "Select Link from FILES where VID =". $id;
	$result = mysql_query($sql, $conn) or die(mysql_error());
	while($row = mysql_fetch_assoc($result)){
		foreach($row as $r){
			array_push($array, $r);
		}
	}
	
	$sql = "Select FirstName, LastName from VOLUNTEER where VID =".$id;
	$result = mysql_query($sql, $conn) or die(mysql_error());
	$row = mysql_fetch_assoc($result);

	$zipname = $row['FirstName'] . $row['LastName'] . '.zip';
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::CREATE);
	foreach($array as $a){
		$zip->addFile($a);
	}
	$zip->close();

	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename = filename.zip');
	header('Content-Length: ' .filesize($zipfilename));
	readfile($zipname);
*/
	require_once "dbconnect.php";
	$id = $_GET['vid'];

	$sql = "Select FirstName, LastName from VOLUNTEER where VID =".$id;
	$result = mysql_query($sql, $conn) or die(mysql_error());
	$row = mysql_fetch_assoc($result);

	$path = $_SERVER['DOCUMENT_ROOT']."/Hope2/upload/".$row['FirstName'].$row['LastName']."/files/"; 

	$files = scandir($path);
	$count=1;
	foreach ($files as $filename)
	{
 	   if($filename=="." || $filename==".." || $filename=="download.php" || $filename=="index.php")
 	   {
	        //this will not display specified files
	    }
 	   else
 	   {
 	       echo "<label >".$count.".&nbsp;</label>";
 	       echo "<a href='downloadr.php/?filename=".$filename."'>".$filename."</a>
	";
 	       $count++;
    }
}

	
?>