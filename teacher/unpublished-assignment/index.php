<?php
	session_start();
	require_once('../../connection.php');

	require_once('../../validate-teacher.php');
	if (!$teacherValid || !$courseValid) {
		header('Location: ../../logout');
	}

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
		<a class="course-code" href="#">Invite Code</a>
		<a class="published-assignment" href="../view-course/?c=<?= $_GET['c'] ?>">Published Assignment</a>
	</div>

	<input type="text" class="course-code-inp" value="<?= $_GET['c'] ?>" style="display: none;" />
	<?php
		require_once('../../imports/unpublished.php');
	?>

</body>
</html>

<script>
	var copyText = document.querySelector(".course-code-inp").value;

	document.querySelector('.course-code').onclick = () => {
		navigator.clipboard.writeText(copyText).then(() => {
			alert("Course code copied to clipboard!\nshare it with students");
		});
	  }
</script>

<div class="msg"></div>

<style>
    .msg {
        position: absolute;
        top: 80px;
        left: 85vw;
		width: 15vw;
		height: 50px;
        visibility: hidden;
        background-color: #bfb;
        color: #000;
        font-size: 20px;
        z-index: 100;
		display: flex;
		font-weight: bold;
		justify-content: center;
		align-items: center;
    }
</style>

<?php
    if (isset($_GET['msg']) && $_GET['msg'] == 'naa') {
        ?>
            <script>
                document.querySelector('.msg').innerHTML = 'New Assignment Added';
                document.querySelector('.msg').style.visibility = 'visible';

				setTimeout(() => {
					document.querySelector('.msg').style.visibility = 'hidden';					
				}, 3000);
            </script>
        <?php
    } else if (isset($_GET['msg']) && $_GET['msg'] == 'ae') {
        ?>
            <script>
                document.querySelector('.msg').innerHTML = 'Assignment Edited';
                document.querySelector('.msg').style.visibility = 'visible';

				setTimeout(() => {
					document.querySelector('.msg').style.visibility = 'hidden';					
				}, 3000);
            </script>
        <?php
    }
?>

