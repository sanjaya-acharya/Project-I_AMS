<script>
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>

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
		<title>Join Course</title>
		<link rel="stylesheet" href="../../imports/css/form.css">

	</head>
	
<body>
	<?php
		require_once('../../imports/navbar.php');
	?>

	<div class="nav-menu-container">
	</div>

	<div class="form-container" style="margin-top: 30px;">
    <form action="" method="post">
        <div class="heading">Join Course</div>
    
        <div class="Label">Enter Course Code</div>
        <input class="input-field courseCode" type="text" name="courseCode" autocomplete="off" required />
    
        <div class="message" style="font-size: 20px; color: #FFF; padding-left: 20px;"></div>
    
        <input class="submit" type="submit" name="join-course" value="Join Course">
    </form>    
</div>


</body>
</html>

<?php
	if (isset($_POST['join-course'])) {
		$num_of_rows = 0;

		$stmt = $conn->prepare("SELECT courseName FROM Courses WHERE courseID=? LIMIT 1");
		$stmt->bind_param('s', $_POST['courseCode']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
	
		$coursevalid = ($num_of_rows == 1);

		$alreadyJoined = false;
        $sql = "SELECT courseID FROM Courses NATURAL JOIN Enrolments WHERE studentID=? and courseID=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['studentID'], $_POST['courseCode']);
        $stmt->execute();
        $result = $stmt->get_result();
		$alreadyJoined = ($coursevalid && $result->num_rows == 1);

		if ($coursevalid && !$alreadyJoined) {
			$sql = "INSERT INTO Enrolments Values(?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('ss', $_SESSION['studentID'], $_POST['courseCode']);
			$stmt->execute();

			?>
				<script>
					document.querySelector('.message').textContent='Joined';
					window.location.href = "../"
				</script>
			<?php

		} else if ($alreadyJoined) {

			?>
				<script>
					document.querySelector('.message').textContent='You have already joined this course';
				</script>
			<?php

		} else {

			?>
				<script>
					document.querySelector('.message').textContent='Course not found';
				</script>
			<?php

		}
	}

?>

<style>
.navbar .menu-container {
	display: none;
}
</style>


