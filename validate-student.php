<?php
	$c1 = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['username']) && isset($_SESSION['studentID']) && isset($_SESSION['role']) && $_SESSION['role'] === "student";
	$num_of_rows = 0;

	if ($c1) {
		$stmt = $conn->prepare("SELECT studentName FROM Students WHERE studentID=? LIMIT 1");
		$stmt->bind_param('s', $_SESSION['studentID']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
	}

	$studentValid = $c1 && ($num_of_rows == 1);


	$num_of_rows = 0;

	if (isset($_GET['c'])) {
		$stmt = $conn->prepare("SELECT studentName FROM Students NATURAL JOIN Enrolments NATURAL JOIN Courses WHERE studentID=? and courseID=? LIMIT 1");
		$stmt->bind_param('ss', $_SESSION['studentID'], $_GET['c']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
	}

	$courseValid = ($num_of_rows == 1);

	if (isset($_GET['a'])) {
		$stmt = $conn->prepare("SELECT studentName FROM Students NATURAL JOIN Enrolments NATURAL JOIN Courses NATURAL JOIN Assignments WHERE studentID=? and assignmentID=? LIMIT 1");
		$stmt->bind_param('ss', $_SESSION['studentID'], $_GET['a']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
	}

	$assignmentValid = ($num_of_rows == 1);

	if (isset($_GET['w'])) {
		$stmt = $conn->prepare("SELECT studentName FROM Students NATURAL JOIN Enrolments NATURAL JOIN Courses NATURAL JOIN Assignments NATURAL JOIN Works WHERE studentID=? and workID=? LIMIT 1");
		$stmt->bind_param('ss', $_SESSION['studentID'], $_GET['w']);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
	}

	$workValid = ($num_of_rows == 1);
?>
