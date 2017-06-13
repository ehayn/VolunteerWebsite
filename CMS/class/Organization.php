<?php

class Organization
{
	protected $ID;
	protected $name;
	protected $website;
	protected $contactID;
	
	function __Construct($name = "", $website = "", $contactID = "")
	{
		$this->name = setName($name);
		$this->website = setWeb($website);
		$this->contactID = setCont($contactID);
	}
/////////////SET
	function setID($id)
	{
		$id = trim($id);
		$this->ID = mysql_real_escape_string($id);
	}
	function setName($name)
	{
		$name = trim($name);
		$this->name = mysql_real_escape_string($name);
	}
	function setWeb($web)
	{
		$web = filter_var($web,FILTER_SANITIZE_URL);
		$this->website = mysql_real_escape_string($web);
	}
	function setCont($cont)
	{
		$cont = trim($cont);
		$this->contactID = mysql_real_escape_string($cont);
	}	
/////////////GET
	function getID()
	{
		return $this->ID;
	}
	function getName()
	{
		return $this->name;
	}
	function getWeb()
	{
		return $this->website;
	}
	function getCont()
	{
		return $this->contactID;
	}
/////////////
	function validate()//check all field requirements
	{
		$msg = "";
		
		if($name="")$msg += "<div class=\"alert alert-danger\"><strong>Error</strong> *You must enter a name for the organization</div>";		
		
		return $msg;
	}
	function insert()//put data into database
	{
		$msg = "";
		
		$sql = "Call SP_INSERT_ORGANIZATION('".$this->name."', '".$this->website."')";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$msg += "<div class=\"alert alert-danger\"><strong>Error</strong>***" . mysql_error() . "</div>";
		
		//Retrieve Organization ID for further insertion
		$sql = "select organizationID from ORGANIZATION where name = '" . $this->name. "'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$msg += "<div class=\"alert alert-danger\"><strong>Error</strong>***" . mysql_error() . "</div>";	
		$field = mysql_fetch_object($result);
		$this->setID($field->organizationID);
		
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