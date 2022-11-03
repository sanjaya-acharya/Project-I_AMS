<?php
	session_start();
	require_once('../../connection.php');

/*	require_once('../validate-teacher.php');
	if (!$teachervalid) {
		header('Location: ../../logout');
	}
*/
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard</title>
	</head>
	
<body>
	<?php
		require_once('../../imports/navbar.php');
	?>
	<div class="nav-menu-container">
		<a class="add-course" href="../add-course/">Add Course</a>
		<a class="to-review" href="../to-review/">To Review</a>
	</div>

	<?php
		require_once('../../imports/courses.php');
	?>

</body>
</html>