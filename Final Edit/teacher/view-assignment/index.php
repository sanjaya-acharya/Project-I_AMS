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
		<title>View Assignment</title>		
	</head>

<body>
	<?php
		require_once('../../imports/navbar.php');
	?>
	<div class="nav-menu-container">
		<a class="missing" href="../missing/?a=<?= $_GET['a'] ?>">Missing</a>
		<a class="edit-assignment" href="../edit-assignment/?a=<?= $_GET['a'] ?>">Edit Assignment</a>
		<a class="delete-assignment" href="../delete-assignment/?a=<?= $_GET['a'] ?>">Delete Assignment</a>
	</div>

	<?php
		require_once('../../imports/works.php');
	?>
</body>
</html>