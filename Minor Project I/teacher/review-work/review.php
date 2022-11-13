<?php
	session_start();
	require_once('../../connection.php');

	require_once('../../validate-teacher.php');
	if (!$teacherValid) {
		header('Location: ../../logout');
	}

    if (isset($_POST['work-review'])) {
        $workID = $_POST['workID'];

        
        if (isset($_POST['message'])) {
            $sql = "SELECT studentID, assignmentID, assignmentName, courseName FROM Works NATURAL JOIN Assignments NATURAL JOIN Courses WHERE workID=? LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $workID);
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

            $message = $_SESSION['username'] . " made a review on assignment '" . $assignmentName . "' of '". $courseName . "'.<br />Review = '" . $_POST['message'] . "'";
            $today = date("Y-m-d");
            $now = date("h:ia");

            $sql = "INSERT INTO Notifications (message, ownerID, sentDate, sentTime) Values (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('siss', $message, $studentID, $today, $now);
            $stmt->execute();
            $stmt->close();
        }

        $sql = "SELECT workID FROM Marks WHERE workID=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $workID);
        $stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
        $stmt->close();
        
        if ($num_of_rows == 0) {
            $sql = "INSERT INTO Marks (marks, workID) Values (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $_POST['marks'], $workID);
            $stmt->execute();
            $stmt->close();

        }

        $sql = "UPDATE Works SET checkedStatus=1 WHERE workID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $workID);
        $stmt->execute();
        $stmt->close();

        header('Location: ../view-assignment/?a='.$assignmentID);
        exit();
    }
?>


