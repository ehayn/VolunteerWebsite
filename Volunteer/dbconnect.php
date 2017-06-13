<?php
/**
 * This file defines database connection. This file is included in any files that needs database connection
 * 
  */



$conn = mysql_connect("localhost", "ehayn", "ehayn") or die(mysql_error());
$select = mysql_select_db("ehayn5db", $conn);

?>