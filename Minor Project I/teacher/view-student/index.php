<?php
	session_start();
	require_once('../../connection.php');

	require_once('../../validate-teacher.php');
	if (!$teacherValid || !$courseValid) {
		header('Location: ../../logout');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>View Assignment</title>		
		<link rel="stylesheet" href="../../imports/css/dashboard.css">
	</head>

<body>
	<?php
		require_once('../../imports/navbar.php');
	?>
	<div class="nav-menu-container">
		<a class="home" href="../dashboard/">Home</a>
	</div>

	<?php
		require_once('../../imports/students.php');
	?>
</body>
</html>