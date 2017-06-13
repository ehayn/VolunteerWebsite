<?php

class Address
{
	protected $ID;
	protected $Detail;
	protected $Address;
	protected $Apt;
	protected $City;
	protected $State;
	protected $ZipCode;

	function __construct($detail="",$address="",$apt="",$city="",$state="",$zip="")
	{
		$this->setDetail($detail);
		$this->setAddress($address);
		$this->setApt($apt);
		$this->setCity($city);
		$this->setState($state);
		$this->setZipCode($zip);
	}
/////////////SET
	function setID($id)
	{
		$id = trim($id);
		$this->ID = mysql_real_escape_string($id);	
	}
	function setDetail($detail)
	{
		$detail = trim($detail);
		$this->Detail = mysql_real_escape_string($detail);
	}
	function setAddress($address)
	{
		$address = trim($address);
		$this->Address = mysql_real_escape_string($address);
	}	
	function setApt($apt)
	{
		$apt = trim($apt);
		$this->Apt = mysql_real_escape_string($apt);
	}	
	function setCity($City)
	{
		$City = trim($City);
		$this->City = mysql_real_escape_string($City);
	}	
	function setState($State)
	{
		$State = trim($State);
		$this->State = mysql_real_escape_string($State);
	}	
	function setZipCode($ZipCode)
	{
		$ZipCode = trim($ZipCode);
		$this->ZipCode = mysql_real_escape_string($ZipCode);
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
	function getAddress()
	{
		return $this->Address; 
	}
	function getApt()
	{
		return $this->Apt;
	}
	function getCity()
	{
		return $this->City;
	}
	function getState()
	{
		return $this->State;
	}
	function getZipCode()
	{
		return $this->ZipCode;
	}
/////////////
	function validate($i)//check all field requirements
	{
		$msg = "";
		$i++;
		
		if($this->Address == "")
			$msg = $msg. "<div class=\"alert alert-danger\"><strong>Error</strong> *You must enter a address for Address".$i."</div>";
		if($this->City == "")
			$msg = $msg. "<div class=\"alert alert-danger\"><strong>Error</strong> *You must enter a city for Address".$i."</div>";
		if($this->ZipCode == "")
			$msg = $msg."<div class=\"alert alert-danger\"><strong>Error</strong> *You must enter a zip code for Address".$i."</div>";

		if(!(is_numeric($this->ZipCode)) and strlen($this->ZipCode) != 5 and $msg == "")
		{
			"<div class=\"alert alert-danger\"><strong>Error</strong> **Zip code not in correct format, 5-numbers for Address".$i."</div>";
		}
		return $msg;
	}
	function insert()
	{
		$msg = "";
		//Insertion into CONTACT_ADDRESS table
		$sql = "Call SP_INSERT_CONTACT_ADDRESS('".$this->ID."', '".$this->City."', '".$this->State."', '".$this->Addr."', '".$this->Apt."', '".$this->Zip."')";
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