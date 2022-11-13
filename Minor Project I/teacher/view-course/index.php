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
		<title>Dashboard</title>
		<link rel="stylesheet" href="../../imports/css/dashboard.css">
	</head>
	
<body>
	<?php
		require_once('../../imports/navbar.php');
	?>

	<div class="nav-menu-container">
		<a class="view-student" href="../view-student/?c=<?= $_GET['c'] ?>">View Students</a>
		<a class="course-code" href="#">Invite Code</a>
		<a class="add-assignment" href="../add-assignment/?c=<?= $_GET['c'] ?>">Add Assignment</a>
		<a class="edit-course" href="../edit-course/?c=<?= $_GET['c'] ?>">Edit Course</a>
		<a class="delete-course" href="../delete-course/?c=<?= $_GET['c'] ?>">Delete Course</a>
	</div>

	<input type="text" class="course-code-inp" value="<?= $_GET['c'] ?>" style="display: none;" />
	<?php
		require_once('../../imports/assignments.php');
	?>

</body>
</html>

<script>
	var copyText = document.querySelector(".course-code-inp").value;

	document.querySelector('.course-code').onclick = () => {
		navigator.clipboard.writeText(copyText).then(() => {
			alert("Course code copied to clipboard!\nshare it with students");
		});
	  }
</script>