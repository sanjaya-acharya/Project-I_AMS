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
		<title>View Course</title>		
	</head>
	
<body>
	<?php
		require_once('../../imports/navbar.php');
	?>

	<div class="nav-menu-container">
		<a class="add-assignment" href="../add-assignment/?c=<?= $_GET['c'] ?>">Add Assignment</a>
		<a class="view-student" href="../view-student/?c=<?= $_GET['c'] ?>">View Students</a>
		<a class="add-student" href="../add-student/?c=<?= $_GET['c'] ?>">Add Student</a>
		<a class="edit-course" href="../edit-course/?c=<?= $_GET['c'] ?>">Edit Course</a>
		<a class="delete-course" href="../delete-course/?c=<?= $_GET['c'] ?>">Delete Course</a>
	</div>

	<?php
		require_once('../../imports/assignments.php');
	?>

</body>
</html>