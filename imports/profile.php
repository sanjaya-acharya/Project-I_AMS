<link rel="stylesheet" href="../../imports/css/profile.css">
<script src="../../imports/js/profile.js" defer></script>

<?php
	session_start();
	$_SESSION['role'] = teacher;
	$_SESSION['regd-id'] = 38523;

	$sql = "SELECT * FROM ? WHERE ?=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ssi', $_SESSION['role'].'s', $_SESSION['role'].'ID', $_SESSION['regd-id']);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	$row = $result->fetch_assoc();
?>

<div class="profile-details">
	<div class="name"><?= $_SESSION['username'] ?></div>
	<div class="regd-id"><?= ?></div>
</div>