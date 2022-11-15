<link rel="stylesheet" href="../../imports/css/works.css">
<script src="../../imports/js/works.js" defer></script>

<?php
	if (!(isset($_GET['a']))) {
		header('Location: ../view-course?err=select-an-assignment');
	}

	$Total_Reviewed_Work = 0;
	$Total_To_Review_Work = 0;

	$sql = "SELECT questionURL FROM Assignments WHERE assignmentID=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $_GET['a']);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	$row = $result->fetch_assoc();
	$questionURL = $row['questionURL'];
?>

<div class="works-container">
	<iframe class="file-preview" src="../../files/assignment-questions/<?= $questionURL ?>#toolbar=0" frameborder="1"></iframe>

	<div class="review-filters-container">
		<div class="review-filters active-filter">All</div>
		<div class="review-filters">To Review</div>
		<div class="review-filters">Reviewed</div>
	</div>

	<div class="to-review-container">
		<div class='no-work-to-review'></div>

		<?php
			$sql = "SELECT workID, studentName, submittedDate, dueDate FROM Works NATURAL JOIN Students NATURAL JOIN Assignments WHERE assignmentID=? AND checkedStatus=0 ORDER BY submittedDate, studentName";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $_GET['a']);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();

			if ($result->num_rows == 0) {
				?>
					<script>
						document.querySelector('.no-work-to-review').innerHTML = "No Works to review!";
					</script>
				<?php
			} else {
				while ($row = $result->fetch_assoc()) {
					echo "<a class='workBar' href='../review-work/?w=".$row['workID']."'>
						<div class='studentName'>".$row['studentName']."</div>";
						if ($row['submittedDate'] > $row['dueDate']){
							echo "<div class='late-msg'>Submitted Late</div>";
						} else {
							echo "<div class='late-msg'></div>";
						}
					echo "</a>";

					$Total_To_Review_Work++;				
				}
			}
		?>
	</div>

	<div class="reviewed-container">
		<div class='no-work-reviewed'></div>

		<?php
			$sql = "SELECT workID, studentName, submittedDate, dueDate FROM Works NATURAL JOIN Students NATURAL JOIN Assignments WHERE assignmentID=? AND checkedStatus=1 ORDER BY submittedDate, studentName";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $_GET['a']);
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt->close();

			if ($result->num_rows == 0) {
				?>
					<script>
						document.querySelector('.no-work-reviewed').innerHTML = "No Works reviewed!";
					</script>
				<?php
			} else {
				while ($row = $result->fetch_assoc())
				{
					echo "<a class='workBar' href='../review-work/?w=".$row['workID']."'>
						<div class='studentName'>".$row['studentName']."</div>";
						if ($row['submittedDate'] > $row['dueDate']){
							echo "<div class='late-msg'>Submitted Late</div>";
						} else {
							echo "<div class='late-msg'></div>";
						}
					echo "</a>";

					$Total_Reviewed_Work++;
				}
			}
		?>
	</div>

	<div class='no-work-at-all'></div>

	<?php
		if ($Total_Reviewed_Work + $Total_To_Review_Work == 0) {
			?>
			<script>
				document.querySelector('.no-work-at-all').innerHTML = "No Works submitted!";
				document.querySelector('.no-work-at-all').style.display = "block";
			</script>
		<?php
}
	?>

</div>