<?php
	session_start();//Session Variables
	require_once "utility/sessionVerify.php";//Check Session timer
	$conn = mysql_connect("localhost", "ehayn", "ehayn") or die(mysql_error());
	$select = mysql_select_db("ehayn1db", $conn);

	$type=$_REQUEST["type"];

	$contactData = "";
	$organizationData = "";
	$userData = "";
	$headers = "";
	$theID = "";
	
	if($type=='con'){
		header("Content-Disposition: attachment; filename=Contacts_Data.csv");
		$theID = 'contactID';
		$headers = array('Contact_ID','First_Name','Last_Name','Client','Donor','Volunteer','DOB','Notes','Organization');
		$sql = "select
					CONTACT.contactID,
					CONTACT.firstName,
					CONTACT.lastName,
					CONTACT.client,
					CONTACT.donor,
					CONTACT.volunteer,
					CONTACT.dateOfBirth,
					CONTACT.contactNotes,
					ORGANIZATION.name					
				from
						CONTACT
				left join 	ORGANIZATION
					on CONTACT.organizationID=ORGANIZATION.organizationID";
					
		$result = mysql_query($sql, $conn) or die(mysql_error());
		header("Content-type: text/csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$output = fopen("php://output", "w");
		fputcsv($output, $headers);
		while(($row = mysql_fetch_assoc($result))) {
			fputcsv($output, $row);
			
			$sql2 = "select
						CONTACT_ADDRESS.contactID,
						CONTACT_ADDRESS.addressDetail,
						CONTACT_ADDRESS.City,
						CONTACT_ADDRESS.State,
						CONTACT_ADDRESS.Street,
						CONTACT_ADDRESS.Apt,
						CONTACT_ADDRESS.ZipCode
					from
							CONTACT_ADDRESS
					where
							contactID = ".$row['contactID'];
			$result2 = mysql_query($sql2, $conn) or die(mysql_error());
			while(($row2 = mysql_fetch_assoc($result2))) {
				$row2['contactID'] = "";
				$row2['addressDetail'] = ucfirst($row2['addressDetail']);
				fputcsv($output, $row2);
			}
			
			$sql3 = "select
						CONTACT_EMAIL.contactID,
						CONTACT_EMAIL.Detail,
						CONTACT_EMAIL.email
					from
							CONTACT_EMAIL
					where
							contactID = ".$row['contactID'];
			$result3 = mysql_query($sql3, $conn) or die(mysql_error());
			while(($row3 = mysql_fetch_assoc($result3))) {
				$row3['contactID'] = "";
				$row3['Detail'] = ucfirst($row3['Detail']);
				fputcsv($output, $row3);
			}
			
			$sql4 = "select
						CONTACT_FILE.contactID,
						CONTACT_FILE.Detail,
						CONTACT_FILE.fileLink
					from
							CONTACT_FILE
					where
							contactID = ".$row['contactID'];
			$result4 = mysql_query($sql4, $conn) or die(mysql_error());
			while(($row4 = mysql_fetch_assoc($result4))) {
				$row4['Detail'] = ucfirst($row4['Detail']);
				$row4['contactID'] = "";
				fputcsv($output, $row4);
			}
			
			$sql5 = "select
						CONTACT_PHONE.contactID,
						CONTACT_PHONE.Detail,
						CONTACT_PHONE.PhoneNumber
					from
							CONTACT_PHONE
					where
							contactID = ".$row['contactID'];
			$result5 = mysql_query($sql5, $conn) or die(mysql_error());
			while(($row5 = mysql_fetch_assoc($result5))) {
				$row5['Detail'] = ucfirst($row5['Detail']);
				$row5['contactID'] = "";
				fputcsv($output, $row5);
			}
			
		}
		fclose($output);
	}
	
	if($type=='org'){
		header("Content-Disposition: attachment; filename=Organizations_Data.csv");
		$theID = 'organizationID';
		$headers = array('Organization_ID','Name,Website','Primary_Contact_ID','Primary_Contact');
		$sql = "select
					ORGANIZATION.organizationID,
					ORGANIZATION.name,
					ORGANIZATION.website,
					ORGANIZATION.primaryContactID,
					CONCAT(CONTACT.firstName, ' ',
					CONTACT.lastName) as contactName
				from
						ORGANIZATION
				left join	CONTACT
					on CONTACT.contactID=ORGANIZATION.primaryContactID";
					
		$result = mysql_query($sql, $conn) or die(mysql_error());
		header("Content-type: text/csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$output = fopen("php://output", "w");
		fputcsv($output, $headers);
		while(($row = mysql_fetch_assoc($result))) {
			fputcsv($output, $row);
			
			$sql2 = "select
						ORGANIZATION_ADDRESS.organizationID,
						ORGANIZATION_ADDRESS.City,
						ORGANIZATION_ADDRESS.State,
						ORGANIZATION_ADDRESS.Street,
						ORGANIZATION_ADDRESS.Zipcode
					from
							ORGANIZATION_ADDRESS
					where
							organizationID = ".$row['organizationID'];
			$result2 = mysql_query($sql2, $conn) or die(mysql_error());
			while(($row2 = mysql_fetch_assoc($result2))) {
				$row2['organizationID'] = "";
				fputcsv($output, $row2);
			}
			
			$sql3 = "select
						ORGANIZATION_FILE.organizationID,
						ORGANIZATION_FILE.Detail,
						ORGANIZATION_FILE.fileLink
					from
							ORGANIZATION_FILE
					where
							organizationID = ".$row['organizationID'];
			$result3 = mysql_query($sql3, $conn) or die(mysql_error());
			while(($row3 = mysql_fetch_assoc($result3))) {
				$row3['Detail'] = ucfirst($row3['Detail']);
				$row3['organizationID'] = "";
				fputcsv($output, $row3);
			}
			
			$sql4 = "select
						ORGANIZATION_PHONE.organizationID,
						ORGANIZATION_PHONE.Detail,
						ORGANIZATION_PHONE.PhoneNumber
					from
							ORGANIZATION_PHONE
					where
							organizationID = ".$row['organizationID'];
			$result4 = mysql_query($sql4, $conn) or die(mysql_error());
			while(($row4 = mysql_fetch_assoc($result4))) {
				$row4['Detail'] = ucfirst($row4['Detail']);
				$row4['organizationID'] = "";
				fputcsv($output, $row4);
			}
			
		}
		fclose($output);
	}

	if($type=='use'){
		header("Content-Disposition: attachment; filename=Users_Data.csv");
		$headers = array('Username','CMS_Permissions','Global_Permissions');
		$sql = "select
					DATABASE_USER.username,
					DATABASE_USER.permission,
					DATABASE_USER.permissionSite
				from
						DATABASE_USER";
	
		$result = mysql_query($sql, $conn) or die(mysql_error());
		header("Content-type: text/csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$output = fopen("php://output", "w");
		fputcsv($output, $headers);
		while(($row = mysql_fetch_assoc($result))) {
			fputcsv($output, $row);
		}
		fclose($output);
	}
	
?>