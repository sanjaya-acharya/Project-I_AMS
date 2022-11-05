<?php
	session_start();
	require_once('../../connection.php');

/*	require_once('../validate-teacher.php');
	if (!$teachervalid) {
		header('Location: ../../logout');
	}
*/
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>View Assignment</title>		
	</head>

<body>
	<?php
		require_once('../../imports/navbar.php');
	?>
	<div class="nav-menu-container">
		<a class="disqualify-work" href="../disqualify-work/?w=<?= $_GET['w'] ?>">Disqualify</a>
	</div>

	<?php
		if (!isset($_GET['w'])) {
			header("location: ../view-assignment?err=work-not-selected");
			exit();
		} else {
			$sql = "SELECT workFileURL, studentID, assignmentID FROM Works WHERE workID=? LIMIT 1";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i', $_GET['w']);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows == 1) {
				while ($row = $result->fetch_assoc()) {
					$workFileURL = $row['workFileURL'];
					$studentID = $row['studentID'];
					$assignmentID = $row['assignmentID'];
				}
			} else {
				$workFileURL = "default.pdf";
			}
			$stmt->close();
		}
	?>

	<div class="container">
		<div class="answer">
			<iframe src="../../files/work-files/<?= $workFileURL ?>#toolbar=0" frameborder="1"></iframe>
			<div class="buttons">
				<div class="disqualify-assignment">Disqualify Assignment</div>
				<div class="download-assignment">Download</div>
			</div>
		</div>
	
		<form action="" class='review-form'>
			<div class="message">
				<label>Comment <span style="color: red;">(Optional)</span> </label>
				<input type="text" name="message">
			</div>
			<div class="marks">
				<label>Marks</label>
				<input type="number" name="marks" required>
			</div>
			<div class="submit">
				<input type="submit" value="Make Review">
			</div>
		</form>
	</div>

</body>
</html>
<style>



/*
iframe {
	width: 50vw;
	height: 70vh;
	display: block;
	margin: 1vw;
}

.buttons {
	margin-left: 1vw;
	width: 50vw;
	display: flex;
}

.buttons div {
	padding: 15px;
	font-size: 20px;
	color: #fff;
	border: 1px solid black;
	box-shadow: 0 0 2px 1px #000, inset 0 0 2px 1px #000;
	border-radius: 10px;
	display: inline;
	cursor: pointer;
}

.disqualify-assignment {
	background-color: #f00;
}

.download-assignment {
	background-color: #00f;
	margin-left: auto;
}

.disqualify-assignment:hover {
	background-color: #a00;
}

.download-assignment:hover {
	background-color: #00a;
	margin-left: auto;
}

.container {
	display: flex;
	flex-direction: row;
}

input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
	display: none;
}

.review-form {
	margin: 1vw;
	margin-left: 5vw;
	width: 30vw;
	flex-direction: column;
	border-radius: 10px;
	padding: 1.5vw;
	border: 1px solid black;
	box-shadow: 0 0 5px 1px #ccc;
	display: flex;
}

.review-form div {
	margin: 1vw;
}

.review-form div label{
	display:block;
}

.review-form div input{
	width: 35vw;
	height: 30px;
	outline: none;
	border: 1px solid black;
	border-radius: 5px;
	padding-left: 5px;
}

.submit input {
	width: 150px !important;
	height: 50px !important;
	padding: 10px !important;
	font-size: 20px;
	color: #fff;
	background-color: #0f0;
	border-radius: 10px !important;
	border: 1px solid black;
	box-shadow: 0 0 2px 1px #000, inset 0 0 2px 1px #000;
	cursor: pointer;
}

.submit input:hover {
	background-color: #0a0;
	cursor: pointer;
}

*/
</style>