<?php
	$c1 = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['username']) && isset($_SESSION['teacherID']) && isset($_SESSION['role']) && $_SESSION['role'] === "teacher";
	$num_of_rows = 0;

	if ($c1) {
		$stmt = $conn->prepare("SELECT teacherName FROM Teachers WHERE teacherID=? LIMIT 1");
		$stmt->bind_param('s', $_SESSION['teacherID']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
	}

	$teacherValid = $c1 && ($num_of_rows == 1);


	$num_of_rows = 0;

	if (isset($_GET['c'])) {
		$stmt = $conn->prepare("SELECT teacherName FROM Teachers NATURAL JOIN Courses WHERE teacherID=? and courseID=? LIMIT 1");
		$stmt->bind_param('ss', $_SESSION['teacherID'], $_GET['c']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
	}

	$courseValid = ($num_of_rows == 1);

	if (isset($_GET['a'])) {
		$stmt = $conn->prepare("SELECT teacherName FROM Teachers NATURAL JOIN Courses NATURAL JOIN Assignments WHERE teacherID=? and assignmentID=? LIMIT 1");
		$stmt->bind_param('ss', $_SESSION['teacherID'], $_GET['a']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
	}

	$assignmentValid = ($num_of_rows == 1);

	if (isset($_GET['w'])) {
		$stmt = $conn->prepare("SELECT teacherName FROM Teachers NATURAL JOIN Courses NATURAL JOIN Assignments NATURAL JOIN Works WHERE teacherID=? and workID=? LIMIT 1");
		$stmt->bind_param('ss', $_SESSION['teacherID'], $_GET['w']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
	}

	$workValid = ($num_of_rows == 1);
?>
