<?php
	session_start();
	require_once('../../connection.php');

	require_once('../../validate-teacher.php');
	if (!$teacherValid) {
		header('Location: ../../logout');
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard</title>
		<link rel="stylesheet" href="../../imports/css/dashboard.css">
	</head>
	
<body>
	<?php
		require_once('../../imports/navbar.php');
	?>

	<div class="nav-menu-container">
		<a class="add-course" href="../add-course/">Add Course</a>
	</div>

	<?php
		require_once('../../imports/courses.php');
	?>

</body>
</html>