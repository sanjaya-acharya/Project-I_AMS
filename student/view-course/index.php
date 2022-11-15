<?php
	session_start();
	require_once('../../connection.php');

	require_once('../../validate-student.php');
	if (!$studentValid) {
		header('Location: ../../logout');
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>View Course</title>
		<link rel="stylesheet" href="../../imports/css/dashboard.css">		
	</head>
	
<body>
	<?php
		require_once('../../imports/navbar.php');
	?>

	<div class="nav-menu-container">
		<a class="view-marks" href="../view-marks?c=<?= $_GET['c'] ?>">View Marks</a>
	</div>

	<?php
		require_once('../../imports/assignments.php');
	?>
</body>
</html>

<style>
.assignmentBar:hover {
	background-color: #aaa !important;
}

.project-logo {
	margin-left: 20px;
}
</style>
