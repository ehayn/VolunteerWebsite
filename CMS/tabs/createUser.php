<div class="tab-pane" id="createUser">
	<div class="container theme-showcase" role="main">
		<div class="jumbotron">
			<h1>Create New User Form</h1>
			<p>Enter user information below.</p>
		</div>
		<div style="width:50%;margin:0 auto;">
			<form action="CMS.php" method="post" id="contact">
				<?php print $msg3?>
				<table width=100%>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">First Name</span>
							<input type="text" class="form-control" placeholder="First" maxlength = "50" value = "" name = "firstName" id = "firstName">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Last Name</span>
							<input type="text" class="form-control" placeholder="Last" maxlength = "50" value = "" name = "lastName" id = "lastName">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Email</span>
							<input type="text" class="form-control" placeholder="Email" maxlength = "50" value = "<?php print $uem; ?>" name = "userEmail" id = "userEmail">
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<div class="input-group">
							<span class="input-group-addon">Permissions</span>
							<select style="width:100%;height:35px" name = "userPermissions">
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
									<input type="checkbox" name = "contactSite" value = "contactSite"> Contacts Management
									<input type="checkbox" name = "volSite" value = "volSite"> Volunteer Management
							</span>
						</div>
					</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>
						<button class="btn btn-lg btn-primary btn-block more" name="enter3" type="submit" value="Submit" >Submit</button>
					</td></tr>
				</table>
			</form>
		</div>
	</div>
</div>