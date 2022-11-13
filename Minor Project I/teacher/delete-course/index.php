<?php
    session_start();

    require_once('../../connection.php');

    require_once('../../validate-teacher.php');
    if (!$teacherValid || !$courseValid) {
        header('Location: ../../logout');
    }

    $sql = "SELECT questionURL FROM Assignments NATURAL JOIN Courses WHERE courseID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['c']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    while ($row = $result->fetch_assoc()) {
        $questionURL = $row['questionURL'];
        unlink('../../files/assignment-questions/'.$questionURL);
    }

    $sql = "SELECT workFileURL FROM Works NATURAL JOIN Assignments NATURAL JOIN Courses WHERE courseID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['c']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    while ($row = $result->fetch_assoc()) {
        $workFileURL = $row['workFileURL'];
        unlink('../../files/work-files/'.$workFileURL);
    }

    $sql = "DELETE Marks FROM Marks JOIN Works ON Marks.workID=Works.workID NATURAL JOIN Assignments NATURAL JOIN Courses WHERE courseID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['c']);
    $stmt->execute();
    $stmt->close();

    $sql = "DELETE Works FROM Works NATURAL JOIN Assignments NATURAL JOIN Courses WHERE courseID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['c']);
    $stmt->execute();
    $stmt->close();

    $sql = "DELETE Assignments FROM Assignments NATURAL JOIN Courses WHERE courseID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['c']);
    $stmt->execute();
    $stmt->close();    

    $sql = "DELETE FROM Enrolments WHERE courseID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['c']);
    $stmt->execute();
    $stmt->close();

    $sql = "DELETE FROM Courses WHERE courseID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['c']);
    $stmt->execute();
    $stmt->close();

    header("Location: ../dashboard/?msg=Course Deleted");
?>




