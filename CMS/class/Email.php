<?php

class Email
{
	protected $ID;
	protected $Detail;
	protected $Email;


	function __construct($Detail="",$Email="",$Apt="",$City="",$State="",$ZipCode="")
	{
		$this->setDetail($Detail);
		$this->setEmail($Email);
	}
/////////////SET
	function setID($id)
	{
		$id = trim($id);
		$this->ID = mysql_real_escape_string($id);
	}
	function setDetail($Detail)
	{
		$Detail = trim($Detail);
		$this->Detail = mysql_real_escape_string($Detail);
	}
	function setEmail($Email)
	{
		$Email = filter_var($Email,FILTER_SANITIZE_EMAIL);
		$this->Email = mysql_real_escape_string($Email);
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
	function getEmail()
	{
		return $this->Email; 
	}
/////////////
	function validate()//check all field requirements
	{
		$msg = "";
		$i++;
		
		if($this->Email="")
			$msg += "<div class=\"alert alert-danger\"><strong>Error</strong> *You must enter a e-mail for Email".$i."</div>";
		
		if(filter_var($this->Email,FILTER_VALIDATE_EMAIL) and $msg == "")
		{
			"<div class=\"alert alert-danger\"><strong>Error</strong> **Your Email is not an e-mail for Email".$i."</div>";
		}
		
		return $msg;
	}
	function insert()
	{
		$msg = "";
	
		//Insertion into CONTACT_EMAIL table
		$sql = "Call SP_INSERT_CONTACT_EMAIL('".$this->ID."', '".$this->Detail."', '".$this->Email."')";
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