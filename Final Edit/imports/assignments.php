<link rel="stylesheet" href="../../imports/css/assignments.css">
<script src="../../imports/js/assignments.js" defer></script>

<?php
	if (!(isset($_GET['c']))) {
		header('Location: ../dashboard?err=select-a-course');
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
		$sql = "SELECT assignmentID, assignmentName, assignedDate FROM assignments NATURAL JOIN courses WHERE courseID=? ORDER BY assignedDate";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('i', $_GET['c']);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();

		if ($result->num_rows == 0) {
			echo "<div class='no-assignment'>No Assignments!<br /><a clas='only-for-teachers' href='./add-assignment/'>Create New</a></div>";
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
	?>
</div>