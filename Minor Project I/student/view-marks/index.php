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
		<title>View Marks</title>
		<link rel="stylesheet" href="../../imports/css/dashboard.css">		
	</head>
	
<body>
	<?php
		require_once('../../imports/navbar.php');
	?>

	<div class="nav-menu-container">
	</div>

	<div class="container">
		<?php
			$sql = "SELECT assignmentID, assignmentName, assignedDate FROM Assignments NATURAL JOIN Courses WHERE courseID=? ORDER BY assignedDate";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $_GET['c']);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();

			if ($result->num_rows != 0) {
				echo "<div class='title'>Marks</div>";
			}

			while ($row = $result->fetch_assoc()) {
				$sql = "SELECT marks FROM Marks NATURAL JOIN Works NATURAL JOIN Students NATURAL JOIN Assignments WHERE assignmentID=? AND studentID=?";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param('ii', $row['assignmentID'], $_SESSION['studentID']);
				$stmt->execute();
				if (isset($stmt->get_result()->fetch_assoc()['marks'])){
					$marks = $stmt->get_result()->fetch_assoc()['marks'];
				} else {
					$marks = 0;
				}
				if ($marks == NULL) {
					$marks = 0;
				}
				$stmt->close();
		
					echo "<a class='assignmentBar' href='#'>
						<div class='assignmentName'>".$row['assignmentName']."</div>
						<div class='marks' style='margin: 0 20px 0 auto;'>$marks</div>
					</a>";
				}
		?>
	</div>
</body>
</html>

<style>
.navbar .menu-container {
	display: none;
}

.title {
	font-size: 30px;
	color: #FFF;
}

.container {
	position: absolute;
	top: 100px;
	width: 70vw;
	margin-left: 15vw;
}

.assignmentBar {
	font-size: 20px;
	font-weight: bold;
	height: 7vh;
	display: flex;
	align-items: center;
	padding-left: 20px;
	cursor: pointer;
	text-decoration: none;
	background-color: rgba(170, 170, 170, 0.7);
	color: #000;
	border: 1px solid #c0e0e0;
	display: flex;
}

.assignmentBar:hover {
	background-color: #aaa !important;
}

.project-logo {
	margin-left: 20px;
}
</style>
