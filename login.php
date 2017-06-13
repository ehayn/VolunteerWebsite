<?php
session_start(); //Session Variables
$_SESSION['timeout'] = time(); //Record time for login
//PHP Variables
$un = "";
$pa = "";
$msg = "";
$una = "";
//password reset variables
$uem = ""; //email
$msg2 = ""; //notification messages
$fpClicked = false; //checks if forgot password modal has been clicked

//connect to db
require_once "CMS/utility/dbconnect.php";
require_once "CMS/utility/utility.php";
require_once "CMS/utility/mail/mail.class.php";

?>
<!DOCTYPE html>
<!-- saved from url=(0040)http://getbootstrap.com/examples/signin/ -->
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="CMS/bootstrap/images/hopeicon.ico">

    <title>Login to Hope Resource Center</title>

    <!-- Bootstrap core CSS -->
    <link href="CMS/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="CMS/css/login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	</head>

<body>

	<?php
	if(isset($_POST['enter']))
	{
		//Cut white space
		$un = trim($_POST['userName']);
		$pa = trim($_POST['password']);
		//Injection Prevention
		$em = mysql_real_escape_string($un);
		$pa = mysql_real_escape_string($pa);
		//hash password to match with database
		$ppa = sha1($pa);
		
		//Finds a Matching username and passwords, must count to 1
		$sql = "Call SP_COUNT_USER('".$un."', '".$ppa."',@count)";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$result = mysql_query("select @count as c", $conn) or die(mysql_error()); 
		$field = mysql_fetch_object($result); //the query results are objects, in this case, one object
		$count = $field->c;
		
		
		if ($count == 1)
		{	$sql = "Call SP_FIND_USER_ID('".$un."', '".$ppa."',@uid)";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			$result = mysql_query("select @uid as userID", $conn) or die(mysql_error()); 
			$field = mysql_fetch_object($result); //the query results are objects, in this case, one object
			$userID = $field->userID;
			
			$sql = "Call SP_FIND_PERMISSION('".$un."', '".$ppa."',@perm)";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			$result = mysql_query("select @perm as permission", $conn) or die(mysql_error()); 
			$field = mysql_fetch_object($result); //the query results are objects, in this case, one object
			$userPerm = $field->permission;
			
			$sql = "select permissionSite as permsite from DATABASE_USER where username = '".$un."'";
			$result = mysql_query($sql, $conn) or die(mysql_error()); 
			$field = mysql_fetch_object($result); //the query results are objects, in this case, one object
			$userPermSite = $field->permsite;
					
				
				//Initiate session variables
				$_SESSION['userID'] = $userID;
				$_SESSION['userName'] = $un;
				$_SESSION['userPermission'] = $userPerm;
				$_SESSION['loggedIn'] = true;
				$_SESSION['userPermissionSite']= $userPermSite;
				if($userPermSite == 0)
					Header ("Location:redirect.php") ;
				if($userPermSite == 1)
					Header ("Location:CMS/CMS.php") ;
				if($userPermSite == 2)
					Header ("Location:Volunteer/volunteer.php") ;
		}
		else $msg = "<br /><div class=\"alert alert-danger\" style=\"background-color:rgb(255,150,150)\"><strong>Error</strong> Invalid Login</div>";
	}
	
	if(isset($_POST['enter2']))
	{
		$fpClicked = true;
		//Cut white space
		$uem = trim($_POST['passEmail']);
		//Injection Prevention
		$uem = mysql_real_escape_string($uem);
		
		$sql = "select count(*) as c from DATABASE_USER where username = '".$uem."'";
		$result = mysql_query($sql, $conn) or die(mysql_error());
		$field = mysql_fetch_object($result);
		$count = $field->c;
		
		if ($count == 0)
			$msg2 = "<div class=\"alert alert-danger\"><strong>Error</strong> This email is not valid.</div>";
		
		if (!filter_input(INPUT_POST, 'passEmail',FILTER_VALIDATE_EMAIL))
			$msg2 = "<div class=\"alert alert-danger\"><strong>Error</strong> This email is not valid.</div>";
		
		if ($count == 1)
		{
			$npa = randomCodeGenerator(10);
			$nppa = sha1($npa);
			$sql = "update DATABASE_USER set password = '".$nppa."' where username = '".$uem."'";
			$result = mysql_query($sql, $conn) or die(mysql_error());
			
			$subject = "Hope Resource Management System";
			$body = 'Your password has been reset to: ' . $npa;
			$mailer = new Mail();
			$mailer->sendMail($uem, $uem, $subject, $body);
			
			$msg2 = "<div class=\"alert alert-success\"><strong>Success!</strong> An email reset confirmation has been sent to your email.</div>";
		}
		
	}
	
	?>       
		
	<div class="container" style="text-align:center">
	<div align = "center">
		<br><br><a href="http://hoperesourcectr.org/"><img src="CMS/images/hopelogo.jpg" width="105" height="99" alt=""></a></br>
		<h1>Hope Resource Center</h1>
	</div>		
	<form class="form-signin" role="form" action="login.php" method="post">
		<h2 align="center" class="form-signin-heading">Database Login</h2>
		<input type="text" class="form-control" placeholder="Username" maxlength = "50" value = "<?php print $un; ?>" name = "userName" id = "userName" required="" autofocus="">
		<input type="password" class="form-control" placeholder="Password" maxlength = "50" value = "" name = "password" id = "password" required="">
		<!--<label class="checkbox" style="text-align:left">
			<input type="checkbox" value="remember-me"> Remember me
		</label>-->
		<button class="btn btn-lg btn-custom btn-block" name="enter" type="submit" value="Login" >Sign in</button>
		<br />
		<!-- Button trigger modal -->
		<button id="fpModal" class="btn btn-custom btn-sm" data-toggle="modal" data-target="#myModal" type="button">Forgot Password?</button>
		<br/>
		<?php print $msg?>
	</form>
	
	<!-- Change Password Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Reset Password Form</h4>
				</div>
				<div class="modal-body">
					<form role="form" action="login.php" id="contact" method="post">
						
						<table width=100%>
							<tr><td>
								<div class="input-group">
									<span class="input-group-addon">Email Address</span>
									<input type="text" class="form-control" placeholder="Enter the e-mail address associated with your account" maxlength = "50" value = "<?php print $uem; ?>" name = "passEmail" id = "passEmail">
								</div>
							</td></tr>
						</table>
						<br>
						<?php print $msg2?>
					
				</div>
			<div class="modal-footer">
				
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button class="btn btn-custom" name="enter2" type="submit" value="send">Send Password to Email</button>
					</form>
			</div>
			</div>
		</div>
	</div>
	
	</div> <!-- /container -->

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/docs.min.js"></script>
	<script>
		fpClicked = false;
		fpClicked = <?php print $fpClicked; ?>;
		if(fpClicked){
			$("#fpModal").click();
		}
	</script>
	
</body>
</html>
