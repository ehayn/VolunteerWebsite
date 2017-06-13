<?php
//contacts to database
session_start();//Session Variables
require_once "utility/sessionVerify.php";//Check Session timer
$conn = mysql_connect("localhost", "ehayn", "ehayn") or die(mysql_error());
$select = mysql_select_db("ehayn5db", $conn);

// gets the ajax-sent string from the other file
$s1=$_REQUEST["s1"];
$hint="";

if ($s1 == "con"){
	
		//gets data from the database
		$sql = "select
					CONTACT.contactID,
					CONTACT.firstName,
					CONTACT.lastName,
					CONTACT_PHONE.PhoneNumber,
					CONTACT_EMAIL.email,
					CONTACT_ADDRESS.City,
					CONTACT_ADDRESS.State,
					ORGANIZATION.name					
				from
						CONTACT
				left join 	CONTACT_PHONE
					on CONTACT.contactID=CONTACT_PHONE.contactID
				left join 	CONTACT_EMAIL
					on CONTACT.contactID=CONTACT_EMAIL.contactID
				left join 	CONTACT_ADDRESS
					on CONTACT.contactID=CONTACT_ADDRESS.contactID
				left join 	ORGANIZATION
					on CONTACT.organizationID=ORGANIZATION.organizationID
				group by contactID
				";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	
}

if ($s1 == "org"){
	
		//gets data from the database
		$sql = "select
					ORGANIZATION.organizationID,
					ORGANIZATION.name,
					ORGANIZATION.website,
					ORGANIZATION_PHONE.PhoneNumber,
					ORGANIZATION_ADDRESS.City,
					ORGANIZATION_ADDRESS.State					
				from
						ORGANIZATION
				left join 	ORGANIZATION_PHONE
					on ORGANIZATION.organizationID=ORGANIZATION_PHONE.organizationID
				left join 	ORGANIZATION_ADDRESS
					on ORGANIZATION.organizationID=ORGANIZATION_ADDRESS.organizationID
				group by organizationID
				";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	
}

if ($s1 == "use"){
	
		//gets data from the database
		$sql = "select
					DATABASE_USER.userID,
					DATABASE_USER.firstName,
					DATABASE_USER.lastName,
					DATABASE_USER.username,
					DATABASE_USER.permission
				from
						DATABASE_USER
				";
		$result = mysql_query($sql, $conn) or die(mysql_error());
	
}

if($_SESSION['userPermission'] < 3)
	$editHeader = '<th style="font-weight:bold">Edit</th>
					<th style="font-weight:bold">Delete</th>';
elseif($_SESSION['userPermission'] < 4)
	$editHeader = '<th style="font-weight:bold">Edit</th>';
else
	$editHeader = "";

if($s1 == "con"){
	$hint = '<table id="dataTablesResults" class="table table-striped">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Phone Number</th>
						<th>E-mail</th>
						<th>Organization</th>'
						.$editHeader.
					'</tr>
				</thead>
				<tbody>';
}

if($s1 == "org"){
	$hint = '<table id="dataTablesResults" class="table table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>State</th>
						<th>Phone Number</th>
						<th>Website</th>'
						.$editHeader.
					'</tr>
				</thead>
				<tbody>';
}

if($s1 == "use"){
	$hint = '<table id="dataTablesResults" class="table table-striped">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Username/E-mail</th>
						<th>Permission</th>'
						.$editHeader.
					'</tr>
				</thead>
				<tbody>';
}

while($row = mysql_fetch_array($result)){
		if($s1 == "con"){
		
		if($_SESSION['userPermission'] < 3)
			$editButton = '<td><button id="'.$row['contactID'].'" class="btn btn-custom btn-sm" onclick="editButton(this.id,\'con\',\'\')" type="button">Edit</button></td>
						   <td><button id="'.$row['contactID'].'" class="btn btn-custom btn-sm" onclick="deleteButton(this.id,\'con\')" type="button">Delete</button></td>';
		elseif($_SESSION['userPermission'] < 4)
			$editButton = '<td><button id="'.$row['contactID'].'" class="btn btn-custom btn-sm" onclick="editButton(this.id,\'con\',\'\')" type="button">Edit</button></td>';
		else
			$editButton = "";
		
			$hint .= '<tr><td>'.$row['firstName'].'</td><td>'.$row['lastName'].'</td><td>'.$row['PhoneNumber'].'</td><td><a href="mailto:'.$row['email'].'">'.$row['email'].'</a></td><td>'.$row['name'].'</td>'.$editButton.'</tr>';
		}
		if($s1 == "org"){
		
		if($_SESSION['userPermission'] < 3)
			$editButton = '<td><button id="'.$row['organizationID'].'" class="btn btn-custom btn-sm" onclick="editButton(this.id,\'org\',\'\')" type="button">Edit</button></td>
						   <td><button id="'.$row['organizationID'].'" class="btn btn-custom btn-sm" onclick="deleteButton(this.id,\'org\')" type="button">Delete</button></td>';
		elseif($_SESSION['userPermission'] < 4)
			$editButton = '<td><button id="'.$row['organizationID'].'" class="btn btn-custom btn-sm" onclick="editButton(this.id,\'org\',\'\')" type="button">Edit</button></td>';
		else
			$editButton = "";
		
		
		
			$hint .= '<tr><td>'.$row['name'].'</td><td>'.$row['State'].'</td><td>'.$row['PhoneNumber'].'</td><td><a href="http://'.$row['website'].'">'.$row['website'].'</a></td>'.$editButton.'</tr>';
		}
		if($s1 == "use"){
		
		if($row['permission'] == 4)
			$permissions = "View Only";
		if($row['permission'] == 3)
			$permissions = "View/Edit";
		if($row['permission'] == 2)
			$permissions = "View/Edit/Create";
		if($row['permission'] == 1)
			$permissions = "View/Edit/Create/Delete";
		if($row['permission'] == 0)
			$permissions = "Super Admin";
		
		if($_SESSION['userPermission'] < 3)
			$editButton = '<td><button id="'.$row['userID'].'" class="btn btn-custom btn-sm" onclick="editButton(this.id,\'use\',\'\')" type="button">Edit</button></td>
						   <td><button id="'.$row['userID'].'" class="btn btn-custom btn-sm" onclick="deleteButton(this.id,\'use\')" type="button">Delete</button></td>';
		elseif($_SESSION['userPermission'] < 4)
			$editButton = '<td><button id="'.$row['userID'].'" class="btn btn-custom btn-sm" onclick="editButton(this.id,\'use\',\'\')" type="button">Edit</button></td>';
		else
			$editButton = "";
		
		
			$hint .= '<tr><td>'.$row['firstName'].'</td><td>'.$row['lastName'].'</td><td>'.$row['username'].'</td><td>'.$permissions.'</td>'.$editButton.'</tr>';
		}
}

if($s1 == "con"){
	$hint .= '</tbody>
			</table>';
}

if($s1 == "org"){
	$hint .= '</tbody>
			</table>';
}

if($s1 == "use"){
	$hint .= '</tbody>
			</table>';
}

// Output "no suggestion" if no hint were found
// or output the correct values 
echo $hint==="" ? "" : $hint;
?>