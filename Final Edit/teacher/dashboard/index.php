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
	</div>

	<?php
		require_once('../../imports/courses.php');

		if (isset($_GET['msg'])) {
					echo "<div class='temp-message' style='color: red; font-size: 30px; font-weight: bold; margin-left: 15vw; margin-top: 20px;'>" . $_GET['msg'] . "</div>";
					?>
						<script>
							window.scrollTo(0, document.body.scrollHeight);
						</script>
					<?php
		} else {
			echo "<div class='temp-message'></div>";
		}
	?>

</body>
</html>

<script>
let tempMsgBox = document.querySelector(".temp-message");
setTimeout(() => {
	tempMsgBox.style.display = "none";
}, 2000);

</script>