<?php 

class Contact
{

	protected $ID;
	protected $firstName;
	protected $lastName;
	protected $client;
	protected $donor;
	protected $volunteer;
	protected $dateOfBirth;
	protected $organizationID;
	protected $contactNotes;

	function __construct($first="",$last="",$cli="",$don="",$vol="",$dob="",$organID="",$notes="")
	{
		$this->setFirst($first);
		$this->setLast($last);
		$this->setClient($cli);
		$this->setDonor($don);
		$this->setVolu($vol);
		$this->setBirth($dob);
		$this->setOrganID($organID);
		$this->setNotes($notes);
			
	}
/////////////SET
	function setFirst($first)
	{
		$first = trim($first);
		$this->firstName = mysql_real_escape_string($first);
	}
	function setLast($last)
	{
		$last = trim($last);
		$this->lastName = mysql_real_escape_string($last);
	}	
	function setClient($client)
	{
		if ($client)	
			$this->client = "yes";
		else 
			$this->cleint = "no";
	}	
	function setDonor($donor)
	{
		if ($donor)	
			$this->donor = "yes";
		else 
			$this->donor = "no";
	}	
	function setVolu($volu)
	{
		if ($volu)	
			$this->volunteer = "yes";
		else 
			$this->volunteer = "no";
	}	
	function setBirth($birth)
	{
		$birth = trim($birth);
		$this->dateOfBirth = mysql_real_escape_string($birth);
	}	
	function setOrganID($organ)
	{
		$organ = trim($organ);
		$organ = mysql_real_escape_string($organ);
		
		if($organ != "")
		{
			require "utility/dbconnect.php";
		
			$sql = "select organizationID as c from ORGANIZATION where name = '" .$organ. "'";
			$result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
			$field = mysql_fetch_object($result); //the query results are objects, in this case, one object
			$this->organizationID = $field->c;
		}
		else
		{
			$this->organizationID = $organ;
		}
	}	
	function setNotes($notes)
	{
		$notes = trim($notes);
		$this->contactNotes = mysql_real_escape_string($notes);
	}
	function createAddress($i,$detail,$addr,$apt,$city,$state,$zip)
	{
		$this->address[$i]->setDetail($detail);
		$this->address[$i]->setAddress($addr);
		$this->address[$i]->setApt($apt);
		$this->address[$i]->setCity($city);
		$this->address[$i]->setState($state);
		$this->address[$i]->setZipCode($zip);		
		$this->iAddress = $i;
		
		$this->email[] = new Email();	
	}
/////////////GET	
	function getFirst()
	{
		return $this->firstName;
	}	
	function getLast()
	{
		return $this->lastName; 
	}
	function getClient()
	{
		return $this->client;
	}
	function getDonor()
	{
		return $this->donor;
	}
	function getVolu()
	{
		return $this->volunteer;
	}
	function getBrith()
	{
		return $this->dateOfBrith;
	}
	function getOrganID()
	{
		return $this->organizationID;
	}
	function getNotes()
	{
		return $this->contactNotes;
	}
/////////////
	function validate()//check all field requirements
	{
		$msg = "";
		
		if($this->firstName == "")
			$msg = $msg . "<div class=\"alert alert-danger\"><strong>Error</strong> *You must enter a first name</div>";
		if($this->lastName == "")
			$msg = $msg . "<div class=\"alert alert-danger\"><strong>Error</strong> *You must enter a last name</div>";
		if($this->dateOfBirth == "")
			$msg = $msg . "<div class=\"alert alert-danger\"><strong>Error</strong> *You must enter a date of birth</div>";		
	
		return $msg;
	}
	function insert()//put data into database
	{
		$msg = "";
		
		//Insert into CONTACT table
		$sql = "Call SP_INSERT_CONTACT('".$this->firstName."', '".$this->lastName."', '".$this->client."', '".$this->donor."', '".$this->volunteer."', '".$this->dateOfBirth."','".$this->organizationID."', '".$this->contactNotes."')";
		$result = mysql_query($sql, $conn) or die(mysql_error());		
		$msg += "<div class=\"alert alert-danger\"><strong>Error</strong>***" . mysql_error() . "</div>";
		
		//Retrieve contactID to use for other insertions
		$sql = "select contactID from CONTACT where firstName = '" . $this->firstName. "' and lastName = '".$this->lastName."' and dateOfBirth = '".$this->dateOfBirth."'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$msg += "<div class=\"alert alert-danger\"><strong>Error</strong>***" . mysql_error() . "</div>";	
		$field = mysql_fetch_object($result);
		$this->setID($field->contactID);
		
		
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