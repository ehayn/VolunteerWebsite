<?php

	//contacts to database
	session_start();//Session Variables
	require_once "utility/sessionVerify.php";//Check Session timer
	$conn = mysql_connect("localhost", "ehayn", "ehayn") or die(mysql_error());
	$select = mysql_select_db("ehayn5db", $conn);

	// gets the ajax-sent string from the other file
	$id=$_REQUEST["id"];
	$type=$_REQUEST["type"];
	$msg=$_REQUEST["msg"];
	$hint="";

	if($type=='con'){
		$sql = "select
					CONTACT.contactID,
					CONTACT.firstName,
					CONTACT.lastName,
					CONTACT.client,
					CONTACT.donor,
					CONTACT.volunteer,
					CONTACT.dateOfBirth,
					CONTACT.contactNotes,
					CONTACT_EMAIL.email,
					CONTACT_ADDRESS.City,
					CONTACT_ADDRESS.State,
					CONTACT_ADDRESS.Street,
					CONTACT_ADDRESS.Apt,
					CONTACT_ADDRESS.ZipCode,
					ORGANIZATION.name					
				from
						CONTACT
				left join 	CONTACT_EMAIL
					on CONTACT.contactID=CONTACT_EMAIL.contactID
				left join 	CONTACT_ADDRESS
					on CONTACT.contactID=CONTACT_ADDRESS.contactID
				left join 	ORGANIZATION
					on CONTACT.organizationID=ORGANIZATION.organizationID
				
				where
					CONTACT.contactID = '" .$id. "'";
					
		$sql2 = "select
				  (select
					CONTACT_PHONE.Detail
				  from
					CONTACT_PHONE
				  where
					CONTACT_PHONE.contactID = '" .$id. "' LIMIT 1) as detail0,
				  (select
					CONTACT_PHONE.PhoneNumber
				  from
					CONTACT_PHONE
				  where
					CONTACT_PHONE.contactID = '" .$id. "' LIMIT 1) as phone0,
				  
					(select
				   CONTACT_PHONE.Detail
				  from
					CONTACT_PHONE
				  where
					CONTACT_PHONE.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as detail1,
				  (select
					CONTACT_PHONE.PhoneNumber
				  from
					CONTACT_PHONE
				  where
					CONTACT_PHONE.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as phone1,
				  
				  (select
					CONTACT_PHONE.Detail
				  from
					CONTACT_PHONE
				  where
					CONTACT_PHONE.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as detail2,
				  (select
					CONTACT_PHONE.PhoneNumber
				  from
					CONTACT_PHONE
				  where
					CONTACT_PHONE.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as phone2
				  
				from
				  CONTACT_PHONE
				where
				  CONTACT_PHONE.contactID = '" .$id. "'
				LIMIT 1";
				
		$sql4 = "select
				  (select
					CONTACT_EMAIL.Detail
				  from
					CONTACT_EMAIL
				  where
					CONTACT_EMAIL.contactID = '" .$id. "' LIMIT 1) as detail0,
				  (select
					CONTACT_EMAIL.email
				  from
					CONTACT_EMAIL
				  where
					CONTACT_EMAIL.contactID = '" .$id. "' LIMIT 1) as email0,
				  
					(select
				   CONTACT_EMAIL.Detail
				  from
					CONTACT_EMAIL
				  where
					CONTACT_EMAIL.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as detail1,
				  (select
					CONTACT_EMAIL.email
				  from
					CONTACT_EMAIL
				  where
					CONTACT_EMAIL.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as email1,
				  
				  (select
					CONTACT_EMAIL.Detail
				  from
					CONTACT_EMAIL
				  where
					CONTACT_EMAIL.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as detail2,
				  (select
					CONTACT_EMAIL.email
				  from
					CONTACT_EMAIL
				  where
					CONTACT_EMAIL.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as email2
				  
				from
				  CONTACT_EMAIL
				where
				  CONTACT_EMAIL.contactID = '" .$id. "'
				LIMIT 1";
				
		$sql3 = "select
				  (select
					CONTACT_ADDRESS.addressDetail
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1) as addressDetail0,
				  (select
					CONTACT_ADDRESS.City
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1) as city0,
				  (select
					CONTACT_ADDRESS.State
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1) as state0,
				  (select
					CONTACT_ADDRESS.Street
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1) as street0,
				  (select
					CONTACT_ADDRESS.Apt
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1) as apt0,
				  (select
					CONTACT_ADDRESS.ZipCode
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1) as zipcode0,
				  
				 (select
					CONTACT_ADDRESS.addressDetail
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as addressDetail1,
				  (select
					CONTACT_ADDRESS.City
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as city1,
				  (select
					CONTACT_ADDRESS.State
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as state1,
				  (select
					CONTACT_ADDRESS.Street
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as street1,
				  (select
					CONTACT_ADDRESS.Apt
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as apt1,
				  (select
					CONTACT_ADDRESS.ZipCode
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 1) as zipcode1,
				  
				 (select
					CONTACT_ADDRESS.addressDetail
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as addressDetail2,
				  (select
					CONTACT_ADDRESS.City
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as city2,
				  (select
					CONTACT_ADDRESS.State
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as state2,
				  (select
					CONTACT_ADDRESS.Street
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as street2,
				  (select
					CONTACT_ADDRESS.Apt
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as apt2,
				  (select
					CONTACT_ADDRESS.ZipCode
				  from
					CONTACT_ADDRESS
				  where
					CONTACT_ADDRESS.contactID = '" .$id. "' LIMIT 1 OFFSET 2) as zipcode2
				  
				from
				  CONTACT_ADDRESS
				where
				  CONTACT_ADDRESS.contactID = '" .$id. "'
				LIMIT 1";
				
			$sql6 = "SELECT contactID,fileLink FROM CONTACT_FILE WHERE contactID = '" .$id. "' ORDER BY fileLink ASC";
			
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$result2 = mysql_query($sql2, $conn) or die(mysql_error());
		$result3 = mysql_query($sql3, $conn) or die(mysql_error());
		$result4 = mysql_query($sql4, $conn) or die(mysql_error());
		$result6 = mysql_query($sql6, $conn) or die(mysql_error());
		
		$row = mysql_fetch_array($result);
		//code for pre-checking boxes if applicable
		$clientChecked = "";
		$donorChecked = "";
		$volunteerChecked = "";
		if ($row['client'] == "yes") {
			$clientChecked = "checked='checked'";
		}
		if ($row['donor'] == "yes") {
			$donorChecked = "checked='checked'";
		}
		if ($row['volunteer'] == "yes") {
			$volunteerChecked = "checked='checked'";
		}
		$row2 = mysql_fetch_array($result2);
		$row3 = mysql_fetch_array($result3);
		$row4 = mysql_fetch_array($result4);
		
		$sql5 = "select organizationID, name from ORGANIZATION ORDER BY name";
		$result5 = mysql_query($sql5, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
		$oArray = array();
		while(($row5 = mysql_fetch_assoc($result5))) {
		$oArray[$row5['organizationID']] = $row5['name'];}
		$oNumber = count($oArray);
		$orgsList = '';
		foreach ($oArray as $value):
			if($value != $row['name']){
				$orgsList .= "<option value='".$value."'>".$value."</option>";
			}		
		endforeach;
		
		$showFiles = "";
		$counter = -1;
		while($row6 = mysql_fetch_array($result6))
		{
			$counter++;
			$showFiles .= '<tr><td><a id="vLink'.$counter.'" href="'.$row6['fileLink'].'" target="_blank" download>'.substr($row6['fileLink'],7).'  </a>
						   </td><td><button type="button" id="btnX'.$counter.'" onclick="deleteFile('.$counter.')" class="btn btn-default btn-sm"><span  class="glyphicon glyphicon-remove"></span></button></td></tr>';
		}
		
		
			$hint = '
			<div class="container theme-showcase" role="main">
				<div class="jumbotron">
					<h1>Edit Contact Form</h1>
					<p>Update contact information below.</p>
				</div>
								
				<div id="viewResults" style="width:50%;margin:0 auto;">
					<form id="vForm"action="CMS.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="contactID" value=" '.$id.' ">'.$msg.'
						<table width=100%>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">First Name</span>
									<input type="text" class="enableable form-control" maxlength = "50" value = "'.$row['firstName'].'" name = "contactFirstName" id = "contactFirstName" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Last Name</span>
									<input type="text" class="enableable form-control" maxlength = "50" value = "'.$row['lastName'].'" name = "contactLastName" id = "contactLastName" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon"><input type="button" id="btnVAddress0" class="addressButton btn btn-info" value="Address 1" data-toggle="modal" data-target="#vAddress" onclick="viewAddress(0,\''.$row3['addressDetail0'].'\',\''.$row3['city0'].'\',\''.$row3['state0'].'\',\''.$row3['street0'].'\',\''.$row3['apt0'].'\',\''.$row3['zipcode0'].'\')"></span>
									<span class="input-group-addon"><input type="button" id="btnVAddress1" class="addressButton btn btn-info" value="Address 2" data-toggle="modal" data-target="#vAddress" onclick="viewAddress(1,\''.$row3['addressDetail1'].'\',\''.$row3['city1'].'\',\''.$row3['state1'].'\',\''.$row3['street1'].'\',\''.$row3['apt1'].'\',\''.$row3['zipcode1'].'\')"></span>
									<span class="input-group-addon"><input type="button" id="btnVAddress2" class="addressButton btn btn-info" value="Address 3" data-toggle="modal" data-target="#vAddress" onclick="viewAddress(2,\''.$row3['addressDetail2'].'\',\''.$row3['city2'].'\',\''.$row3['state2'].'\',\''.$row3['street2'].'\',\''.$row3['apt2'].'\',\''.$row3['zipcode2'].'\')"></span>
									</div><br />
									<div class="input-group">
									<span class="input-group-addon"><input type="button" id="btnVEmail0" class="mailButton btn btn-info" value="Email 1" data-toggle="modal" data-target="#vEmail" onclick="viewEmail(0,\''.$row4['detail0'].'\',\''.$row4['email0'].'\')"></span>
									<span class="input-group-addon"><input type="button" id="btnVEmail1" class="mailButton btn btn-info" value="Email 2" data-toggle="modal" data-target="#vEmail" onclick="viewEmail(1,\''.$row4['detail1'].'\',\''.$row4['email1'].'\')"></span>
									<span class="input-group-addon"><input type="button" id="btnVEmail2" class="mailButton btn btn-info" value="Email 3" data-toggle="modal" data-target="#vEmail" onclick="viewEmail(2,\''.$row4['detail2'].'\',\''.$row4['email2'].'\')"></span>
									</div><br />
									<div class="input-group">
									<span class="input-group-addon"><input type="button" id="btnVPhone0" class="phoneButton btn btn-info" value="Phone 1" data-toggle="modal" data-target="#vPhone" onclick="viewPhone(0,\''.$row2['detail0'].'\',\''.$row2['phone0'].'\')"></span>
									<span class="input-group-addon"><input type="button" id="btnVPhone1" class="phoneButton btn btn-info" value="Phone 2" data-toggle="modal" data-target="#vPhone" onclick="viewPhone(1,\''.$row2['detail1'].'\',\''.$row2['phone1'].'\')"></span>
									<span class="input-group-addon"><input type="button" id="btnVPhone2" class="phoneButton btn btn-info" value="Phone 3" data-toggle="modal" data-target="#vPhone" onclick="viewPhone(2,\''.$row2['detail2'].'\',\''.$row2['phone2'].'\')"></span>
									</div>
									
											<!-- Modal --><!--**********************************ADDRESS**************************************-->
											<div class="modal fade" id="vAddress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel">Enter Address</h4>
													</div>
													<div class="modal-body">
													
													<div class="input-group">		
														<span class="input-group-addon">Detail</span>
														<select style="width:100%;height:35px" class="enableable form-control" name = "vcaDetail" id = "vcaDetail" disabled>
															<option value="Primary Address">Primary Address</option>
															<option value="Home Address">Home Address</option>
															<option value="Work Address">Work Address</option>
															<option value="Other Address">Other Address</option>
														</select>				
													</div><br />
													<div class="input-group">		
														<span class="input-group-addon">Address</span>
														<input type="text" class="enableable form-control" placeholder="Address" maxlength = "50" value = "" name = "vcAddress" id = "vcAddress" disabled>
													</div>	
													<div class="input-group">
														<span class="input-group-addon">Apt. #</span>
														<input type="text" class="enableable form-control" placeholder="Apt. #" maxlength = "50" value = "" name = "vcApt" id = "vcApt" disabled>
													</div>	
													<div class="input-group">				
														<span class="input-group-addon">City</span>
														<input type="text" class="enableable form-control" placeholder="City" maxlength = "50" value = "" name = "vcCity" id = "vcCity" disabled>
													</div>	
													<div class="input-group">	
														<span class="input-group-addon">State</span>
														<select style="width:100%;height:35px" class="enableable" value = "" name = "vcState" id = "vcState"  disabled>							
															<option value="AL">Alabama</option>
															<option value="AK">Alaska</option>
															<option value="AZ">Arizona</option>
															<option value="AR">Arkansas</option>
															<option value="CA">California</option>
															<option value="CO">Colorado</option>
															<option value="CT">Connecticut</option>
															<option value="DE">Delaware</option>
															<option value="DC">District of Columbia</option>
															<option value="FL">Florida</option>
															<option value="GA">Georgia</option>
															<option value="HI">Hawaii</option>
															<option value="ID">Idaho</option>
															<option value="IL">Illinois</option>
															<option value="IN">Indiana</option>
															<option value="IA">Iowa</option>
															<option value="KS">Kansas</option>
															<option value="KY">Kentucky</option>
															<option value="LA">Louisiana</option>
															<option value="ME">Maine</option>
															<option value="MD">Maryland</option>	
															<option value="MA">Massachusetts</option>
															<option value="MI">Michigan</option>
															<option value="MN">Minnesota</option>
															<option value="MS">Mississippi</option>
															<option value="MO">Missouri</option>
															<option value="MT">Montana</option>
															<option value="NE">Nebraska</option>
															<option value="NV">Nevada</option>
															<option value="NH">New Hampshire</option>
															<option value="NJ">New Jersey</option>
															<option value="NM">New Mexico</option>
															<option value="NY">New York</option>
															<option value="NC">North Carolina</option>
															<option value="ND">North Dakota</option>
															<option value="OH">Ohio</option>
															<option value="OK">Oklahoma</option>
															<option value="OR">Oregon</option>
															<option value="PA">Pennsylvania</option>
															<option value="RI">Rhode Island</option>
															<option value="SC">South Carolina</option>
															<option value="SD">South Dakota</option>
															<option value="TN">Tennessee</option>
															<option value="TX">Texas</option>
															<option value="UT">Utah</option>
															<option value="VT">Vermont</option>
															<option value="VA">Virginia</option>
															<option value="WA">Washington</option>
															<option value="WV">West Virginia</option>
															<option value="WI">Wisconsin</option>
															<option value="WY">Wyoming</option>
														</select>
													</div>	
													<div class="input-group">	
														<span class="input-group-addon">Zipcode</span>
														<input type="text" class="enableable form-control" placeholder="Zipcode" maxlength = "5" value = "" name = "vcZip" id = "vcZip" disabled>
													</div>
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal" id="btnVCancel0" onclick="">Cancel</button>
													<button style="display: none" type="button" class="btn btn-primary enableable unHide" data-dismiss="modal" id="btnVAddress" onclick="inputChanges(0)" disabled>Save changes</button>
												  </div>
												</div>
											  </div>
											</div>
											<!-- Modal --><!--**********************************EMAIL**************************************-->
											<div class="modal fade" id="vEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel">Enter E-mail</h4>
													</div>
													<div class="modal-body">
													
													<div class="input-group">	

														<span class="input-group-addon">Detail</span>
															<select style="width:100%;height:35px" class="enableable form-control" name = "vceDetail" id = "vceDetail" disabled>
																<option value="Primary Email">Primary Email</option>
																<option value="Work Email">Work Email</option>
																<option value="Other Email">Other Email</option>
															</select>
													</div><br />	
													<div class="input-group">
														<span class="input-group-addon">E-mail Address</span>
														<input type="text" class="enableable form-control" placeholder="E-mail" maxlength = "50" value = "" name = "vcEmail" id = "vcEmail" disabled>
													</div>	
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal" id="btnVCancel1" onclick="">Cancel</button>
													<button style="display: none" type="button" class="btn btn-primary enableable unHide" data-dismiss="modal" id="btnEmail" onclick="inputChanges(1)" disabled>Save changes</button>
												  </div>
												</div>
											  </div>
											</div>
											<!-- Modal --><!--**********************************PHONE**************************************-->
											<div class="modal fade" id="vPhone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel">Enter Phone</h4>
													</div>
													<div class="modal-body">
													
													<div class="input-group">		
														<span class="input-group-addon">Detail</span>
														<select style="width:100%;height:35px" class="enableable form-control" placeholder="Ex: Cell Phone" value = "" name = "vcpDetail" id = "vcpDetail" disabled>
															<option value="Primary Phone">Primary Phone</option>
															<option value="Cell Phone">Cell Phone</option>
															<option value="Home Phone">Home Phone</option>
															<option value="Work Phone">Work Phone</option>
															<option value="Other Phone">Other Phone</option>
														</select>														
													</div><br />
													<div class="input-group">
														<span class="input-group-addon">Phone number</span>
														<input type="text" class="enableable form-control" placeholder="*(XXX)XXX-XXXX*" maxlength = "50" value = "" name = "vcPhone" id = "vcPhone" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);" disabled>
													</div>	
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal" id="btnVCancel2" onclick="">Cancel</button>
													<button style="display: none" type="button" class="btn btn-primary enableable unHide" data-dismiss="modal" onclick="inputChanges(2)" disabled>Save changes</button>
												  </div>
												</div>
											  </div>
											</div>												
									
								
									
									
							</td></tr>
							<tr><td><br /></td></tr>							
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Date of Birth</span>
									<input type="date" class="enableable form-control" value="'.$row['dateOfBirth'].'" name = "contactDOB" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div style="height:35px" class="input-group input-group">
									<span class="input-group-addon">Status</span>
									<span class="input-group-addon">
											<input type="checkbox" class="enableable" name = "client" value = "Client" '.$clientChecked.' disabled> Client
											<input type="checkbox" class="enableable" name = "donor" value = "Donor" '.$donorChecked.' disabled> Donor
											<input type="checkbox" class="enableable" name = "volunteer" value = "Volunteer" '.$volunteerChecked.' disabled> Volunteer
									</span>
								</div>
							</td></tr>		
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Organization'.$row['name'].'</span>
									<select class="enableable" style="width:100%;height:35px" name = "contactOrganization" disabled>
									<option value="'.$row['name'].'" selected="selected">'.$row['name'].'</option>
									<!-- The following lines builds the selection boxes from the databases organizations-->'.$orgsList.'
									</select>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="control-group">
										<textarea style="height:100px;" class="enableable" name="contactNotes" id = "contactNotes" style="height:200;width:400" disabled>'.$row['contactNotes'].'</textarea>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td><table>					
								'.$showFiles.'
							</table></td></tr>
							<tr><td><br /></td></tr>						
							<tr style="display: none" class="unHide"><td>
								<div class="input-group">
									<span class="input-group-btn">
										<span class="btn btn-primary btn-file" onclick="fileName()">
											Browse Files to Upload&hellip; <input type="file" name="iFile[]" id="uploadViewContact" class="enableable" placeholder="Choose File" disabled multiple>
										</span>
									</span>
									<input type="text" class="form-control" readonly>
								</div>
							</td></tr>	
							<tr style="display: none" class="unHide"><td><br /></td></tr>
							<tr><td>
								<button id="editFormButton" class="btn btn-custom btn-lg btn-block more" onclick="enableEditing()" type="button">Edit</button>
								<button style="display: none" id="saveChanges" name="csaveChanges" class="enableable btn btn-custom btn-lg btn-block more" type="submit" value="Submit" type="button" onclick="viewSubmit('.$counter.')" disabled>Save Changes</button>
							</td></tr>
						</table>
					</form>
				</div>
			</div>
			';
			
	}
	
	if($type=='org'){
		$sql = "select
					ORGANIZATION.organizationID,
					ORGANIZATION.name,
					ORGANIZATION.website,
					ORGANIZATION.primaryContactID,
					ORGANIZATION_ADDRESS.City,
					ORGANIZATION_ADDRESS.State,
					ORGANIZATION_ADDRESS.Street,
					ORGANIZATION_ADDRESS.Zipcode,
					ORGANIZATION_PHONE.PhoneNumber,	
					CONCAT(CONTACT.firstName, ' ',
					CONTACT.lastName) as contactName
				from
						ORGANIZATION
				left join 	ORGANIZATION_ADDRESS
					on ORGANIZATION.organizationID=ORGANIZATION_ADDRESS.organizationID
				left join 	ORGANIZATION_PHONE
					on ORGANIZATION.organizationID=ORGANIZATION_PHONE.organizationID
				left join	CONTACT
					on CONTACT.contactID=ORGANIZATION.primaryContactID
					
				where
					ORGANIZATION.organizationID = '" .$id. "'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		
		
		$row = mysql_fetch_array($result);
		
		
		$sql2 = "select
				  (select
					ORGANIZATION_PHONE.Detail
				  from
					ORGANIZATION_PHONE
				  where
					ORGANIZATION_PHONE.organizationID = '" .$id. "' LIMIT 1) as detail0,
				  (select
					ORGANIZATION_PHONE.PhoneNumber
				  from
					ORGANIZATION_PHONE
				  where
					ORGANIZATION_PHONE.organizationID = '" .$id. "' LIMIT 1) as phone0,
				  
					(select
				   ORGANIZATION_PHONE.Detail
				  from
					ORGANIZATION_PHONE
				  where
					ORGANIZATION_PHONE.organizationID = '" .$id. "' LIMIT 1 OFFSET 1) as detail1,
				  (select
					ORGANIZATION_PHONE.PhoneNumber
				  from
					ORGANIZATION_PHONE
				  where
					ORGANIZATION_PHONE.organizationID = '" .$id. "' LIMIT 1 OFFSET 1) as phone1,
				  
				  (select
					ORGANIZATION_PHONE.Detail
				  from
					ORGANIZATION_PHONE
				  where
					ORGANIZATION_PHONE.organizationID = '" .$id. "' LIMIT 1 OFFSET 2) as detail2,
				  (select
					ORGANIZATION_PHONE.PhoneNumber
				  from
					ORGANIZATION_PHONE
				  where
					ORGANIZATION_PHONE.organizationID = '" .$id. "' LIMIT 1 OFFSET 2) as phone2
				  
				from
				  ORGANIZATION_PHONE
				where
				  ORGANIZATION_PHONE.organizationID = '" .$id. "'
				LIMIT 1";
				
				$result2 = mysql_query($sql2, $conn) or die(mysql_error());
				$row2 = mysql_fetch_array($result2);
				
				$sql3 = "select contactID, CONCAT(firstName, ' ',lastName) as name from CONTACT where organizationID = '".$id."'";
				$result3 = mysql_query($sql3, $conn) or die(mysql_error()); //send the query to the database or quit if cannot connect
				$pContact0 = array();
				$pContact1 = array();
				while(($row3 = mysql_fetch_assoc($result3))) {
				$pContact1[$row3['contactID']] = $row3['name'];
				$pContact0[$row3['contactID']] = $row3['contactID'];}
				$pContactList = '';
				if(!(empty($pContact1)))
				{
					foreach (array_combine($pContact0, $pContact1) as $value0 => $value1):
							if($value0 !=  $row['primaryContactID'])
							{
								$pContactList .= "<option value='".$value0."'>".$value1."</option>";
							}					
					endforeach;
				}
				
				$sql4 = "SELECT organizationID,fileLink FROM ORGANIZATION_FILE WHERE organizationID = '" .$id. "' ORDER BY fileLink ASC";	
				$result4 = mysql_query($sql4, $conn) or die(mysql_error());				
				$showFiles = "";
				$counter = -1;
				while($row4 = mysql_fetch_array($result4))
				{
					$counter++;
					$showFiles .= '<tr><td><a id="vLink'.$counter.'" href="'.$row4['fileLink'].'" target="_blank" download>'.substr($row4['fileLink'],7).'  </a>
								   </td><td><button type="button" id="btnX'.$counter.'" onclick="deleteFile('.$counter.')" class="btn btn-default btn-sm"><span  class="glyphicon glyphicon-remove"></span></button></td></tr>';
				}
				
			$hint = '
			<div class="container theme-showcase" role="main">
				<div class="jumbotron">
					<h1>Edit Organization Form</h1>
					<p>Update organization information below.</p>
				</div>
				<div id="viewResults" style="width:50%;margin:0 auto;">
					<form action="CMS.php" method="post" id="vForm" enctype="multipart/form-data">
					<input type="hidden" name="orgID" value=" '.$id.' ">
					<?php print $msg2?>'.$msg.'
						<table width=100%>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Name</span>
									<input type="text" class="enableable form-control" maxlength = "50" value = "'.$row['name'].'" name = "name" id = "name" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Address</span>
									<input type="text" class="enableable form-control" maxlength = "50" value = "'.$row['Street'].'" name = "address" id = "address" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">City</span>
									<input type="text" class="enableable form-control" maxlength = "50" value = "'.$row['City'].'" name = "oCity" id = "oCity" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">State</span>
									<select class="enableable" value="'.$row['State'].'" style="width:100%;height:35px" name = "oState" id = "oState" disabled>
										<option value="'.$row['State'].'">'.$row['State'].'</option>
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>	
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
									</select>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Zipcode</span>
									<input type="text" class="enableable form-control" maxlength = "5" value = "'.$row['Zipcode'].'" name = "oZipcode" id = "oZipcode" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
							<span class="input-group-addon"><input type="button" id="btnVPhone0" class="btn btn-info" value="Phone 1" data-toggle="modal" data-target="#vPhone" onclick="viewOPhone(0,\''.$row2['detail0'].'\',\''.$row2['phone0'].'\')"></span>
							<span class="input-group-addon"><input type="button" id="btnVPhone1" class="btn btn-info" value="Phone 2" data-toggle="modal" data-target="#vPhone" onclick="viewOPhone(1,\''.$row2['detail1'].'\',\''.$row2['phone1'].'\')"></span>
							<span class="input-group-addon"><input type="button" id="btnVPhone2" class="btn btn-info" value="Phone 3" data-toggle="modal" data-target="#vPhone" onclick="viewOPhone(2,\''.$row2['detail2'].'\',\''.$row2['phone2'].'\')"></span>				
						</div></div>
							<!-- Modal --><!--**********************************PHONE**************************************-->
		<div class="modal fade" id="vPhone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Enter Phone</h4>
				</div>
				<div class="modal-body">
				
				<div class="input-group">		
					<span class="input-group-addon">Detail</span>
					<select style="width:100%;height:35px" class="enableable" name = "vopDetail" id = "vopDetail" disabled>
						<option value="Primary Phone">Primary Phone</option>
						<option value="Cell Phone">Cell Phone</option>
						<option value="Home Phone">Home Phone</option>
						<option value="Work Phone">Work Phone</option>
						<option value="Other Phone">Other Phone</option>
					</select>
				</div><br />
				<div class="input-group">
					<span class="input-group-addon">Phone number</span>
					<input type="text" class="enableable form-control" placeholder="*(XXX)XXX-XXXX*" maxlength = "50" value = "" name = "voPhone" id = "voPhone" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);" disabled>
				</div>	
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="">Cancel</button>
				<button style="display: none" type="button" class="enableable btn btn-primary unHide" data-dismiss="modal" onclick="inputChanges(3)" disabled>Save changes</button>
			  </div>
			</div>
		  </div>
		</div>	
								
								
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Website</span>
									<input type = "text" class="enableable form-control" maxlength = "50" value = "'.$row['website'].'" name = "site" id = "site" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Primary Contact</span>
									<select class="enableable" style="width:100%;height:35px" name = "primaryContact" disabled>
									<option value="'.$row['primaryContactID'].'" selected="selected">'.$row['contactName'].'</option>
									<!-- The following lines builds the selection boxes from the databases organizations-->'.$pContactList.'
									</select>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td><table>	
							
								'.$showFiles.'
								
							</table></td></tr>
							<tr><td><br /></td></tr>
							<tr style="display: none" class="unHide"><td>
								<div class="input-group">
									<span class="input-group-btn">
										<span class="btn btn-primary btn-file" onclick="fileName()">
											Browse Files to Upload&hellip; <input type="file" name="iFile[]" id="uploadViewOrganization" class="enableable" placeholder="Choose File" disabled multiple>
										</span>
									</span>
									<input type="text" class="form-control" readonly>
								</div>
							</td></tr>
							<tr style="display: none" class="unHide"><td><br /></td></tr>
							<tr><td>
								<button id="editFormButton" class="btn btn-custom btn-lg btn-block more" onclick="enableEditing()" type="button">Edit</button>
								<button style="display: none" id="saveChanges" name="osaveChanges" class="enableable btn btn-custom btn-lg btn-block more" type="submit" value="Submit" type="button" onclick="viewOSubmit('.$counter.')" disabled>Save Changes</button>
							</td></tr>
						</table>
					</form>
				</div>
			</div>
			';
	}
	
	if($type=='use'){
		$sql = "select
					DATABASE_USER.firstName,
					DATABASE_USER.lastName,
					DATABASE_USER.username,
					DATABASE_USER.permission,
					DATABASE_USER.permissionSite
				from
						DATABASE_USER
				where
					DATABASE_USER.userID = '" .$id. "'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		
		$row = mysql_fetch_array($result);
		
		$contactSiteChecked = "";
		$volunteerSiteChecked = "";
		if ($row['permissionSite'] == 0) {
			$contactSiteChecked = "checked='checked'";
			$volunteerSiteChecked = "checked='checked'";
		}
		if ($row['permissionSite'] == 1) {
			$contactSiteChecked = "checked='checked'";
		}
		if ($row['permissionSite'] == 2) {
			$volunteerSiteChecked = "checked='checked'";
		}
		
		$permissionWord = "";
		if ($row['permission'] == 0){
			$permissionWord = "Super Admin";
		}
		if ($row['permission'] == 1){
			$permissionWord = "View/Edit/Create/Delete";
		}
		if ($row['permission'] == 2){
			$permissionWord = "View/Edit/Create";
		}
		if ($row['permission'] == 3){
			$permissionWord = "View/Edit";
		}
		if ($row['permission'] == 4){
			$permissionWord = "View Only";
		}
		
			$hint = '
			<div class="container theme-showcase" role="main">
				<div class="jumbotron">
					<h1>Edit User Form</h1>
					<p>Update user information below.</p>
				</div>
				<div style="width:50%;margin:0 auto;">
					<form action="CMS.php" method="post" id="vForm">
					<input type="hidden" name="userID" value=" '.$id.' ">
						<?php print $msg3?>'.$msg.'
						<table width=100%>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">First Name</span>
									<input type="text" class="enableable form-control" placeholder="First" maxlength = "50" value = "'.$row['firstName'].'" name = "firstName" id = "firstName" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Last Name</span>
									<input type="text" class="enableable form-control" placeholder="Last" maxlength = "50" value = "'.$row['lastName'].'" name = "lastName" id = "lastName" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Email</span>
									<input type="text" class="enableable form-control" placeholder="Email" maxlength = "50" value = "'.$row['username'].'" name = "userEmail" id = "userEmail" disabled>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Permissions</span>
									<select class="enableable" style="width:100%;height:35px" name = "userPermissions" disabled>
										<option value="'.$row['permission'].'" selected="selected">'.$permissionWord.'</option>
										<option value="4">View Only</option>
										<option value="3">View/Edit</option>
										<option value="2">View/Edit/Create</option>
										<option value="1">View/Edit/Create/Delete</option>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div style="height:35px" class="input-group input-group">
									<span class="input-group-addon">Site Access</span>
									<span class="input-group-addon">
											<input class="enableable" type="checkbox" name = "contactSite" value = "contactSite" '.$contactSiteChecked.' disabled> Contacts Management
											<input class="enableable" type="checkbox" name = "volSite" value = "volSite" '.$volunteerSiteChecked.' disabled> Volunteer Management
									</span>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<button id="editFormButton" class="btn btn-custom btn-lg btn-block more" onclick="enableEditing()" type="button">Edit</button>
								<button style="display: none" id="saveChanges" name="usaveChanges" class="enableable btn btn-custom btn-lg btn-block more" type="submit" value="Submit" type="button" disabled>Save Changes</button>
							</td></tr>
						</table>
					</form>
				</div>
			</div>
			';
	}
	
	echo $hint==="" ? "" : $hint;
?>