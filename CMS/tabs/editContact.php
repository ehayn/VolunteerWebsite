<div class="tab-pane" id="editContact">
	<div class="container theme-showcase" role="main">
		<div class="jumbotron">
			<h1>Edit Contact Form</h1>
			<p>Change contact information below.</p>
		</div>
		<div style="width:50%;margin:0 auto;">
			<form action="CMS.php" method="post" id="editContactForm">
				<?php print $msg1?>
				<table width=100%>
				
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">First Name</span>
							<input type="text" class="form-control" placeholder="First Name" maxlength = "50" value = "<?php print $cfna; ?>" name = "contactFirstName" id = "contactFirstName">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Last Name</span>
							<input type="text" class="form-control" placeholder="Last Name" maxlength = "50" value = "<?php print $clna; ?>" name = "contactLastName" id = "contactLastName">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>		
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">E-mail</span>
							<input type="email" class="form-control" placeholder="E-mail Address" maxlength = "50" value = "<?php print $cem; ?>" name = "contactEmail" id = "contactEmail">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Phone</span>
							<input type="text" class="form-control" placeholder="Phone Number" maxlength = "50" value = "<?php print $cph; ?>" name = "contactPhone" id = "contactPhone" onkeydown="javascript:backspacerDOWN(this,event);" onkeyup="javascript:backspacerUP(this,event);">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Address</span>
							<input type="text" class="form-control" placeholder="Address" maxlength = "50" value = "<?php print $cadr; ?>" name = "contactAddress" id = "contactAddress">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Apt. #</span>
							<input type="text" class="form-control" placeholder="Apt. #" maxlength = "50" value = "<?php print $capt; ?>" name = "cApt" id = "cApt">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">City</span>
							<input type="text" class="form-control" placeholder="City" maxlength = "50" value = "<?php print $ccty; ?>" name = "cCity" id = "cCity">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
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
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Zipcode</span>
							<input type="text" class="form-control" placeholder="Zipcode" maxlength = "5" value = "<?php print $czip; ?>" name = "cZipcode" id = "cZipcode">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Date of Birth</span>
							<input type="date" class="form-control" placeholder="Address" name = "contactDOB">
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
							<option value="<?php print $cog ?>"></option>
							<!-- The following lines builds the selection boxes from the databases organizations-->
							<?php foreach ($oArray as $value): ?>
								<option value="<?php print $value ?>"><?php print $value; ?></option>
							<?php endforeach; ?>
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="control-group">
								<textarea style="height:100px;" name="contactNotes" id = "contactNotes" style="height:200;width:400" placeholder = "Enter notes here" value = "<?php print $cnotes; ?>"></textarea>
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<div class="fileUpload btn btn-primary">
								<span>Select Files to Upload</span>
								<input type="file" class="upload" name="contactFiles" id="uploadBtnContact" multiple/>
							</div>
							<input id="uploadContactFile" placeholder="Choose File" disabled="disabled" />
						</div>
					</td></tr>	
					<tr><td><br /></td></tr>
					<tr><td>
						<button class="btn btn-lg btn-primary btn-block more" name="editContact" type="submit" value="Submit" >Submit</button>
					</td></tr>
				</table>
			</form>
		</div>
	</div>
</div>