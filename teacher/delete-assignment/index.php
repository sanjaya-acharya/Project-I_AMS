<?php
    session_start();

    require_once('../../connection.php');

    require_once('../../validate-teacher.php');
    if (!$teacherValid || !$assignmentValid) {
        header('Location: ../../logout');
    }

    $sql = "SELECT questionURL FROM Assignments WHERE assignmentID=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['a']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

	$row = $result->fetch_assoc();
	$questionURL = $row['questionURL'];
    unlink('../../files/assignment-questions/'.$questionURL);

    $sql = "SELECT workFileURL FROM Works NATURAL JOIN Assignments WHERE assignmentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['a']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    while ($row = $result->fetch_assoc())
    {
        $workFileURL = $row['workFileURL'];
        unlink('../../files/work-files/'.$workFileURL);
    }

    $sql = "DELETE Marks FROM Marks JOIN Works ON Marks.workID = Works.workID NATURAL JOIN Assignments WHERE assignmentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['a']);
    $stmt->execute();
    $stmt->close();

    $sql = "DELETE Works FROM Works NATURAL JOIN Assignments WHERE assignmentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['a']);
    $stmt->execute();
    $stmt->close();

    $sql = "SELECT courseID FROM Assignments WHERE assignmentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['a']);
    $stmt->execute();
    $result = $stmt->get_result();
    $courseID = $result->fetch_assoc()['courseID'];
    $stmt->close();

    $sql = "DELETE FROM Assignments WHERE assignmentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['a']);
    $stmt->execute();
    $stmt->close();

    header("Location: ../view-course/?c=" . $courseID . "&msg=ad");
    exit();
?>
