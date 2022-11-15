<link rel="stylesheet" href="../../imports/css/assignments.css">
<script src="../../imports/js/assignments.js" defer></script>

<?php
	if (!(isset($_GET['c']))) {
		header('Location: ../dashboard?err=select-a-course');
		exit();
	}

	$sql = "SELECT imageURL FROM courseImages NATURAL JOIN courses WHERE courseID=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $_GET['c']);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	$row = $result->fetch_assoc();
	$imageURL = $row['imageURL'];
?>

<div class="assignments">
	<img src="../../files/course-images/<?= $imageURL ?>" alt="Course Image" class="bg-img" />

	<?php
		if (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
			$sql = "SELECT assignmentID, assignmentName, assignedDate FROM assignments NATURAL JOIN courses WHERE courseID=? AND publishDate < CURRENT_TIMESTAMP ORDER BY assignedDate";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $_GET['c']);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();

			if ($result->num_rows == 0) {
				echo "<div class='no-assignment'><span>No Assignments!</span><a class='only-for-teachers' href='../add-assignment/?c=".$_GET['c']."'>Create New</a></div>";
			} else {
				while ($row = $result->fetch_assoc()) {
					$sql = "SELECT checkedStatus FROM Works NATURAL JOIN Assignments WHERE assignmentID=? AND checkedStatus=0 LIMIT 100";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param('i', $row['assignmentID']);
					$stmt->execute();
					$count = $stmt->get_result()->num_rows;
					$stmt->close();

					echo "<a class='assignmentBar' href='../view-assignment/?a=".$row['assignmentID']."'>
						<div class='assignmentName'>".$row['assignmentName']."</div>
						<div class='work-count-message'>$count</div>
					</a>";
				}
			}
		} else {
			$sql = "SELECT assignmentID, assignmentName, assignedDate FROM assignments NATURAL JOIN courses WHERE courseID=? AND publishDate < CURRENT_TIMESTAMP ORDER BY assignedDate";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $_GET['c']);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();

			if ($result->num_rows == 0) {
				echo "<div class='no-assignment'><span>No Assignments!</span></div>";
			} else {
				while ($row = $result->fetch_assoc()) {
					$barColor = '#fbb';
					$submitted = '';
					$sql = "SELECT workID FROM Works NATURAL JOIN Assignments WHERE assignmentID=? AND studentID=? LIMIT 1";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param('ii', $row['assignmentID'], $_SESSION['studentID']);
					$stmt->execute();
					if ($stmt->get_result()->num_rows == 1) {
						$barColor = '#bfb';
						$submitted = 'Submitted';
					}
					$stmt->close();

					echo "<a class='assignmentBar' style='background-color: " . $barColor . "; display: flex;' href='../view-assignment/?a=".$row['assignmentID']."'>
						<div class='assignmentName'>".$row['assignmentName']."</div>
						<div class='submitted-message' style='margin: 0 20px 0 auto;'>$submitted</div>
					</a>";
				}
			}
		}
	?>
</div>