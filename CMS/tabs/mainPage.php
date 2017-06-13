<div class="tab-pane active" id="mainPage">
	<div class="container theme-showcase" role="main">
		<div class="jumbotron">
			<h1>Hello <?php echo $_SESSION['userName'] ?>!</h1>
			<p>Look below for statistics about the database.</p>
		</div>

		<!-- Change Password Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Change Password Form</h4>
					</div>
					<div class="modal-body">
						<form action="CMS.php" method="post" id="contact">
							<table width=100%>
								<tr><td>
									<div class="input-group">
										<span class="input-group-addon">Current Password</span>
										<input type="password" class="form-control" placeholder="Current Password" maxlength = "50" value = "<?php print $cpa; ?>" name = "userPass" id = "oldPass">
									</div>
								</td></tr>
								<tr><td><br /></td></tr>
								<tr><td>
									<div class="input-group">
										<span class="input-group-addon">New Password</span>
										<input input type = "password" class="form-control" placeholder="New Password" maxlength = "50" value = "<?php print $npa; ?>" name = "newPass" id = "newPass" >
									</div>
								</td></tr>
								<tr><td><br /></td></tr>
								<tr><td>
									<div class="input-group">
										<span class="input-group-addon">Confirm New Password</span>
										<input input type = "password" class="form-control" placeholder="Confirm New Password" maxlength = "50" value = "<?php print $cnpa; ?>" name = "confirmNewPass" id = "confirmUserPassword" >
									</div>
								</td></tr>
							</table>
							<br>
							<?php print $msg4; ?>
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" name="changePass" class="btn btn-custom">Change Password</button>
						</form>
				</div>
				</div>
			</div>
		</div>
		
		<div class="page-header">
			<h1>Statistics</h1>
		</div>
		
		<div style="width:50%;margin:0 auto;">
			<div class="row">
			<div class="col-md-6">Contacts</div>
			<div class="col-md-6">
				<?php
					$sql = "select count(*) as c from CONTACT";
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$field = mysql_fetch_object($result);
					$count = $field->c;
					echo $count;
				?>
			</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">Organizations</div>
				<div class="col-md-6">
				<?php
					$sql = "select count(*) as c from ORGANIZATION";
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$field = mysql_fetch_object($result);
					$count = $field->c;
					echo $count;
				?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">Database Users</div>
				<div class="col-md-6">
				<?php
					$sql = "select count(*) as c from DATABASE_USER";
					$result = mysql_query($sql, $conn) or die(mysql_error());
					$field = mysql_fetch_object($result);
					$count = $field->c;
					echo $count;
				?>
				</div>
			</div>
		</div>
	
	</div>
</div>