
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
	<title>Teacher's Login</title>
	<link rel="stylesheet" type="text/css" href="login-style.css">
</head>
<body>
	<form method="post" onsubmit="return validateForm();">
		<div class="form-container">
			<div class="heading">Teacher's Login</div>

			<div class="form-field">
				<input type="text" name ="registrationID" class="text-input registrationID" placeholder="Registration - ID" autocomplete="off">
				<label class="label-registrationID input-label">Registration - ID</label>
				<div class="errors error-registrationID"></div>
			</div>

			<div class="form-field">
				<input type="text" name ="password" class="text-input password" placeholder="Password" autocomplete="off">
				<label class="label-password input-label">Password</label>
				<div class="errors error-password"></div>
			</div>

			<div class="wrapper-hide-show">
				<input type="checkbox" name="hide-show" class="hide-show">
				<span class="label-hide-show">Show Password</span>
			</div>

			<div class="wrapper-links">
				<div class="btn">
					<button type="submit" name="login">Log In</button>
				</div>

				<div class="errors response"></div>
				<div class="response1"></div>
			</div>

		</div>
	</form>
	
</body>
</html>

<script type="text/javascript" src="./login-script.js"></script>

<?php
	require_once "./login-validate.php";
?>
