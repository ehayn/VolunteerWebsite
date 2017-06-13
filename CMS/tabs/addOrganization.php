<div class="tab-pane" id="addOrganization">
	<div class="container theme-showcase" role="main">
		<div class="jumbotron">
			<h1>Add Organization Form</h1>
			<p>Enter organization information below.</p>
		</div>
		<div style="width:50%;margin:0 auto;">
			<form action="CMS.php" method="post" id="oForm" enctype="multipart/form-data">
			<?php print $msg2?>
				<table width=100%>
					<tr><td>
						<div class="input-group has-warning">
							<span class="input-group-addon">Name</span>
							<input type="text" class="form-control" placeholder="Organization Name" maxlength = "50" value = "<?php print $na; ?>" name = "name" id = "name">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Address</span>
							<input type="text" class="form-control" placeholder="Organization Address" maxlength = "50" value = "<?php print $adr; ?>" name = "address" id = "address">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">City</span>
							<input type="text" class="form-control" placeholder="Organization City" maxlength = "50" value = "<?php print $octy; ?>" name = "oCity" id = "oCity">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">State</span>
							<select style="width:100%;height:35px" name = "oState" id = "oState">										
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
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Zipcode</span>
							<input type="text" class="form-control" placeholder="Organization Zipcode" maxlength = "5" value = "<?php print $ozip; ?>" name = "oZipcode" id = "oZipcode">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon"><input type="button" id="btnOrgPhone0" class="btn btn-info" value="Phone 1" data-toggle="modal" data-target="#omPhone" onclick="setModal(0,3)"></span>
							<span class="input-group-addon"><input type="button" id="btnOrgPhone1" class="btn btn-info" value="Phone 2" data-toggle="modal" data-target="#omPhone" onclick="setModal(1,3)"></span>
							<span class="input-group-addon"><input type="button" id="btnOrgPhone2" class="btn btn-info" value="Phone 3" data-toggle="modal" data-target="#omPhone" onclick="setModal(2,3)"></span>				
						</div>
							<!-- Modal --><!--**********************************PHONE**************************************-->
<div class="modal fade" id="omPhone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Enter Phone</h4>
		</div>
		<div class="modal-body">
		
		<div class="input-group">		
			<span class="input-group-addon">Detail</span>
			<select style="width:100%;height:35px" name = "opDetail" id = "opDetail">
				<option value="Primary Phone">Primary Phone</option>
				<option value="Cell Phone">Cell Phone</option>
				<option value="Home Phone">Home Phone</option>
				<option value="Work Phone">Work Phone</option>
				<option value="Other Phone">Other Phone</option>
			</select>
		</div><br />
		<div class="input-group">
			<span class="input-group-addon">Phone number</span>
			<input type="text" class="form-control" placeholder="*(XXX)XXX-XXXX*" maxlength = "50" value = "" name = "oPhone" id = "oPhone" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);">
		</div>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="Discard()">Discard</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="inputInfo()">Save changes</button>
      </div>
    </div>
  </div>
</div>	
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Website</span>
							<input type = "text" class="form-control" placeholder="Website" maxlength = "50" value = "<?php print $ws; ?>" name = "site" id = "site">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<!--<div class="input-group">
							<div class="fileUpload btn btn-primary">
								<span>Select Files to Upload</span>
								<input type="file" class="upload" name="oFile[]" multiple>
							</div>
							<input id="uploadOrganizationFile" placeholder="Choose File" disabled="disabled" />
						</div>-->
						<div class="input-group">
							<span class="input-group-btn">
								<span class="btn btn-primary btn-file" onclick="fileName()">
									Select Files to Upload&hellip; <input name="oFile[]" id="uploadOrganizationFile" class="upload enableable" placeholder="Choose File" type="file" multiple>
								</span>
							</span>
							<input type="text" class="form-control" readonly>
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<button class="btn btn-lg btn-primary btn-block more" name="enter2" type="submit" value="Submit" onclick="oSubmit()">Submit</button>
					</td></tr>
				</table>
			</form>
		</div>
	</div>
</div>