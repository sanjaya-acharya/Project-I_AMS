<?php
	session_start();
	require_once('../../connection.php');

	require_once('../../validate-teacher.php');
	if (!$teacherValid && !$assignmentValid) {
		header('Location: ../../logout');
	}

    $sql = "SELECT courseID FROM Assignments WHERE assignmentID=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $_GET['a']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
	$row = $result->fetch_assoc();
	$courseID = $row['courseID'];

    $sql = "SELECT DISTINCT studentName FROM Students NATURAL JOIN Enrolments NATURAL JOIN Courses WHERE studentID NOT IN (SELECT studentID FROM Works WHERE assignmentID=?) AND courseID=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $_GET['a'], $courseID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    echo "<div class='student-list'>";
    if ($result->num_rows == 0) {
        echo "<div class='no-student'>Everyone submitted this assignment!</div>";
    } else {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='student-name'>" . $row['studentName'] . "</div>";
        }
    }
    echo "</div>";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard</title>
		<link rel="stylesheet" href="../../imports/css/dashboard.css">
	</head>
	
<body>
	<?php
		require_once('../../imports/navbar.php');
	?>

	<div class="nav-menu-container">
		<a class="home" href="../dashboard/">Home</a>
	</div>
</body>
</html>


<style>
.student-list {
    position: absolute;
    color: #fff;
    top: 100px;
    width: 60vw;
    left: 25vw;
    background-color: rgba(75, 79, 79, 0.5);
    min-height: 85vh;
}

.no-student {
    position: absolute;
    color: #fff;
    font-size: 40px;
    padding-left: 50px;
    padding-top: 50px;
}


.student-name {
    padding-left: 10px;
    font-size: 30px;
    padding: 10px 15px;
}

</style>