<?php
	$_SESSION['login-response'] = "";

	// Checking if the user is already logged in
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == "student") {
		header("location: ../../student/");
		exit();
	} else if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION['role'] == "teacher") {
		header("location: ../");
		exit();
    }

	// Checking form data only when submit button is clicked
	if (isset($_POST['login'])) {
		// including the file that gives a connection to the database
		require_once "../../connection.php";
		
		// Retrieving form data from super global $_POST
		$registrationID = mysqli_real_escape_string($conn, $_POST['registrationID']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		
		// Encrypting the form data because we have encrypted password in database also
		$password = md5($password);
		
		// Preaparing and binding statements to check user credientials
		$stmt = $conn->prepare("SELECT teacherID, teacherName, password FROM Teachers WHERE teacherID=? LIMIT 1");
		$stmt->bind_param('s', $registrationID);
		$stmt->execute();
		$result = $stmt->get_result();
		$num_of_rows = $result->num_rows;
		$row = $result->fetch_assoc();
		
		if($num_of_rows == 1) {
			// If the a  row is stored in variable, the Regd-ID exists in database
			if ($row['password'] == $password) {
				// If program execution comes to this point, user had supplied correct details. 
				// So, setting session variables
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $row['teacherName'];
				$_SESSION['teacherID'] = $row['teacherID'];
				$_SESSION['role'] = "teacher";
				unset($_SESSION['login-response']);

				header("Location: ../");
				exit();
			}
			else {
				?>
					<script type="text/javascript">
						document.querySelector('.response').innerHTML = "Invalid Password";
						setTimeout(removeResponse, 2000);
						// console.log("Incorrect Password");
					</script>
				<?php
			}
		}
		else {
			?>
			<script type="text/javascript">
				document.querySelector('.response').innerHTML = "Invalid Registration-Id";
				setTimeout(removeResponse, 2000);
				// console.log("Incorrect ID");
			</script>
			<?php
		}

		$stmt->close();
		$conn->close();
	}
?>
