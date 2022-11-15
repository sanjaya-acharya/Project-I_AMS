<?php
	session_start();
	require_once('../../connection.php');

	require_once('../../validate-teacher.php');
	if (!$teacherValid || !$workValid) {
		header('Location: ../../logout');
	}

	$sql = "SELECT workFileURL, studentID, assignmentName, courseName FROM Works NATURAL JOIN Assignments NATURAL JOIN Courses WHERE workID=? LIMIT 1";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $_GET['w']);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows == 1) {
		while ($row = $result->fetch_assoc()) {
			$workFileURL = $row['workFileURL'];
			$studentID = $row['studentID'];
			$assignmentName = $row['assignmentName'];
			$courseName = $row['courseName'];
		}
	} else {
		$workFileURL = "default.pdf";
	}
	$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Review Assignment</title>
		<link rel="stylesheet" href="../../imports/css/form.css">
	</head>

<body>
	<?php
		require_once('../../imports/navbar.php');
	?>
	<div class="nav-menu-container">
		<a class="disqualify-work" href="./disqualify-work.php?w=<?= $_GET['w'] ?>">Disqualify</a>
	</div>

	<div class="container">
		<div class="answer">
			<iframe src="../../files/assignment-files/<?= $workFileURL ?>#toolbar=0" frameborder="1"></iframe>
		</div>
	
		<div class="form-container" style="padding: 20px; width: 45vw; border: 1px solid black;">
			<form action="./review.php" class='review-form' method="POST">
				<label class="Label">Comment <span style="color: red;">(Optional)</span> </label>
				<input class="input-field" style="width: 40vw;" type="text" name="message">
	
				<label class="Label">Marks</label>
				<input class="input-field" style="width: 40vw;" type="number" name="marks" value='10' required>

				<input style="display: none;" type="number" name="workID" value='<?= $_GET['w'] ?>' >
	
				<input class='submit' type="submit" value="Make Review" name="work-review">
			</form>
		</div>
	</div>

</body>
</html>
<style>
	iframe {
		position: absolute;
		top: 100px;
		left: 1vw;
		width: 45vw;
		height: 80vh;
		display: block;
	}

	.form-container {
		position: absolute;
		top: 100px;
		left: 51vw;
		width: 45vw;
		height: 80vh;
	}
</style>