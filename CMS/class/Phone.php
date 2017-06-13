<?php

class Phone
{
	protected $ID;
	protected $Detail;
	protected $Phone;


	function __construct($Detail="",$Phone="",$Apt="",$City="",$State="",$ZipCode="")
	{
		$this->setDetail($Detail);
		$this->setPhone($Phone);
	}
/////////////SET
	function setID($id)
	{
		$id = trim($id);
		$this->ID mysql_real_escape_string($id);
	}
	function setDetail($Detail)
	{
		$Detail = trim($Detail);
		$this->Detail = mysql_real_escape_string($Detail);
	}
	function setPhone($Phone)
	{
		$Phone = trim($Phone);
		$this->Phone = mysql_real_escape_string($Phone);
	}
	
/////////////GET
	function getID()
	{
		return $this->ID;
	}
	function getDetail()
	{
		return $this->Detail;
	}	
	function getPhone()
	{
		return $this->Phone; 
	}
/////////////
	function validate($i)//check all field requirements
	{
		$msg = "";
		
		if($this->Phone="")
			$msg += "<div class=\"alert alert-danger\"><strong>Error</strong> *You must enter a phone for Phone".$i."</div>";
		
		$this->Phone = preg_replace('/[^0-9]/', '', $this->Phone);
		if(strlen($this->Phone) != 10 and $msg == "") {
			$msg += "<div class=\"alert alert-danger\"><strong>Error</strong> **Your phone number is not correct for Phone".$i."</div>";
		}
		
		return $msg;
	}
	function insert()
	{
		$msg = "";
	
		//Insertion into CONTACT_PHONE table
		$sql = "Call SP_INSERT_CONTACT_PHONE('".$this->ID."', '".$this->Detail."', '".$this->Phone."')";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$msg = $msg. "<div class=\"alert alert-danger\"><strong>Error</strong>***" . mysql_error() . "</div>";	
		
		return $msg;
	}
	function update()//get data from database
	{
	
	}
	function delete()//delete data from database
	{
	
	}
}

?>