<?php session_start(); //this must be the very first line on the php page, to register this page to use session variables
      
	
	//if this is a page that requires login always perform this session verification
	require_once "inc/sessionVerify.php";



	require_once "dbconnect.php";


	if (!isset($_SESSION['email']))
		Header ("Location:logout.php") ;

	$q = $_GET['q']; //get the values passed from this query string
	$i = 0;
	$option = array();

	if ($q != ""){
		$q = strtolower($q);
		$len = strlen($q);
		$sql = "select FirstName from LAB4_REGISTRATION order by FirstName";
		global $DB;
		$result = $DB->GetAll($sql);
		foreach ($result as $name){
			$name = implode($name);
			if (stristr($q, substr($name,0,$len))){
				$option[$i] = $name;
				$i ++;
			}
		}
	}
	if ($option == array()){
		$option = array("no match");
	}
	$res = "";
	foreach ($option as $o){
		$res = $res.'<option value = ."$o".>."$o".</option>';
	}
	print "<select name = 'fn'>";
		print '$res';
	print "</select>";
?>
			