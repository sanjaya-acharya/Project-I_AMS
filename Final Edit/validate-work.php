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

	$teachervalid = $c1 && ($num_of_rows == 1);
?>