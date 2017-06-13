<?php

class Admin
{
	protected $email
	//protected $password
	protected $permission
	
	function __Construct($email="",$permission="")
	{
		$this->email = setEmail($email);
		//$this->password = setPass($password);
		$this->permission = setPerm($permission);
	}
////////SET
	function setEmail($email)
	{
		$email = filter_var($email,FILTER_SANITIZE_EMAIL);
		$this->email = mysql_real_escape_string($email);
	}	
	function setPerm($perm)
	{
		$perm = trim($perm);
		$this->permission = mysql_real_escape_string($perm);
	}
////////GET
	function getEmail()
	{
		return $this->email;
	}	
	function getPerm()
	{
		return $this->permission;
	}
////////
	function validate()
	{
		$msg = ""
		
		if (!filter_input(INPUT_POST, 'userEmail',FILTER_VALIDATE_EMAIL)) 
			$msg += "<div class=\"alert alert-danger\"><strong>Error</strong> *This email is not valid.</div>";
		if(($_SESSION['userPermission']) != 0)
			$msg += "<div class=\"alert alert-danger\"><strong>Error</strong> *You do not have permission to create users.</div>";
				
		
		return $msg;
	}
	function insert()
	{
		$password = sha1("password11");//random generate
			            
		$sql = "Call SP_INSERT_USER('".$email."', '".$password."', '".$permission."')";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$msg += "<div class=\"alert alert-danger\"><strong>Error</strong>***" . mysql_error() . "</div>";
		
		if($msg == "")
		{
			$subject = "Hope Resource Management System";
			$body = 'Your temporary password is: ' .$password;
			$mailer = new Mail();
			$mailer->sendMail($email, $email, $subject, $body);	
		}
			
		return $msg;
	}
}
?>