<?php
	session_start();
	require_once('../../connection.php');

	require_once('../../validate-teacher.php');
	if (!$teacherValid || !$workValid) {
		header('Location: ../../logout');
	}

    $sql = "SELECT studentID, assignmentID, assignmentName, courseName FROM Works NATURAL JOIN Assignments NATURAL JOIN Courses WHERE workID=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['w']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $studentID = $row['studentID'];
            $assignmentID = $row['assignmentID'];
            $assignmentName = $row['assignmentName'];
            $courseName = $row['courseName'];
        }
    }

    $sql = "SELECT workFileURL FROM Works WHERE workID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['w']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    while ($row = $result->fetch_assoc())
    {
        $workFileURL = $row['workFileURL'];
        unlink('../../files/work-files/'.$workFileURL);
    }

    $sql = "DELETE Marks FROM Marks JOIN Works ON Marks.workID = Works.workID WHERE Works.workID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['w']);
    $stmt->execute();
    $stmt->close();

    $sql = "DELETE FROM Works WHERE workID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['w']);
    $stmt->execute();
    $stmt->close();

    $message = $_SESSION['username'] . " disqualified your assignment file for assignment '" . $assignmentName . "' of '" . $courseName . "'";
    $today = date("Y-m-d");
    $now = date("h:ia");

    $sql = "INSERT INTO Notifications (message, ownerID, sentDate, sentTime) Values (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siss', $message, $studentID, $today, $now);
    $stmt->execute();
    $stmt->close();

    header('Location: ../view-assignment/?a='.$assignmentID);
    exit();
?>