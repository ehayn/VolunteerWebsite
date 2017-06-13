<?php session_start();
require_once "dbconnect.php";

$pass=0;
$sql= "SELECT LastName FROM `VOLUNTEER` WHERE 1";
$a=array();
$result = mysql_query($sql,$conn) or die(mysql_error());
while($row= mysql_fetch_array($result,MYSQL_NUM))
{
   $b[]=$row;
}
//idk it works ha
for($i=0;$i<count($b);$i++){
   $a[]=$b[$i][0];
}
$_SESSION['views'] = $a;

for($j=0;$j<count($a);$j++){
  //echo "<option>' .$a[$j]. '</option>\n";
 
}

// get the q parameter from URL
$q=$_REQUEST["q"]; $hint="";

// lookup all hints from array if $q is different from "" 
if ($q !== "")
  { $q=strtolower($q); $len=strlen($q);
    foreach($a as $name)
    { if (stristr($q, substr($name,0,$len)))
      { if ($hint==="")
        { $hint=$name; }
        else
        { $hint .= ", $name"; }
      }
    }
  }

// Output "no suggestion" if no hint were found
// or output the correct values 
//echo $hint==="" ? "no suggestion" : $hint;
echo "<select id='change' onchange='change()' >";

    //see if string has a comma if so then turn it into an array to display multiple results
    if (strpos($hint,',') !== false) {
      //arr gets array of strings in hint
      $arr = explode(',',$hint);
      $t = $arr;

      for($i=0;$i<count($t);$i++){
        echo "<option value=\"".$t[$i]."\"> $t[$i] </option>\n";
	$_SESSION['loginMsg']= $t[$i];
      }
    }
    else{
      echo "<option value=\"".$hint."\"> $hint </option>\n";
      $_SESSION['loginMsg']= $hint;
    }
 

echo "</select>";
?>