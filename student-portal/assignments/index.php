<?php
	require_once "../../connection.php";

	session_start();
	// $_SESSION
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false || $_SESSION['role'] != "student") {
		header("location: ../login/");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
	# select * from assignments and show in a div tag
	# attach a link to the assignments to forward users to respective view assignment page
?>

</body>
</html>