<?php
	session_start();
	// $_SESSION
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['role'] != "student") {
		header("location: ../login/");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>

	<link rel="stylesheet" href="AMSstyle.css">
</head>

<body>
	<div class="header">
		<img class="project-logo" src="./project-logo.png" alt="Profile-icon">
		<img class="profile-icon" src="./profile-icon.png" alt="Profile-icon">
	</div>

	<div class="menu-container">
		<div class="menu-btn">
			<div class="menu-btn__burger"></div>
		</div>
		<div class="menu">
			<div class="menuItem"><a href="#">All Tasks</a></div>
			<div class="menuItem"><a href="#">Missing Tasks</a></div>
			<div class="menuItem"><a href="#">Completed Tasks</a></div>
			<div class="menuItem"><a href="#">Marks</a></div>
		</div>
	</div>

	<div class="courses-frame">
		<!-- 
			include courses from php
		-->
		<div class="course-box">
			<img class="courseName course" src="./profile-icon.png">
			<label for="courseName">Course Name</label>
		</div>
		<div class="course-box">
			<img class="courseName course" src="./profile-icon.png">
			<label for="courseName">Course Name</label>
		</div>
		<div class="course-box">
			<img class="courseName course" src="./profile-icon.png">
			<label for="courseName">Course Name</label>
		</div>
		<div class="course-box">
			<img class="courseName course" src="./profile-icon.png">
			<label for="courseName">Course Name</label>
		</div>
	</div>
	<script src="./amsScript.js"></script>
</body>

</html>
