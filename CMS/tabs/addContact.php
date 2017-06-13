<div class="tab-pane" id="addContact">
	<div class="container theme-showcase" role="main">
				<div class="jumbotron">
					<h1>Add Contact Form</h1>
					<p>Enter contact information below.</p>
				</div>
				<div id="cDiv" style="width:50%;margin:0 auto;">
					<form id="cForm" action="CMS.php" method="post" enctype="multipart/form-data">
						<?php print $msg1?>
						<table width=100%>
						
							<tr><td>
								<div class="input-group has-warning">
									<span class="input-group-addon">First Name</span>
									<input class="form-control" type="text"  placeholder="First Name" maxlength = "50" value = "<?php if(isset($_POST['contactFirstName']))print $_POST['contactFirstName']; ?>" name = "contactFirstName" id = "contactFirstName">
								</div><br />
							</td></tr>
							<tr><td>
								<div class="input-group has-warning">
									<span class="input-group-addon">Last Name</span>
									<input type="text" class="form-control" placeholder="Last Name" maxlength = "50" value = "<?php if(isset($_POST['contactLastName']))print $_POST['contactLastName']; ?>" name = "contactLastName" id = "contactLastName">
								</div><br />
							</td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Date of Birth</span>
									<input type="date" class="form-control" placeholder="MM/DD/YYYY" name = "contactDOB">
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
									<!-- ************************Modal***************************** -->
<!-- Button trigger modal -->
<div class="input-group">
<span class="input-group-addon"><input type="button" id="btnAddress0" class="btn btn-info" value="Address 1" data-toggle="modal" data-target="#cmAdress" onclick="setModal(0,0)"></span>
<span class="input-group-addon"><input type="button" id="btnAddress1" class="btn btn-info" value="Address 2" data-toggle="modal" data-target="#cmAdress" onclick="setModal(1,0)"></span>
<span class="input-group-addon"><input type="button" id="btnAddress2" class="btn btn-info" value="Address 3" data-toggle="modal" data-target="#cmAdress" onclick="setModal(2,0)"></span>
</div><br />
<div class="input-group">
<span class="input-group-addon"><input type="button" id="btnEmail0" class="btn btn-info" value="Email 1" data-toggle="modal" data-target="#cmEmail" onclick="setModal(0,1)"></span>
<span class="input-group-addon"><input type="button" id="btnEmail1" class="btn btn-info" value="Email 2" data-toggle="modal" data-target="#cmEmail" onclick="setModal(1,1)"></span>
<span class="input-group-addon"><input type="button" id="btnEmail2" class="btn btn-info" value="Email 3" data-toggle="modal" data-target="#cmEmail" onclick="setModal(2,1)"></span>
</div><br />
<div class="input-group">
<span class="input-group-addon"><input type="button" id="btnPhone0" class="btn btn-info" value="Phone 1" data-toggle="modal" data-target="#cmPhone" onclick="setModal(0,2)"></span>
<span class="input-group-addon"><input type="button" id="btnPhone1" class="btn btn-info" value="Phone 2" data-toggle="modal" data-target="#cmPhone" onclick="setModal(1,2)"></span>
<span class="input-group-addon"><input type="button" id="btnPhone2" class="btn btn-info" value="Phone 3" data-toggle="modal" data-target="#cmPhone" onclick="setModal(2,2)"></span>
</div>

<!-- Modal --><!--**********************************ADDRESS**************************************-->
<div class="modal fade" id="cmAdress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Enter Address</h4>
		</div>
		<div class="modal-body">
		
		<div class="input-group">		
			<span class="input-group-addon">Detail</span>
			<select style="width:100%;height:35px" name = "caDetail" id = "caDetail">
				<option value="Primary Address">Primary Address</option>
				<option value="Home Address">Home Address</option>
				<option value="Work Address">Work Address</option>
				<option value="Other Address">Other Address</option>
			</select>			
		</div><br />
		<div class="input-group">		
			<span class="input-group-addon">Address</span>
			<input type="text" class="form-control" placeholder="Address" maxlength = "50" value = "" name = "cAddress" id = "cAddress">
		</div>	
		<div class="input-group">
			<span class="input-group-addon">Apt. #</span>
			<input type="text" class="form-control" placeholder="Apt. #" maxlength = "50" value = "" name = "cApt" id = "cApt">
		</div>	
		<div class="input-group">				
			<span class="input-group-addon">City</span>
			<input type="text" class="form-control" placeholder="City" maxlength = "50" value = "" name = "cCity" id = "cCity">
		</div>	
		<div class="input-group">	
			<span class="input-group-addon">State</span>
			<select style="width:100%;height:35px" name = "cState" id = "cState">							
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
				<option value="IN" selected = "selected">Indiana</option>
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
			<input type="text" class="form-control" placeholder="Zipcode" maxlength = "5" value = "" name = "cZip" id = "cZip">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Discard()">Discard</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnAddress" onclick="inputInfo()">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal --><!--**********************************EMAIL**************************************-->
<div class="modal fade" id="cmEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Enter E-mail</h4>
		</div>
		<div class="modal-body">
		
		<div class="input-group">		
			<span class="input-group-addon">Detail</span>
			<select style="width:100%;height:35px" name = "ceDetail" id = "ceDetail">
				<option value="Primary Email">Primary Email</option>
				<option value="Work Email">Work Email</option>
				<option value="Other Email">Other Email</option>
			</select>				
		</div><br />	
		<div class="input-group">
			<span class="input-group-addon">E-mail Address</span>
			<input type="text" class="form-control" placeholder="E-mail" maxlength = "50" value = "" name = "cEmail" id = "cEmail">
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Discard()">Discard</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnEmail" onclick="inputInfo()">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal --><!--**********************************PHONE**************************************-->
<div class="modal fade" id="cmPhone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Enter Phone</h4>
		</div>
		<div class="modal-body">
		
		<div class="input-group">		
			<span class="input-group-addon">Detail</span>
			<select style="width:100%;height:35px" name = "cpDetail" id = "cpDetail">
				<option value="Primary Phone">Primary Phone</option>
				<option value="Cell Phone">Cell Phone</option>
				<option value="Home Phone">Home Phone</option>
				<option value="Work Phone">Work Phone</option>
				<option value="Other Phone">Other Phone</option>
			</select>
		</div><br />
		<div class="input-group">
			<span class="input-group-addon">Phone number</span>
			<input type="text" class="form-control" placeholder="*(XXX)XXX-XXXX*" maxlength = "50" value = "" name = "cPhone" id = "cPhone" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);">
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Discard()">Discard</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="inputInfo()">Save changes</button>
      </div>
    </div>
  </div>
</div>									
									
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div style="height:35px" class="input-group input-group">
									<span class="input-group-addon">Status</span>
									<span class="input-group-addon">
											<input type="checkbox" name = "client" value = "Client"> Client
											<input type="checkbox" name = "donor" value = "Donor"> Donor
											<input type="checkbox" name = "volunteer" value = "Volunteer"> Volunteer
									</span>
								</div>
							</td></tr>		
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Organization</span>
									<select style="width:100%;height:35px" name = "contactOrganization">
									<option value="<?php if(isset($_POST['contactOrganization']))print $_POST['contactOrganization']; ?>"></option>
									<!-- The following lines builds the selection boxes from the databases organizations-->
									<?php foreach ($oArray as $value): ?>
										<option value="<?php print $value ?>"><?php print $value; ?></option>
									<?php endforeach; ?>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="control-group">
										<textarea style="height:100px;" name="contactNotes" id = "contactNotes" style="height:200;width:400" placeholder = "Enter notes here" value = "<?php if(isset($_POST['contactNotes']))print $_POST['contactNotes']; ?>"></textarea>
								</div>
							</td></tr>
							<tr><td><br /></td></tr>
							<tr><td>
								<div class="input-group">
									<span class="input-group-btn">
										<span class="btn btn-primary btn-file" onclick="fileName()">
											Select Files to Upload&hellip; <input name="iFile[]" id="uploadContactFile" class="upload enableable" placeholder="Choose File" type="file" multiple>
										</span>
									</span>
									<input type="text" class="form-control" readonly>
								</div>
							</td></tr>	
							<tr><td><br /></td></tr>
							<tr><td>
								<input class="btn btn-lg btn-primary btn-block more" name="enter1" type="submit" value="Submit" onclick="cSubmit()" >
							</td></tr>
						</table>
					</form>
				</div>
			</div>
		</div>
		