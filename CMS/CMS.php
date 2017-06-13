<?php
session_start();//Session Variables
require_once "utility/sessionVerify.php";//Check Session timer
require_once "utility/dbconnect.php";
require_once "utility/utility.php";//Password Strength
require_once "utility/mail/mail.class.php";

$null = null;
//Php variables

//change password form
$cuna = ""; //current username
$cpa = "";  //current pass
$npa = "";  //new pass
$cnpa = ""; //confirm new pass
$msg4 = ""; // Notification message
$cpClicked = 'false';
//tab 1 - contact form
$cfna = "";
$clna = "";
$cem = "";
$cph = "";
$cphDetail0 = "";
$cphDetail1 = "";
$cphDetail2 = "";
$ccty = "";
$cst = "";
$cadr = "";
$capt = "";
$czip = "";
$ccli = "";
$cdon = "";
$cvol = "";
$cdob = "";
$cog = "";
$cnotes = "";
$cfiles = "";
$msg1 = "";
//tab 2 - organization form
$na = "";
$octy = "";
$ost = "";
$adr = "";
$ozip = "";
$oph0 = "";
$oph1 = "";
$oph2 = "";
$opDetail0 = "";
$opDetail1 = "";
$opDetail2 = "";
$ws = "";
$pc = "";
$msg2 = "";
//tab 3 - create user form
$uem = "";
$upw = "";
$ucpw = "";
$upm = "";
$msg3 = "";
$editMsg = "''";

//used for remembering which tab the user was on before form submission
$oldSelected1 = "mainPage";
$oldSelected2 = "tB1";
$editFormSubmitted = "false";
$oldID = "''";
$oldType = "''";

?>
<!--php for forms-->
<?php
	//**********************************************************************Change Password Post******************************************************************	
	if(isset($_POST['changePass']))
	{
		$cpClicked = 'true';
		//Cut white space
		$cpa = htmlentities(trim($_POST['userPass']));
		$npa = htmlentities(trim($_POST['newPass']));
		$cnpa = htmlentities(trim($_POST['confirmNewPass']));
		//Injection Prevention
		$cpa = mysql_real_escape_string($cpa);
		$npa = mysql_real_escape_string($npa);
		$cnpa = mysql_real_escape_string($cnpa);
		
		//hash to match db
		$cppa = sha1($cpa);
		
		//get username
		$cuna = $_SESSION['userName'];
		
		$sql = "select password from DATABASE_USER where username = '".$cuna."'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$field = mysql_fetch_object($result);
		$temppass = $field->password;
		
		if ($npa != $cnpa)
			$msg4 = "<div class=\"alert alert-danger\"><strong>Error</strong> New passwords do not match.</div>";
			
		if (!pwdValidate($npa))
			$msg4 = "<div class=\"alert alert-danger\"><strong>Error</strong> New password is not in the correct format.</div>";
			
		if ($cppa != $temppass)
			$msg4 = "<div class=\"alert alert-danger\"><strong>Error</strong> Current password entered is invalid.</div>";

		if ($msg4 == "")
		{
			//hash new password for db
			$nppa = sha1($npa);
			
			//db update
			$sql = "update DATABASE_USER set password = '".$nppa."' where username = '".$cuna."'";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			$msg4 = "<div class=\"alert alert-success\"><strong>Success!</strong> Password has been successfully updated.</div>";
		}
	}

	//Makes an array of the Organizations from the database (Used in the dropbox for selecting an organization from the dropdown box)
	$sql = "select organizationID, name from ORGANIZATION ORDER BY name";
    $result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
    $oArray = array();
	while(($row = mysql_fetch_assoc($result))) {
    $oArray[$row['organizationID']] = $row['name'];}
	$oNumber = count($oArray);
//***************************************************************************Delete Con/Org/User**********************************************************************
	if(isset($_POST['deleteType']))
	{
		
	
		if($_POST['deleteType'] == 'con')
		{
			$sql = "DELETE FROM CONTACT WHERE contactID=";
		}
		elseif($_POST['deleteType'] == 'org')
		{
			$sql = "DELETE FROM ORGANIZATION WHERE organizationID=";
		}
		elseif($_POST['deleteType'] == 'use')
		{
			$sql = "DELETE FROM DATABASE_USER WHERE userID=";
		}
		$sql .= "'".$_POST['deleteID']."'";
		mysql_query($sql, $conn) or die(mysql_error());
		print '<script>alert("'.$sql.'");</script>';
	
		$oldSelected1 = "viewDatabase";
		$oldSelected2 = "";
	}
//***************************************************************************EDIT CONTACT**********************************************************************

	if(isset($_POST['csaveChanges']))
	{
		$editMsg = "''";
		$cid = trim($_POST['contactID']);
		$editFirstName = htmlentities(trim($_POST['contactFirstName']));
        $editLastName = htmlentities(trim($_POST['contactLastName']));
        $editEmail0 = htmlentities(trim($_POST['vcEmail0']));
		$editEmailDetail0 = htmlentities(trim($_POST['vceDetail0']));
		$editEmail1 = htmlentities(trim($_POST['vcEmail1']));
		$editEmailDetail1 = htmlentities(trim($_POST['vceDetail1']));
		$editEmail2 = htmlentities(trim($_POST['vcEmail2']));
		$editEmailDetail2 = htmlentities(trim($_POST['vceDetail2']));
        $editPhone0 = htmlentities(trim($_POST['vcPhone0']));
		$editPhone1 = htmlentities(trim($_POST['vcPhone1']));
		$editPhone2 = htmlentities(trim($_POST['vcPhone2']));
		$editPhoneDetail0 = htmlentities(trim($_POST['vcpDetail0']));
		$editPhoneDetail1 = htmlentities(trim($_POST['vcpDetail1']));
		$editPhoneDetail2 = htmlentities(trim($_POST['vcpDetail2']));
		$editAddressDetail0 = htmlentities(trim($_POST['vcaDetail0']));
        $editAddress0 = htmlentities(trim($_POST['vcAddress0']));
		$editApartment0 = htmlentities(trim($_POST['vcApt0']));
		$editCity0 = htmlentities(trim($_POST['vcCity0']));
		$editState0 = htmlentities(trim($_POST['vcState0']));
		$editZip0 = htmlentities(trim($_POST['vcZip0']));
		$editAddressDetail1 = htmlentities(trim($_POST['vcaDetail1']));
        $editAddress1 = htmlentities(trim($_POST['vcAddress1']));
		$editApartment1 = htmlentities(trim($_POST['vcApt1']));
		$editCity1 = htmlentities(trim($_POST['vcCity1']));
		$editState1 = htmlentities(trim($_POST['vcState1']));
		$editZip1 = htmlentities(trim($_POST['vcZip1']));
		$editAddressDetail2 = htmlentities(trim($_POST['vcaDetail2']));
        $editAddress2 = htmlentities(trim($_POST['vcAddress2']));
		$editApartment2 = htmlentities(trim($_POST['vcApt2']));
		$editCity2 = htmlentities(trim($_POST['vcCity2']));
		$editState2 = htmlentities(trim($_POST['vcState2']));
		$editZip2 = htmlentities(trim($_POST['vcZip2']));
		$editDOB = htmlentities(trim($_POST['contactDOB']));
		$editOrganization = htmlentities(trim($_POST['contactOrganization']));
		$editNotes = htmlentities(trim($_POST['contactNotes']));
        //Injection Prevention
        $editFirstName = mysql_real_escape_string($editFirstName);
        $editLastName = mysql_real_escape_string($editLastName);
        $editEmail0 = mysql_real_escape_string($editEmail0);
		$editEmailDetail0 = mysql_real_escape_string($editEmailDetail0);
		$editEmail1 = mysql_real_escape_string($editEmail1);
		$editEmailDetail1 = mysql_real_escape_string($editEmailDetail1);
		$editEmail2 = mysql_real_escape_string($editEmail2);
		$editEmailDetail2 = mysql_real_escape_string($editEmailDetail2);
        $editPhone0 = mysql_real_escape_string($editPhone0);
		$editPhone1 = mysql_real_escape_string($editPhone1);
		$editPhone2 = mysql_real_escape_string($editPhone2);
		$editPhoneDetail0 = mysql_real_escape_string($editPhoneDetail0);
		$editPhoneDetail1 = mysql_real_escape_string($editPhoneDetail1);
		$editPhoneDetail2 = mysql_real_escape_string($editPhoneDetail2);
		$editAddressDetail0 = mysql_real_escape_string($editAddressDetail0);
        $editAddress0 = mysql_real_escape_string($editAddress0);
		$editApartment0 = mysql_real_escape_string($editApartment0);
		$editCity0 = mysql_real_escape_string($editCity0);
		$editState0 = mysql_real_escape_string($editState0);
		$editZip0 = mysql_real_escape_string($editZip0);
		$editAddressDetail1 = mysql_real_escape_string($editAddressDetail1);
        $editAddress1 = mysql_real_escape_string($editAddress1);
		$editApartment1 = mysql_real_escape_string($editApartment1);
		$editCity1 = mysql_real_escape_string($editCity1);
		$editState1 = mysql_real_escape_string($editState1);
		$editZip1 = mysql_real_escape_string($editZip1);
		$editAddressDetail2 = mysql_real_escape_string($editAddressDetail2);
        $editAddress2 = mysql_real_escape_string($editAddress2);
		$editApartment2 = mysql_real_escape_string($editApartment2);
		$editCity2 = mysql_real_escape_string($editCity2);
		$editState2 = mysql_real_escape_string($editState2);
		$editZip2 = mysql_real_escape_string($editZip2);
		$editDOB = mysql_real_escape_string($editDOB);
		
		$editNotes = mysql_real_escape_string($editNotes);
		
		$editOrgID = "";
		if($editOrganization != "")
		{
		//set $editOrganization to the organizationID that was selected from the form
		$sql = "Call SP_FIND_O_ID('" .$editOrganization. "', @oid)";
        $result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
		$result = mysql_query("select @oid as oid", $conn) or die(mysql_error()); 
		$field = mysql_fetch_object($result); //the query results are objects, in this case, one object
		$editOrganization = $field->oid;
		}
		
		//The following posts yes if the checkbox is clicked, no if not
		if (isset($_POST['client']))
		{		$editClient = "yes";}
		else $editClient = "no";
			
		if (isset($_POST['donor']))
		{		$editDonor = "yes";}
		else $editDonor = "no";
		
		if (isset($_POST['volunteer']))
		{		$editVolunteer = "yes";}
		else $editVolunteer = "no";
		
		if (($editFirstName == "") || ($editLastName == "") || (($editPhone0 == "") && ($editEmail0 == "")) )
		{
			$editMsg = "'<div class=\"alert alert-danger\"><strong>Error</strong> You must enter in at least a first/last name and an email or phone number.</div>'";
		}
		if($editMsg == "''"){
			if($editOrganization == ""){
				$sql = "Call SP_UPDATE_CONTACT('".$cid."', '".$editFirstName."', '".$editLastName."', '".$editClient."', '".$editDonor."', '".$editVolunteer."', '".$editDOB."', '".$editNotes."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			else{
				$sql = "Call SP_UPDATE_CONTACT_O('".$cid."', '".$editFirstName."', '".$editLastName."', '".$editClient."', '".$editDonor."', '".$editVolunteer."', '".$editDOB."', '".$editOrganization."', '".$editNotes."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
			}
				
				$sql = "DELETE from CONTACT_PHONE where contactID = '".$cid."'";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				
				if($editPhone0 != ""){
				$sql = "Call SP_INSERT_CONTACT_PHONE('".$cid."', '".$editPhoneDetail0."', '".$editPhone0."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				if($editPhone1 != ""){
					$sql = "Call SP_INSERT_CONTACT_PHONE('".$cid."', '".$editPhoneDetail1."', '".$editPhone1."')";
					$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				if($editPhone2 != ""){
					$sql = "Call SP_INSERT_CONTACT_PHONE('".$cid."', '".$editPhoneDetail2."', '".$editPhone2."')";
					$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				
				$sql = "DELETE from CONTACT_ADDRESS where contactID = '".$cid."'";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				
				//Insertion into CONTACT_ADDRESS table
				if($editAddress0 != ""){
				$sql = "Call SP_INSERT_CONTACT_ADDRESS('".$cid."', '".$editAddressDetail0."', '".$editCity0."', '".$editState0."', '".$editAddress0."', '".$editApartment0."', '".$editZip0."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				
				if($editAddress1 != ""){
				$sql = "Call SP_INSERT_CONTACT_ADDRESS('".$cid."', '".$editAddressDetail1."', '".$editCity1."', '".$editState1."', '".$editAddress1."', '".$editApartment1."', '".$editZip1."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				
				if($editAddress2 != ""){
				$sql = "Call SP_INSERT_CONTACT_ADDRESS('".$cid."', '".$editAddressDetail2."', '".$editCity2."', '".$editState2."', '".$editAddress2."', '".$editApartment2."', '".$editZip2."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				
				$sql = "DELETE from CONTACT_EMAIL where contactID = '".$cid."'";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				
				//Insertion into CONTACT_EMAIL table
				if($editEmail0 != ""){
				$sql = "Call SP_INSERT_CONTACT_EMAIL('".$cid."', '".$editEmailDetail0."', '".$editEmail0."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				if($editEmail1 != ""){
				$sql = "Call SP_INSERT_CONTACT_EMAIL('".$cid."', '".$editEmailDetail1."', '".$editEmail1."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				if($editEmail2 != ""){
				$sql = "Call SP_INSERT_CONTACT_EMAIL('".$cid."', '".$editEmailDetail2."', '".$editEmail2."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				
				$file_count = 0;
				$sqlInsertFileUrl[] = array();
				$maxDelete = $_POST['maxDelete'];
				$where = "";
				
				if($_FILES['iFile']['name'][0])//iFile count returns 1 even if nothing is sent
				{
					$file_count = count($_FILES["iFile"]["name"]);
				}
			
				//delete files
				for($i=0;$i<$maxDelete;$i++)
				{
					$file = substr($_POST['deleteFile'.$i],strpos($_POST['deleteFile'.$i],'upload'));
					$where = "fileLink ='".$file."' OR '";
					unlink($file);
				}				
				$where = "(".substr($where,0,-4).") AND contactID = '".$cid."'";//substr get rid of the added on 'OR'
				if($maxDelete > 0)//if something to to delete then delete
				{
					$sql = "DELETE FROM CONTACT_FILE WHERE ".$where;
					mysql_query($sql, $conn) or die(mysql_error());
				}
				
				$sql = "SELECT * FROM CONTACT_FILE WHERE contactID ='".$cid."'";
				$result = mysql_query($sql, $conn) or die(mysql_error());
				$copyExt = array();
				$i = 0;
				while(($row = mysql_fetch_assoc($result))) 
				{
					$copyExt[$i] = substr($row['fileLink'],strrpos($row['fileLink'],'.'));
					$i++;
				}
				//print '<script>alert("'.$where.' '.$file_count.' '.count($copyExt).'");</script>';
				
				//add files
				$j = 0;//files that are already uploaded tracker
				$m = 0;//files being uploaded tracker
				for ($i=0; $i<$file_count; $i++)//$i total number of files tracker
				{	//print '<script>alert("i='.$i.' j='.$j.'");</script>';
					if($j < count($copyExt))
					{
						if(file_exists("upload/".$editFirstName."_".$editLastName."_".$i.$copyExt[$j]) )//&& $editFirstName != "" && $editLastName != ""					
						{
							$file_count++;
							$j++; //print '<script>alert("inside");</script>';
						}
						else
						{
							//print '<script>alert("upload/'.$editFirstName.'_'.$editLastName.'_'.$i.$copyExt[$j].'");</script>';
							$ext = substr($_FILES["iFile"]["name"][$m],strrpos($_FILES["iFile"]["name"][$m],"."));
							move_uploaded_file($_FILES["iFile"]["tmp_name"][$m],"upload/".$editFirstName."_".$editLastName."_".$i.$ext);
							$sqlInsertFileUrl[$m] = "upload/".$editFirstName."_".$editLastName."_".$i.$ext;
							$m++;
						}
					}
					else
					{//free to upload without checking if file on server
						$ext = substr($_FILES["iFile"]["name"][$m],strrpos($_FILES["iFile"]["name"][$m],"."));
						move_uploaded_file($_FILES["iFile"]["tmp_name"][$m],"upload/".$editFirstName."_".$editLastName."_".$i.$ext);
						$sqlInsertFileUrl[$m] = "upload/".$editFirstName."_".$editLastName."_".$i.$ext;
						$m++;//print '<script>alert("upload without checking");</script>';
					}					
					
				}
				if($file_count > 0)
				{
					foreach($sqlInsertFileUrl as $filePath){
						$sql = "Call SP_INSERT_CONTACT_FILE('".$cid."', 'file', '".$filePath."')";//print '<script>alert("'.$sql.'");</script>';
						$result = mysql_query($sql, $conn) or die(mysql_error());
					}
				}
				$editMsg = "'<div class=\"alert alert-success\"><strong>Success!</strong> Information has been entered in successfully.</div>'";
			
		}

		$oldSelected1 = "viewEdit";
		$oldSelected2 = "";
		$editFormSubmitted = "true";
		$oldID = $cid;
		$oldType = "'con'";
		
	
	}
	
	//***********************************************************************EDIT ORGANIZATION***********************************************************************
	
	if(isset($_POST['osaveChanges'])){
		$editMsg = "''";
		$oid = htmlentities(trim($_POST['orgID']));
		$editOrgName = htmlentities(trim($_POST['name'])); 
		$editOrgAddress = htmlentities(trim($_POST['address']));
		$editOrgCity = htmlentities(trim($_POST['oCity']));
		$editOrgState = htmlentities(trim($_POST['oState']));
		$editOrgZip = htmlentities(trim($_POST['oZipcode']));
		$editOrgSite = htmlentities(trim($_POST['site']));
		$editOrgPhoneDetail0 = htmlentities(trim($_POST['vopDetail0']));
		$editOrgPhoneDetail1 = htmlentities(trim($_POST['vopDetail1']));
		$editOrgPhoneDetail2 = htmlentities(trim($_POST['vopDetail2']));
		$editOrgPhone0 = htmlentities(trim($_POST['voPhone0']));
		$editOrgPhone1 = htmlentities(trim($_POST['voPhone1']));
		$editOrgPhone2 = htmlentities(trim($_POST['voPhone2']));
		$editPrimaryContact = htmlentities(trim($_POST['primaryContact']));
		
		$editOrgName = mysql_real_escape_string($editOrgName); 
		$editOrgAddress = mysql_real_escape_string($editOrgAddress);
		$editOrgCity = mysql_real_escape_string($editOrgCity); 
		$editOrgState = mysql_real_escape_string($editOrgState); 
		$editOrgZip = mysql_real_escape_string($editOrgZip); 
		$editOrgSite = mysql_real_escape_string($editOrgSite); 
		$editOrgPhoneDetail0 = mysql_real_escape_string($editOrgPhoneDetail0); 
		$editOrgPhoneDetail1 = mysql_real_escape_string($editOrgPhoneDetail1); 
		$editOrgPhoneDetail2 = mysql_real_escape_string($editOrgPhoneDetail2); 
		$editOrgPhone0 = mysql_real_escape_string($editOrgPhone0); 
		$editOrgPhone1 = mysql_real_escape_string($editOrgPhone1); 
		$editOrgPhone2 = mysql_real_escape_string($editOrgPhone2);
		$editPrimaryContact = mysql_real_escape_string($editPrimaryContact);
		
		if ($editOrgName == "")
		{
			$editMsg = "'<div class=\"alert alert-danger\"><strong>Error</strong> Must enter an organization name.</div>'";
		}
		if($editMsg =="''"){
		
		if(empty($editPrimaryContact))
		{
			$sql = "Call SP_UPDATE_ORGANIZATION('".$oid."', '".$editOrgName."', '".$editOrgSite."', NULL)";
		}
		else
		{
			$sql = "Call SP_UPDATE_ORGANIZATION('".$oid."', '".$editOrgName."', '".$editOrgSite."', '".$editPrimaryContact."')";
		}		
		$result = mysql_query($sql, $conn) or die(mysql_error());
	
		$sql = "DELETE from ORGANIZATION_PHONE where organizationID = '".$oid."'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
			
		if($editOrgPhone0 != ""){
		$sql = "Call SP_INSERT_ORGANIZATION_PHONE('".$oid."', '".$editOrgPhoneDetail0."', '".$editOrgPhone0."')";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		}
		if($editOrgPhone1 != ""){
			$sql = "Call SP_INSERT_ORGANIZATION_PHONE('".$oid."', '".$editOrgPhoneDetail1."', '".$editOrgPhone1."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
		}
		if($editOrgPhone2 != ""){
			$sql = "Call SP_INSERT_ORGANIZATION_PHONE('".$oid."', '".$editOrgPhoneDetail2."', '".$editOrgPhone2."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
		}
		
		//Insertion into ORGANIZATION_ADDRESS table
		$sql = "DELETE from ORGANIZATION_ADDRESS where organizationID = '".$oid."'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		
		$sql = "Call SP_INSERT_ORGANIZATION_ADDRESS('".$oid."', '".$editOrgCity."', '".$editOrgState."', '".$editOrgAddress."', '".$editOrgZip."')";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		
		$file_count = 0;
		$sqlInsertFileUrl[] = array();
		$maxDelete = $_POST['maxDelete'];
		$where = "";
		
		if($_FILES['iFile']['name'][0])//iFile returns 1 even if nothing is sent
		{
			$file_count = count($_FILES["iFile"]["name"]);
		}		
		//delete files
			for($i=0;$i<$maxDelete;$i++)
			{
				$file = substr($_POST['deleteFile'.$i],strpos($_POST['deleteFile'.$i],'upload'));
				$where = "fileLink ='".$file."' OR '";
				unlink($file);
			}				
			$where = "(".substr($where,0,-4).") AND organizationID  = '".$oid."'";//substr get rid of the added on 'OR'
			if($maxDelete > 0)//if something to to delete then delete
			{
				$sql = "DELETE FROM ORGANIZATION_FILE WHERE ".$where;
				mysql_query($sql, $conn) or die(mysql_error());
			}
			
			$sql = "SELECT * FROM ORGANIZATION_FILE WHERE organizationID ='".$oid."'";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			$copyExt = array();
			$i = 0;
			while(($row = mysql_fetch_assoc($result))) 
			{
				$copyExt[$i] = substr($row['fileLink'],strrpos($row['fileLink'],'.'));
				$i++;
			}
			//print '<script>alert("'.$where.' '.$file_count.' '.count($copyExt).'");</script>';
			
			//add files
			$j = 0;//files that are already uploaded tracker
			$m = 0;//files being uploaded tracker
			for ($i=0; $i<$file_count; $i++)//$i total number of files tracker
			{	//print '<script>alert("i='.$i.' j='.$j.'");</script>';
				if($j < count($copyExt))
				{
					if(file_exists("upload/".$oid."_".$editOrgName."_".$i.$copyExt[$j]) )//&& $oid != "" && $editOrgName != ""					
					{
						$file_count++;
						$j++; //print '<script>alert("inside");</script>';
					}
					else
					{
						//print '<script>alert("upload/'.$oid.'_'.$editOrgName.'_'.$i.$copyExt[$j].'");</script>';
						$ext = substr($_FILES["iFile"]["name"][$m],strrpos($_FILES["iFile"]["name"][$m],"."));
						move_uploaded_file($_FILES["iFile"]["tmp_name"][$m],"upload/".$oid."_".$editOrgName."_".$i.$ext);
						$sqlInsertFileUrl[$m] = "upload/".$oid."_".$editOrgName."_".$i.$ext;
						$m++;
					}
				}
				else
				{//free to upload without checking if file on server
					$ext = substr($_FILES["iFile"]["name"][$m],strrpos($_FILES["iFile"]["name"][$m],"."));
					move_uploaded_file($_FILES["iFile"]["tmp_name"][$m],"upload/".$oid."_".$editOrgName."_".$i.$ext);
					$sqlInsertFileUrl[$m] = "upload/".$oid."_".$editOrgName."_".$i.$ext;
					$m++;//print '<script>alert("upload without checking");</script>';
				}					
				
			}
			if($file_count > 0)
			{
				foreach($sqlInsertFileUrl as $filePath){
					$sql = "Call SP_INSERT_ORGANIZATION_FILE('".$oid."', 'file', '".$filePath."')";//print '<script>alert("'.$sql.'");</script>';
					$result = mysql_query($sql, $conn) or die(mysql_error());
				}
			}
			$editMsg = "'<div class=\"alert alert-success\"><strong>Success!</strong> Information has been entered in successfully.</div>'";
		}
		
		$editFormSubmitted = "true";
		$oldID = $oid;
		$oldType = "'org'";
	}
	
	//***********************************************************************EDIT USERS POST************************************************************************
	
	if(isset($_POST['usaveChanges'])){
		$editUserFirstName = htmlentities(trim($_POST['firstName'])); 
		$editUserLastName = htmlentities(trim($_POST['lastName'])); 
		$editUserEmail = htmlentities(trim($_POST['userEmail'])); 
		$editUserPermission = htmlentities(trim($_POST['userPermissions']));
		$userID = htmlentities(trim($_POST['userID']));
		$editMsg = "''";
		
		//check if the username already exists in the database
        $sql = "select count(*) as c from DATABASE_USER where username = '" .$editUserEmail. "'";
        $result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
        $count = 0;
        $field = mysql_fetch_object($result); //the query results are objects, in this case, one object
        $count = $field->c;
                     
		
		if (!filter_input(INPUT_POST, 'userEmail',FILTER_VALIDATE_EMAIL))
				$editMsg = "'<div class=\"alert alert-danger\"><strong>Error</strong> This email is not valid.</div>'";
				
		if($editUserFirstName == "")
			$editMsg = "'<div class=\"alert alert-danger\"><strong>Error</strong> Must enter in a first name.</div>'";
		
		if($editUserLastName == "")
			$editMsg = "'<div class=\"alert alert-danger\"><strong>Error</strong> Must enter in a last name.</div>'"; 
			
		if($editMsg == "''"){
		
		//0 is both 1 is contact only 2 is volunteer only
		if (isset($_POST['contactSite'])){
			$contactAccess = "yes";}
		else
			$contactAccess = "no";
			
		if (isset($_POST['volSite']))
		{		$volAccess = "yes";}
		else
			$volAccess = "no";
		
		if($editUserPermission == "Super Admin"){
			$editUserPermission == 0;}
		if($editUserPermission == "View Only"){
			$editUserPermission = 4;}
		if($editUserPermission == "View/Edit"){
			$editUserPermission = 3;}
		if($editUserPermission == "View/Edit/Create"){
			$editUserPermission = 2;}
		if($editUserPermission == "View/Edit/Create/Delete"){
			$editUserPermission = 1;}
		
		$editSitePermission = 3;//3 will return an error
		//calculate site access
		if($contactAccess == "yes" && $volAccess == "yes"){
			$editSitePermission = 0;
		}
		if($contactAccess == "yes" && $volAccess == "no"){
			$editSitePermission = 1;
		}
		if($contactAccess == "no" && $volAccess == "yes"){
			$editSitePermission = 2;
		}
		if ($editSitePermission == 3){
			$msg3 = "<div class=\"alert alert-danger\"><strong>Error</strong> You must give at least one site permission </div>";
		}
		else{
			$sql = "Call SP_UPDATE_USER('".$userID."', '".$editUserFirstName."', '".$editUserLastName."', '".$editUserEmail."', '".$editUserPermission."', '".$editSitePermission."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
		}
		$editMsg = "'<div class=\"alert alert-success\"><strong>Success!</strong> Information has been entered in successfully.</div>'";
		
	}
		$editFormSubmitted = "true";
		$oldID = $userID;
		$oldType = "'use'";
	
	}
	
	
	//**********************************************************************Contact submission post******************************************************************	
    if(isset($_POST['enter1']))
    {
        //Cut white space
        $cfna = htmlentities(trim($_POST['contactFirstName']));
        $clna = htmlentities(trim($_POST['contactLastName']));
        $cem0 = htmlentities(trim($_POST['cEmail0']));
		$cemDetail0 = htmlentities(trim($_POST['ceDetail0']));
		$cem1 = htmlentities(trim($_POST['cEmail1']));
		$cemDetail1 = htmlentities(trim($_POST['ceDetail1']));
		$cem2 = htmlentities(trim($_POST['cEmail2']));
		$cemDetail2 = htmlentities(trim($_POST['ceDetail2']));
        $cph0 = htmlentities(trim($_POST['cPhone0']));
		$cph1 = htmlentities(trim($_POST['cPhone1']));
		$cph2 = htmlentities(trim($_POST['cPhone2']));
		$cphDetail0 = htmlentities(trim($_POST['cpDetail0']));
		$cphDetail1 = htmlentities(trim($_POST['cpDetail1']));
		$cphDetail2 = htmlentities(trim($_POST['cpDetail2']));
		$cadrDetail0 = htmlentities(trim($_POST['caDetail0']));
        $cadr0 = htmlentities(trim($_POST['cAddress0']));
		$capt0 = htmlentities(trim($_POST['cApt0']));
		$ccty0 = htmlentities(trim($_POST['cCity0']));
		$cst0 = htmlentities(trim($_POST['cState0']));
		$czip0 = htmlentities(trim($_POST['cZip0']));
		$cadrDetail1 = htmlentities(trim($_POST['caDetail1']));
        $cadr1 = htmlentities(trim($_POST['cAddress1']));
		$capt1 = htmlentities(trim($_POST['cApt1']));
		$ccty1 = htmlentities(trim($_POST['cCity1']));
		$cst1 = htmlentities(trim($_POST['cState1']));
		$czip1 = htmlentities(trim($_POST['cZip1']));
		$cadrDetail2 = htmlentities(trim($_POST['caDetail2']));
        $cadr2 = htmlentities(trim($_POST['cAddress2']));
		$capt2 = htmlentities(trim($_POST['cApt2']));
		$ccty2 = htmlentities(trim($_POST['cCity2']));
		$cst2 = htmlentities(trim($_POST['cState2']));
		$czip2 = htmlentities(trim($_POST['cZip2']));
		$cdob = htmlentities(trim($_POST['contactDOB']));
		$cog = htmlentities(trim($_POST['contactOrganization']));
		$cnotes = htmlentities(trim($_POST['contactNotes']));
        //Injection Prevention
        $cfna = mysql_real_escape_string($cfna);
        $clna = mysql_real_escape_string($clna);
        $cem = mysql_real_escape_string($cem);
        $cph0 = mysql_real_escape_string($cph0);
		$cph1 = mysql_real_escape_string($cph1);
		$cph2 = mysql_real_escape_string($cph2);
		$cphDetail0 = mysql_real_escape_string($cphDetail0);
		$cphDetail1 = mysql_real_escape_string($cphDetail1);
		$cphDetail2 = mysql_real_escape_string($cphDetail2);
		$cadrDetail0 = mysql_real_escape_string($cadrDetail0);
        $cadr0 = mysql_real_escape_string($cadr0);
		$capt0 = mysql_real_escape_string($capt0);
		$ccty0 = mysql_real_escape_string($ccty0);
		$cst0 = mysql_real_escape_string($cst0);
		$czip0 = mysql_real_escape_string($czip0);
		$cdob = mysql_real_escape_string($cdob);
		$cnotes = mysql_real_escape_string($cnotes);
		$cog = mysql_real_escape_string($cog);
		
		
		if($cog != "")
		{
		//set $cog to the organizationID that was selected from the form
		$sql = "select organizationID as c from ORGANIZATION where name = '" .$cog. "'";
        $result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
        $field = mysql_fetch_object($result); //the query results are objects, in this case, one object
        $scog = $field->c;
		}
		
		//The following posts yes if the checkbox is clicked, no if not
		if (isset($_POST['client']))
		{		$ccli = "yes";}
		else $ccli = "no";
			
		if (isset($_POST['donor']))
		{		$cdon = "yes";}
		else $cdon = "no";
		
		if (isset($_POST['volunteer']))
		{		$cvol = "yes";}
		else $cvol = "no";
		
		//checks to see if there is a field with a matching first name, last name, and email.
		$sql = "select count(*) as c from CONTACT where firstName = '".$cfna."' and lastName = '".$clna."'";//and email = '".$cem."'";
        $result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
        $field = mysql_fetch_object($result); //the query results are objects, in this case, one object
        $count = $field->c;
		
		if (($cfna == "") || ($clna == "") || (($cph0 == "") && ($cem0 == "")) )
		{
			$msg1 = "<div class=\"alert alert-danger\"><strong>Error</strong> You must enter in at least a first/last name and an email or phone number.</div>";
		}
		
        elseif ($count > 0)
		{	//$msg1 = "<span style=\"color:red\">The contact ".$cfna." ".$clna." with the email ".$cem." is already in the database.</span>";
			$msg1 = "<div class=\"alert alert-danger\"><strong>Error</strong> The contact ".$cfna." ".$clna." with the email ".$cem." is already in the database.</div>";
		}
		//Entry into database
		else
		{
			if($cog == "")
			{	$sql = "Call SP_INSERT_CONTACT('".$cfna."', '".$clna."', '".$ccli."', '".$cdon."', '".$cvol."', '".$cdob."', '".$cnotes."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());}
			else		
			{	$sql = "Call SP_INSERT_CONTACT_O('".$cfna."', '".$clna."', '".$ccli."', '".$cdon."', '".$cvol."', '".$cdob."', '".$scog."', '".$cnotes."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());}
				
			//Retrieve contactID to use for other insertions
			$sql = "select contactID from CONTACT where firstName = '" . $cfna. "' and lastName = '".$clna."' and dateOfBirth = '".$cdob."'";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			$cid = "";
			$field = mysql_fetch_object($result);
			$cid = $field->contactID;
		
			//Insertion into CONTACT_ADDRESS table
			if($cadr0 != ""){
			$sql = "Call SP_INSERT_CONTACT_ADDRESS('".$cid."', '".$cadrDetail0."', '".$ccty0."', '".$cst0."', '".$cadr0."', '".$capt0."', '".$czip0."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			
			if($cadr1 != ""){
			$sql = "Call SP_INSERT_CONTACT_ADDRESS('".$cid."', '".$cadrDetail1."', '".$ccty1."', '".$cst1."', '".$cadr1."', '".$capt1."', '".$czip1."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			
			if($cadr2 != ""){
			$sql = "Call SP_INSERT_CONTACT_ADDRESS('".$cid."', '".$cadrDetail2."', '".$ccty2."', '".$cst2."', '".$cadr2."', '".$capt2."', '".$czip2."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			
			//Insertion into CONTACT_EMAIL table
			if($cem0 != ""){
			$sql = "Call SP_INSERT_CONTACT_EMAIL('".$cid."', '".$cemDetail0."', '".$cem0."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			if($cem1 != ""){
			$sql = "Call SP_INSERT_CONTACT_EMAIL('".$cid."', '".$cemDetail1."', '".$cem1."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			if($cem2 != ""){
			$sql = "Call SP_INSERT_CONTACT_EMAIL('".$cid."', '".$cemDetail2."', '".$cem2."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			
			//Insertion into CONTACT_PHONE table
			if($cph0 != ""){
				$sql = "Call SP_INSERT_CONTACT_PHONE('".$cid."', '".$cphDetail0."', '".$cph0."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			if($cph1 != ""){
				$sql = "Call SP_INSERT_CONTACT_PHONE('".$cid."', '".$cphDetail1."', '".$cph1."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			if($cph2 != ""){
				$sql = "Call SP_INSERT_CONTACT_PHONE('".$cid."', '".$cphDetail2."', '".$cph2."')";
				$result = mysql_query($sql, $conn) or die(mysql_error());
			}
			
			$file_count = 0;
			if($_FILES['iFile']['name'][0])//iFile returns 1 even if nothing is sent
			{
				$file_count = count($_FILES["iFile"]["name"]);
			}
			$sqlInsertFileUrl[] = array();
			
			if($file_count > 0)
			{
				for ($i=0; $i<$file_count; $i++) 
				{
					$ext = substr($_FILES["iFile"]["name"][$i],strrpos($_FILES["iFile"]["name"][$i],"."));
					move_uploaded_file($_FILES["iFile"]["tmp_name"][$i],"upload/".$cfna."_".$clna."_".$i.$ext);
					$sqlInsertFileUrl[$i] = "upload/".$cfna."_".$clna."_".$i.$ext;
				}
				foreach($sqlInsertFileUrl as $filePath){
					$sql = "Call SP_INSERT_CONTACT_FILE('".$cid."', 'file', '".$filePath."')";
					$result = mysql_query($sql, $conn) or die(mysql_error());
				}
			}
			//$msg1 = "<span style=\"color:green\">Information has been entered in successfully.</span>";
			$msg1 = "<div class=\"alert alert-success\"><strong>Success!</strong> Information has been entered in successfully.</div>";
		}
		
		$oldSelected1 = "addContact";
		$oldSelected2 = "tB2";
		}
		
		
         
    
	
	//****************************************************************Organization submission post***********************************************************************
    if(isset($_POST['enter2']))
    {
        //Cut white space
        $na = htmlentities(trim($_POST['name']));
		$octy = htmlentities(trim($_POST['oCity']));
		$ost = htmlentities(trim($_POST['oState']));
        $adr = htmlentities(trim($_POST['address']));
		$ozip = htmlentities(trim($_POST['oZipcode']));
      
		$oph0 = htmlentities(trim($_POST['oPhone0']));
		$oph1 = htmlentities(trim($_POST['oPhone1']));
		$oph2 = htmlentities(trim($_POST['oPhone2']));
		$opDetail0 = htmlentities(trim($_POST['opDetail0']));
		$opDetail1 = htmlentities(trim($_POST['opDetail1']));
		$opDetail2 = htmlentities(trim($_POST['opDetail2']));
        $ws = htmlentities(trim($_POST['site']));
        //Injection Prevention
        $na = mysql_real_escape_string($na);
		$octy = mysql_real_escape_string($octy);
		$ost = mysql_real_escape_string($ost);
        $adr = mysql_real_escape_string($adr);
		$ozip = mysql_real_escape_string($ozip);
        $oph0 = mysql_real_escape_string($oph0);
		$oph1 = mysql_real_escape_string($oph1);
		$oph2 = mysql_real_escape_string($oph2);
		$opDetail0 = mysql_real_escape_string($opDetail0);
		$opDetail1 = mysql_real_escape_string($opDetail1);
		$opDetail2 = mysql_real_escape_string($opDetail2);
        $ws = mysql_real_escape_string($ws);
        $pc = mysql_real_escape_string($pc);

        //first check if the organization already exists in the database
        $sql = "select count(*) as c from ORGANIZATION where name = '" . $na. "'";
        $result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
        $count = 0;
        $field = mysql_fetch_object($result); //the query results are objects, in this case, one object
        $count = $field->c;
        
		if ($na == "")
		{
			$msg2 = "<div class=\"alert alert-danger\"><strong>Error</strong> Must enter an organization name.</div>";
		}
		
        elseif ($count != 0)//if the organization name exists, get error
        {   //$msg2 = "<span style=\"color:red\">This organization is already in the database</span>";
			$msg2 = "<div class=\"alert alert-danger\"><strong>Error</strong> This organization is already in the database.</div>";
                                                 
        }
        else//information is entered into the database
        {	
            $sql = "Call SP_INSERT_ORGANIZATION('".$na."', '".$ws."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			
			//Retrieve Organization ID for further insertion
			$sql = "select organizationID from ORGANIZATION where name = '" . $na. "'";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			$oid = "";
			$field = mysql_fetch_object($result);
			$oid = $field->organizationID;
			
			//Insertion into ORGANIZATION_ADDRESS table
			$sql = "Call SP_INSERT_ORGANIZATION_ADDRESS('".$oid."', '".$octy."', '".$ost."', '".$adr."', '".$ozip."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			
			//Insertion into ORGANIZATION_PHONE Table
				if($oph0 != ""){
					$sql = "Call SP_INSERT_ORGANIZATION_PHONE('".$oid."', '".$opDetail0."', '".$oph0."')";
					$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				if($oph1 != ""){
					$sql = "Call SP_INSERT_ORGANIZATION_PHONE('".$oid."', '".$opDetail1."', '".$oph1."')";
					$result = mysql_query($sql, $conn) or die(mysql_error());
				}
				if($oph2 != ""){
					$sql = "Call SP_INSERT_ORGANIZATION_PHONE('".$oid."', '".$opDetail2."', '".$oph2."')";
					$result = mysql_query($sql, $conn) or die(mysql_error());
				}
			
			$file_count = 0;
			if($_FILES['oFile']['name'][0])//iFile returns 1 even if nothing is sent
			{
				$file_count = count($_FILES['oFile']['name']);
			}
			$sqlInsertFileUrl[] = array();
			
			if($file_count > 0)
			{
				$sqlInsertFileUrl[] = array();
				for ($i=0; $i<$file_count; $i++) 
				{
					$ext = substr($_FILES["oFile"]["name"][$i],strrpos($_FILES["oFile"]["name"][$i],"."));
					move_uploaded_file($_FILES["oFile"]["tmp_name"][$i],"upload/".$oid."_".$na."_".$i.$ext);
					$sqlInsertFileUrl[$i] = "upload/".$oid."_".$na."_".$i.$ext;
				}
				foreach($sqlInsertFileUrl as $filePath){
					$sql = "Call SP_INSERT_ORGANIZATION_FILE('".$oid."', 'file', '".$filePath."')";
					$result = mysql_query($sql, $conn) or die(mysql_error());
				}
			}
            //$msg2 = "<span style=\"color:green\">Information has been entered in successfully.</span>";          
			$msg2 = "<div class=\"alert alert-success\"><strong>Success!</strong> Information has been entered in successfully.</div>";
		}    
		
		$oldSelected1 = "addOrganization";
		$oldSelected2 = "tB3";
		
    }
	
	//*****************************************************************User Creation submission post**************************************************************
    if(isset($_POST['enter3']))
    {
        //Cut white space
		$userFirstName = htmlentities(trim($_POST['firstName']));
		$userLastName = htmlentities(trim($_POST['lastName']));
        $uem = htmlentities(trim($_POST['userEmail']));
        $upm = htmlentities(trim($_POST['userPermissions']));
		$upms = 
        //Injection Prevention
		$userFirstName = mysql_real_escape_string($userFirstName);
		$userLastName = mysql_real_escape_string($userLastName);
        $uem = mysql_real_escape_string($uem);
        $upm = mysql_real_escape_string($upm);		
				
		$sitePerm = 3;
		
		//0 is both 1 is contact only 2 is volunteer only
		if (isset($_POST['contactSite']))
		{		$permCalc1 = 1;}
		else $permCalc1 = 0;
			
		if (isset($_POST['volSite']))
		{		$permCalc2 = 1;}
		else $permCalc2 = 0;
		
		if($permCalc1 == 1 && $permCalc2 == 1)
			$sitePerm = 0;
		else{
			if($permCalc1 == 1)
				$sitePerm = 1;
			if($permCalc2 == 1)
				$sitePerm = 2;
			if($permCalc1 == 0 && $permCalc2 == 0)
				$sitePerm = 3;
		}
		
        //check if the username already exists in the database
        $sql = "select count(*) as c from DATABASE_USER where username = '" .$uem. "'";
        $result = mysql_query($sql, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
        $count = 0;
        $field = mysql_fetch_object($result); //the query results are objects, in this case, one object
        $count = $field->c;
                     
        if ($count > 0)//if the username exists, get error
        {   //$msg3 = "<span style=\"color:red\">This email is already in the database</span>";        
			$msg3 = "<div class=\"alert alert-danger\"><strong>Error</strong> This email is already in the database.</div>";
        }
		if (!filter_input(INPUT_POST, 'userEmail',FILTER_VALIDATE_EMAIL))
				$msg3 = "<div class=\"alert alert-danger\"><strong>Error</strong> This email is not valid.</div>";
				
		if(($userFirstName || $userLastName) == "")
				$msg3 = "<div class=\"alert alert-danger\"><strong>Error</strong>Must enter a first and last name.</div>";
			
		if(($_SESSION['userPermission']) != 0)//Checks to see if current user has permissions to make new users
		{	//$msg3 = "<span style=\"color:red\">You do not have permission to create users</span>";
			$msg3 = "<div class=\"alert alert-danger\"><strong>Error</strong> You do not have permission to create users.</div>";
		}
		
		if($sitePerm == 3)
			$msg3 = "<div class=\"alert alert-danger\"><strong>Error</strong> Must check at least one site access. </div>";
		
        if($msg3 == "")//information is entered into the database
        {
			//placeholder/temporary password
			$upw = randomCodeGenerator(10);
			
			$ppa = sha1($upw);//Hash password
			//Stored Procedure to insert User                
            $sql = "Call SP_INSERT_USER('".$userFirstName."', '".$userLastName."', '".$uem."', '".$ppa."', '".$upm."', '".$sitePerm."')";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			
			$subject = "Hope Resource Management System";
			$body = 'Hello '.$userFirstName.' '.$userLastName.' Your temporary password is: ' . $upw;
			$mailer = new Mail();
			$mailer->sendMail($uem, $uem, $subject, $body);
		
			$msg3 = "<div class=\"alert alert-success\"><strong>Success!</strong> Information has been entered in successfully.</div>";			
		}   
		
		$oldSelected1 = "createUser";
		$oldSelected2 = "tB4";
		
    }
/**********************************************************************************************************************************************************/

if($_SESSION['userPermissionSite'] == 0){
		$siteSelect = '<form action="../Volunteer/volunteer.php">
							<input class="btn btn-custom btn-md" type="submit" value="Volunteer Site">
						</form>';
	}
else{
	$siteSelect = "";}

if($_SESSION['userPermission'] < 3){	
	$createTab = 	'<li class="tabButtons" id="tB2"><a data-toggle="tab" href="#addContact">Add Contact</a></li>
					<li class="tabButtons" id="tB3"><a data-toggle="tab" href="#addOrganization">Add Organization</a></li>
					<li class="tabButtons" id="tB4"><a data-toggle="tab" href="#createUser">Create User</a></li>';
}
else{
	$createTab = "";}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="bootstrap/images/hopeicon.ico">

		<title>Contact Management System</title>

		<!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Bootstrap theme -->
		<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="bootstrap/theme.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link href="css/cms.css" rel="stylesheet">
		<style>
			.btn-file {
			position: relative;
			overflow: hidden;
			}
			.btn-file input[type=file] {
				position: absolute;
				top: 0;
				right: 0;
				min-width: 100%;
				min-height: 100%;
				font-size: 999px;
				text-align: right;
				filter: alpha(opacity=0);
				opacity: 0;
				outline: none;
				background: white;
				cursor: inherit;
				display: block;
			}
			input[readonly] {
			background-color: white !important;
			cursor: text !important;
			}
		</style>
		
		<!--Select Box inter-dependence-->
		<script src="js/selectBox.js"></script>
		<!--Ajax search, currently just using Matt's lab5 code so not very useful-->
		<script src="js/ajaxSearch.js"></script>
		<!--Phone number input validator-->
		<script src="js/phoneValidate.js"></script>
		
		<script>	
	var input;//tells us which button was pressed
	var path;//0=address; 1=email; 2=phone;3=OrganizationPhone
	
	var cAddress = new Array(3);
	var cEmail = new Array(3);
	var cPhone = new Array(3);
	var oPhone = new Array(3);
	for (var i = 0; i < 3; i++) 
	{
		cAddress[i] = new Array(6);
		cEmail[i] = new Array(6);
		cPhone[i] = new Array(6);
		oPhone[i] = new Array(6);
		for(var j = 0;j < 6; j++)
		{
			cAddress[i][j] = "";
			cEmail[i][j] = "";
			cPhone[i][j] = "";
			oPhone[i][j] = "";
		}
	}	
	function setModal(x,y)//set information into modal fields
	{
		input = x;
		path = y;
		if(path == 0)
		{
			document.getElementById("caDetail").selectedIndex = findIndex("caDetail",cAddress[input][0]);//caDetail = client address Detail field
			document.getElementById("cAddress").value = cAddress[input][1];
			document.getElementById("cApt").value = cAddress[input][2];
			document.getElementById("cCity").value = cAddress[input][3];
			document.getElementById("cState").selectedIndex = findIndex("cState",cAddress[input][4]);
			document.getElementById("cZip").value = cAddress[input][5];
		}
		else if(path == 1)
		{
			document.getElementById("ceDetail").selectedIndex = findIndex("ceDetail",cEmail[input][0]);//ceDetail = client email detail field
			document.getElementById("cEmail").value = cEmail[input][1];		
		}
		else if(path == 2)
		{
			document.getElementById("cpDetail").selectedIndex = findIndex("cpDetail",cPhone[input][0]);//cpPhone = client phone detail field
			document.getElementById("cPhone").value = cPhone[input][1];			
		}
		else if(path == 3)
		{
			document.getElementById("opDetail").selectedIndex = findIndex("opDetail",oPhone[input][0]);//opPhone = client phone detail field
			document.getElementById("oPhone").value = oPhone[input][1];	
			
		}
	}
	function Discard()
	{		
		if(path == 0)
		{
			cAddress[input][0] = "";
			cAddress[input][1] = "";	
			cAddress[input][2] = "";
			cAddress[input][3] = "";
			cAddress[input][4] = "";
			cAddress[input][5] = "";		
			document.getElementById("btnAddress"+input).setAttribute("class","btn btn-info");
		}
		else if(path == 1)
		{
			cEmail[input][0] = "";
			cEmail[input][1] = "";
			document.getElementById("btnEmail"+input).setAttribute("class","btn btn-info");
		}
		else if(path == 2)
		{
			cPhone[input][0] = "";	
			cPhone[input][1] = "";		
			document.getElementById("btnPhone"+input).setAttribute("class","btn btn-info");
		}
		else if(path == 3)
		{
			oPhone[input][0] = "";	
			oPhone[input][1] = "";		
			document.getElementById("btnOrgPhone"+input).setAttribute("class","btn btn-info");
		}
	}
	function inputInfo()
	{	
		if(path == 0)
		{
			cAddress[input][0] = document.getElementById("caDetail").value;
			cAddress[input][1] = document.getElementById("cAddress").value;	
			cAddress[input][2] = document.getElementById("cApt").value;
			cAddress[input][3] = document.getElementById("cCity").value;
			cAddress[input][4] = document.getElementById("cState").value;
			cAddress[input][5] = document.getElementById("cZip").value;		
			document.getElementById("btnAddress"+input).setAttribute("class","btn btn-success");
		}
		else if(path == 1)
		{
			cEmail[input][0] = document.getElementById("ceDetail").value;	
			cEmail[input][1] = document.getElementById("cEmail").value;		
			document.getElementById("btnEmail"+input).setAttribute("class","btn btn-success");
		}
		else if(path == 2)
		{
			cPhone[input][0] = document.getElementById("cpDetail").value;	
			cPhone[input][1] = document.getElementById("cPhone").value;		
			document.getElementById("btnPhone"+input).setAttribute("class","btn btn-success");
		}
		else if(path == 3)
		{
			oPhone[input][0] = document.getElementById("opDetail").value;	
			oPhone[input][1] = document.getElementById("oPhone").value;		
			document.getElementById("btnOrgPhone"+input).setAttribute("class","btn btn-success");
		}
	}	
	function cSubmit() 
	{
		var aField = new Array("caDetail","cAddress","cApt","cCity","cState","cZip");//Address POST names
		var eField = new Array("ceDetail","cEmail");//Email POST names
		var pField = new Array("cpDetail","cPhone");//Phone POST names
		var form = document.getElementById("cForm");

		for(var i = 0;i < 3;i++) {  //ADDRESS
			for(var j = 0;j < 6;j++) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", aField[j]+i);
				hiddenField.setAttribute("value", cAddress[i][j]);
			
				form.appendChild(hiddenField);
			 }
		}
		for(var i = 0;i < 3;i++) {  //EMAIL
			for(var j = 0;j < 2;j++) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", eField[j]+i);
				hiddenField.setAttribute("value", cEmail[i][j]);
			
				form.appendChild(hiddenField);
			 }
		}
		for(var i = 0;i < 3;i++) {  //PHONE
			for(var j = 0;j < 2;j++) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", pField[j]+i);
				hiddenField.setAttribute("value", cPhone[i][j]);
				
				form.appendChild(hiddenField);
			 }
    }
	
    document.getElementById("cDiv").appendChild(form);
    form.submit();	
	}
	function oSubmit()
	{
		var pField = new Array("opDetail","oPhone");//Phone POST names
		var form = document.getElementById("oForm");
		
		for(var i = 0;i < 3;i++) {  //PHONE
			for(var j = 0;j < 2;j++) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", pField[j]+i);
				hiddenField.setAttribute("value", oPhone[i][j]);
				
				form.appendChild(hiddenField);
			 }
    }
	
    document.body.appendChild(form);//reaplce getElementById("cDiv") with body
    form.submit();	
	}
	function findIndex(id,val)
	{
		doc = document.getElementById(id);
		for(var i=0;i<doc.options.length;i++)
		{
			if(doc.options[i].value == val)
			{
				return i;
				break;
			}
		}
		return 0;
	}
	</script>
	
		

	</head>

	<body role="document">

	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only"> navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="http://hoperesourcectr.org/"><img src="bootstrap/images/hopelogosmall2.jpg" height="50" width="53" alt=""></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="tabButtons active" id="tB1"><a data-toggle="tab" href="#mainPage">Main Page</a></li>
					<?php echo $createTab; ?>
					<li class="tabButtons" id="tB5"><a data-toggle="tab" href="#viewDatabase">View Database</a></li>
					<li class="tabButtons" id="tB6"><a data-toggle="tab" onclick="fillDataFiles()" href="#reportData">Download Data</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['userName'] ?> <b class="caret"></b></a>
						<ul style="width:100%" class="dropdown-menu">
							<li align="center">
								<button id="cpModal" class="btn btn-custom btn-md" data-toggle="modal" data-target="#myModal" type="button">
									Change Password
								</button>
								<?php echo $siteSelect ?>
							</li>
						</ul>
					</li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
	
		<div class="tab-content">
			
			<!--Form tabs are included externally using php-include-->
			<?php
				include 'tabs/mainPage.php';
				include 'tabs/addContact.php';
				include 'tabs/addOrganization.php';
				include 'tabs/createUser.php';
				include 'tabs/viewDatabase.php';
				include 'tabs/reportData.php';
				// data-toggle="tab" href="#editContact"
			?>
			
			<div id="viewEdit" class="tab-pane">
			</div>
			
		</div>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/docs.min.js"></script>
	<link href="//datatables.net/download/build/nightly/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<script src="//datatables.net/download/build/nightly/jquery.dataTables.js"></script>
	
	<!--Speciality JS-->
	<!--Tab switcher-->
	<script>
		$(".tab-pane").each(function(){ 
			$(this).removeClass("active");
		});
		$(".tabButtons").each(function(){ 
			$(this).removeClass("active");
		});
		$("#<?php print $oldSelected1; ?>").addClass("active");
		$("#<?php print $oldSelected2; ?>").addClass("active");
		document.getElementById("uploadBtnContact").onchange = function () {
			document.getElementById("uploadContactFile").value = this.value;
		};
		document.getElementById("uploadBtnOrganization").onchange = function () {
			document.getElementById("uploadOrganizationFile").value = this.value;
		};
	</script>
	<script>
		
	</script>
	<script>
		cpClicked = false;
		cpClicked = <?php print $cpClicked; ?>;
		if(cpClicked){
			$("#cpModal").click();
		}
	</script>
	<!--search button-->
	<script type="text/javascript">
		$("#requestResults").click(function(){
			showResults($("#firstType").val(),$("#secondType").val(),$("#searchInput").val());
			$("#dataTablesSearchResults").hide();
			$("#searchResults").show();
		});
		$("#conDataTable").click(function(){
			showDataTablesResults('con');
			$("#searchResults").hide();
			$("#dataTablesSearchResults").show();
		});
		$("#orgDataTable").click(function(){
			showDataTablesResults('org');
			$("#searchResults").hide();
			$("#dataTablesSearchResults").show();
		});
		$("#useDataTable").click(function(){
			showDataTablesResults('use');
			$("#searchResults").hide();
			$("#dataTablesSearchResults").show();
		});
		function showHintFunction(){
			showHint($("#firstType").val(),$("#secondType").val(),$("#searchInput").val());
		}
		//makes tabs look inactive after clicking edit button (which takes user to hidden edit form)
		function editButton(id,type,msg) {
			$(".tab-pane").each(function(){ 
				$(this).removeClass("active");
			});
			$(".tabButtons").each(function(){ 
				$(this).removeClass("active");
			});
			$("#viewEdit").addClass("active");
			viewResults(id,type,msg);
			createViewArrays();
		}
		function deleteButton(id,type) {
			var r=confirm("Warning about to delete: Do you want to continue?");
			if (r==true)
			{
				var form = document.createElement("form");
				form.setAttribute('method',"post");
				form.setAttribute('action',"CMS.php");			

				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", "deleteID");
				hiddenField.setAttribute("value", id);			
				form.appendChild(hiddenField);
				
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", "deleteType");
				hiddenField.setAttribute("value", type);			
				form.appendChild(hiddenField);
				
				form.submit();
			}				
		}
		if(<?php print $editFormSubmitted; ?>){
			editButton(<?php print $oldID; ?>,<?php print $oldType; ?>,<?php print $editMsg; ?>);
		}
		function enableEditing(){
			 $(".enableable").removeAttr('disabled');
			 $(".unHide").show();
			 $("#editFormButton").hide();
			 $("#saveChanges").show();			 
			 
			$('.mailButton').attr('data-target', '#NOTHING');
			$('.addressButton').attr('data-target', '#NOTHING');
			$('.phoneButton').attr('data-target', '#NOTHING'); 
			document.getElementById('btnVAddress0').click();//click all modal buttons to update arrays
			document.getElementById('btnVAddress1').click();
			document.getElementById('btnVAddress2').click();
				document.getElementById('btnVEmail0').click();
				document.getElementById('btnVEmail1').click();
				document.getElementById('btnVEmail2').click();
			document.getElementById('btnVPhone0').click();
			document.getElementById('btnVPhone1').click();
			document.getElementById('btnVPhone2').click();
				document.getElementById('btnVCancel0').click();//cancel button for closing modal windows
				document.getElementById('btnVCancel1').click();
				document.getElementById('btnVCancel2').click();
			$('.mailButton').attr('data-target', '#vEmail');
			$('.addressButton').attr('data-target', '#vAddress');
			$('.phoneButton').attr('data-target', '#vPhone');
		}
	</script>
	<script type="text/javascript">
	$(document)
		.on('change', '.btn-file :file', function() {
			var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
	});
	
	function fileName() {
		$('.btn-file :file').on('fileselect', function(event, numFiles, label) {			
			var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;
			
			if( input.length ) {
				input.val(log);
			} else {
				if( log ) {alert(log)};
			}
			
		});
	}	
	</script>
	<script type="text/javascript">
		$("#Switch").click(function(){
			alert("somehow this ran");
			$('#tableResults').DataTable();
		});
	</script>
	<script>//repopulate Address,Email,Phone entries
		<?php		
		for($i=0;$i<3;$i++)
		{			
			if(isset($_POST['caDetail'.$i]) and $_POST['caDetail'.$i] != "")print "cAddress[$i][0] = \"".$_POST['caDetail'.$i]."\";";	
			if(isset($_POST['cAddress'.$i]) and $_POST['cAddress'.$i] != "")print "cAddress[$i][1] = \"".$_POST['cAddress'.$i]."\";";	
			if(isset($_POST['cApt'.$i]) and $_POST['cApt'.$i] != "")print "cAddress[$i][2] = \"".$_POST['cApt'.$i]."\";";	
			if(isset($_POST['cCity'.$i]) and $_POST['cCity'.$i] != "")print "cAddress[$i][3] = \"".$_POST['cCity'.$i]."\";";	
			if(isset($_POST['cZip'.$i]) and $_POST['cZip'.$i] != "")print "cAddress[$i][5] = \"".$_POST['cZip'.$i]."\";";	
			
			if(isset($_POST['ceDetail'.$i]) and $_POST['ceDetail'.$i] != "")print "cEmail[$i][0] = \"".$_POST['ceDetail'.$i]."\";";	
			if(isset($_POST['cEmail'.$i]) and $_POST['cEmail'.$i] != "")print "cEmail[$i][1] = \"".$_POST['cEmail'.$i]."\";";	
			
			if(isset($_POST['cpDetail'.$i]) and $_POST['cpDetail'.$i] != "")print "cPhone[$i][0] = \"".$_POST['cpDetail'.$i]."\";";	
			if(isset($_POST['cPhone'.$i]) and $_POST['cPhone'.$i] != "")print "cPhone[$i][1] = \"".$_POST['cPhone'.$i]."\";";	
		}
		?>		
		for (var i = 0; i < 3; i++) 
		{		
			if(cAddress[i][1] != "")
			{
				document.getElementById("btnAddress"+i).setAttribute("class","btn btn-success");
			}
			if(cEmail[i][1] != "")
			{
				document.getElementById("btnEmail"+i).setAttribute("class","btn btn-success");
			}
			if(cPhone[i][1] != "")
			{
				document.getElementById("btnPhone"+i).setAttribute("class","btn btn-success");
			}	
		}	
	</script>
	<script>
	var path = 0;
	var input = 0;
	var vAddress = new Array(3);
	var vEmail = new Array(3);
	var vPhone = new Array(3);
	
	for (var i = 0; i < 3; i++) 
	{
		vAddress[i] = new Array(6);
		vEmail[i] = new Array(6);
		vPhone[i] = new Array(6);
		for(var j = 0;j < 6; j++)
		{
			vAddress[i][j] = "";
			vEmail[i][j] = "";
			vPhone[i][j] = "";
		}
	}
	function createViewArrays()//clear the arrays for new contact
	{
		for (var i = 0; i < 3; i++)	
		{
			for(var j = 0;j < 6; j++) 
			{
				vAddress[i][j] = "";
				vEmail[i][j] = "";
				vPhone[i][j] = "";
			}
		}
	}
	function viewAddress(i,detail,city,state,address,apt,zip)//set information into modal fields
	{
		if(vAddress[i][1] == "")
		{
			vAddress[i][0] = detail;
			vAddress[i][1] = address;
			vAddress[i][2] = apt;
			vAddress[i][3] = city;
			vAddress[i][4] = state;
			vAddress[i][5] = zip;
		}
		document.getElementById("vcaDetail").selectedIndex = findIndex("vcaDetail",vAddress[i][0]);//caDetail = client address Detail field
		document.getElementById("vcAddress").value = vAddress[i][1];
		document.getElementById("vcApt").value = vAddress[i][2];
		document.getElementById("vcCity").value = vAddress[i][3];
		document.getElementById("vcState").selectedIndex = findIndex("vcState",vAddress[i][4]);
		document.getElementById("vcZip").value = vAddress[i][5];
		
		input = i;
	}
	function viewEmail(i,detail,email)
	{
		if(vEmail[i][1] == "")
		{
				vEmail[i][0] = detail;
				vEmail[i][1] = email;
		}
		document.getElementById("vceDetail").selectedIndex  = findIndex("vceDetail",vEmail[i][0]);//ceDetail = client email detail field
		document.getElementById("vcEmail").value = vEmail[i][1];	
		
		input = i;
	}	
	function viewPhone(i,detail,phone)
	{
		if(vPhone[i][1] == "")
		{
				vPhone[i][0] = detail;
				vPhone[i][1] = phone;
		}		
		document.getElementById("vcpDetail").selectedIndex = findIndex("vcpDetail",vPhone[i][0]);//cpPhone = client phone detail field
		document.getElementById("vcPhone").value = vPhone[i][1];			
		
		input = i;
	}
	function viewOPhone(i,detail,phone)
	{
		if(vPhone[i][1] == "")
		{
				vPhone[i][0] = detail;
				vPhone[i][1] = phone;
		}	
		document.getElementById("vopDetail").selectedIndex = findIndex("vopDetail",vPhone[i][0]);//cpPhone = client phone detail field
		document.getElementById("voPhone").value = vPhone[i][1];			
		
		input = i;
	}
	function inputChanges(path)
	{//category; 0==address,1==email,2==phone
		
		if(path == 0)
		{
			vAddress[input][0] = document.getElementById("vcaDetail").value;
			vAddress[input][1] = document.getElementById("vcAddress").value;
			vAddress[input][2] = document.getElementById("vcApt").value;
			vAddress[input][3] = document.getElementById("vcCity").value;
			vAddress[input][4] = document.getElementById("vcState").value;
			vAddress[input][5] = document.getElementById("vcZip").value;
		}
		else if(path == 1)
		{
			vEmail[input][0] = document.getElementById("vceDetail").value;
			vEmail[input][1] = document.getElementById("vcEmail").value;	
		}
		else if(path == 2)
		{
			vPhone[input][0] = document.getElementById("vcpDetail").value;
			vPhone[input][1] = document.getElementById("vcPhone").value;
		}
		else if(path == 3)
		{
			vPhone[input][0] = document.getElementById("vopDetail").value;
			vPhone[input][1] = document.getElementById("voPhone").value;
		}			
	}
	function viewSubmit(fileCount)
	{
		var aField = new Array("vcaDetail","vcAddress","vcApt","vcCity","vcState","vcZip");//Address POST names
		var eField = new Array("vceDetail","vcEmail");//Email POST names
		var pField = new Array("vcpDetail","vcPhone");//Phone POST names
		var form = document.getElementById("vForm");
		
		for(var i = 0;i < 3;i++) {  //ADDRESS
			for(var j = 0;j < 6;j++) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", aField[j]+i);
				hiddenField.setAttribute("value", vAddress[i][j]);
			
				form.appendChild(hiddenField);
			 }
		}
		for(var i = 0;i < 3;i++) {  //EMAIL
			for(var j = 0;j < 2;j++) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", eField[j]+i);
				hiddenField.setAttribute("value", vEmail[i][j]);
			
				form.appendChild(hiddenField);
			 }
		}
		for(var i = 0;i < 3;i++) {  //PHONE
			for(var j = 0;j < 2;j++) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", pField[j]+i);
				hiddenField.setAttribute("value", vPhone[i][j]);
				
				form.appendChild(hiddenField);
			 }
		}		
				
		var offset = 0;
		for(var i = 0;i <= fileCount;i++) { //FILE
			if(document.getElementById("vLink"+i).innerHTML == "") {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", "deleteFile"+(i-offset));
				var link = document.getElementById("vLink"+i)
				hiddenField.setAttribute("value", link.href);
				
				form.appendChild(hiddenField);
			}
			else
			{
				offset++;
			}
		}
		var hiddenField = document.createElement("input");   
		hiddenField.setAttribute("type", "hidden");
		hiddenField.setAttribute("name", "maxDelete");		
		hiddenField.setAttribute("value", i-offset);
		
		form.appendChild(hiddenField);		
	}
	function viewOSubmit(fileCount)
	{
		var pField = new Array("vopDetail","voPhone");//Phone POST names
		var form = document.getElementById("vForm");
		
		for(var i = 0;i < 3;i++) {  //PHONE
			for(var j = 0;j < 2;j++) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", pField[j]+i);
				hiddenField.setAttribute("value", vPhone[i][j]);
				
				form.appendChild(hiddenField);
			 }
		}
		
		var offset = 0;
		for(var i = 0;i <= fileCount;i++) { //FILE
			if(document.getElementById("vLink"+i).innerHTML == "") {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", "deleteFile"+(i-offset));
				var link = document.getElementById("vLink"+i)
				hiddenField.setAttribute("value", link.href);
				
				form.appendChild(hiddenField);
			}
			else
			{
				offset++;
			}
		}
		var hiddenField = document.createElement("input");   
		hiddenField.setAttribute("type", "hidden");
		hiddenField.setAttribute("name", "maxDelete");		
		hiddenField.setAttribute("value", i-offset);

		form.appendChild(hiddenField);
	}
	function deleteFile(index)
	{
		document.getElementById("vLink"+index).innerHTML = "";	
		var X = document.getElementById("btnX"+index);
			X.parentNode.removeChild(X);
	}
	</script>	
	</body>
</html>
