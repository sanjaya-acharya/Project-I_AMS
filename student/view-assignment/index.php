<script>
    // window.location.href = "../dashboard/?m=course-added";
    if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );

    document.querySelector('iframe-qn').onload = ()=>{
        document.querySelector('iframe-qn').contentDocument.body.querySelector('img').style.width='100%';
    }
    document.querySelector('iframe').onload = ()=>{
        document.querySelector('iframe').contentDocument.body.querySelector('img').style.width='100%';
    }
}

</script>

<?php

    session_start();

    require_once('../../connection.php');

    require_once('../../validate-student.php');
    if (!$studentValid) {
        header('Location: ../../logout');
    }

    require_once ('../../imports/navbar.php');


    if(isset($_POST['unsubmit'])) {
        $sql = "SELECT workFileURL FROM Works WHERE studentID=? AND assignmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['studentID'], $_GET['a']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        while ($row = $result->fetch_assoc())
        {
            $workFileURL = $row['workFileURL'];
            unlink('../../files/work-files/'.$workFileURL);
        }
    
        $sql = "DELETE Marks FROM Marks JOIN Works ON Marks.workID = Works.workID WHERE Works.studentID=? AND Works.assignmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['studentID'], $_GET['a']);
        $stmt->execute();
        $stmt->close();
    
        $sql = "DELETE FROM Works WHERE studentID=? AND assignmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ii', $_SESSION['studentID'], $_GET['a']);
        $stmt->execute();
        $stmt->close();

        $sql = "SELECT courseID FROM Assignments WHERE assignmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_GET['a']);
        $stmt->execute();
        $result = $stmt->get_result();
        $courseID = $result->fetch_assoc()['courseID'];
        $stmt->close();
        $conn->close();

        header("Location: ../view-course/?c=" . $courseID . "&msg=Assignment Submitted");
        exit();
    }

    $sql = "SELECT questionURL FROM Assignments WHERE assignmentID=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $_GET['a']);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	$row = $result->fetch_assoc();
	$questionURL = $row['questionURL'];
?>

    <div class="container">
        <iframe class='iframe-qn' src="../../files/assignment-questions/<?= $questionURL ?>#toolbar=0" frameborder="1"></iframe>

<?php
    if(isset($_POST['submit-assignment'])) {
        $today = date("Y-m-d");
    
        $file_name = $_FILES['answer']['name'];
        $file_size = $_FILES['answer']['size'];
        $tmp_name = $_FILES['answer']['tmp_name'];
        $error = $_FILES['answer']['error'];

        $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_ex_lc = strtolower($file_ex);
        $new_file_name = uniqid("answer-", true).'.'.$file_ex_lc;

        $file_upload_path = "../../files/assignment-files/".$new_file_name;
        move_uploaded_file($tmp_name , $file_upload_path);

        $sql ="INSERT INTO Works (workFileURL, submittedDate, checkedStatus, studentID, assignmentID) VALUES (?, ?, 0, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssii', $new_file_name, $today, $_SESSION['studentID'], $_GET['a']);
        $stmt->execute();
        $stmt->close();

        $sql = "SELECT courseID FROM Assignments WHERE assignmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_GET['a']);
        $stmt->execute();
        $result = $stmt->get_result();
        $courseID = $result->fetch_assoc()['courseID'];
        $stmt->close();
        $conn->close();

        header("Location: ../view-course/?c=" . $courseID . "&msg=Assignment Submitted");
        exit();
    }
?>

<link rel="stylesheet" href="../../imports/css/form.css">

<div class="form-container" style="margin-top: 30px;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="heading">Submit Assignment</div>
    
        <div class="Label">Answer File</div>
        <input class="input-field question" accept=".jpg, .jpeg, .png, .pdf" style="padding: 0;" type="file" name="answer" autocomplete="off" placeholder="Upload a file" required />
    
        <input class="submit" type="submit" name="submit-assignment" value="Submit Assignment">
    </form>
</div>

<?php
    $sql = "SELECT workFileURL FROM Works WHERE studentID=? AND assignmentID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $_SESSION['studentID'], $_GET['a']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 1) {
        $workFileURL = $result->fetch_assoc()['workFileURL'];
        ?>
            <script>
                document.querySelector('.form-container').style.display = "none";
            </script>

            <div class="submitted-file" style="margin-top: 30px;">
                <iframe class='iframe-ans' src="../../files/assignment-files/<?= $workFileURL ?>#toolbar=0" frameborder="1"></iframe>
                <form action="" method="POST">
                    <input class='submit sec-sub' type="submit" name='unsubmit' value="UnSubmit" />
                </form>
            </div>

        <?php
    }
?>


<script>
    var uploadField = document.querySelector(".question");

    uploadField.onchange = function() {
        if(this.files[0].size > 25*1024*1024){
        alert("File is too big!");
        this.value = "";
        }
    }
</script>



<style>
	iframe {
		position: absolute;
		top: 100px;
		left: 1vw;
		width: 45vw;
		height: 80vh;
		display: block;
	}

    .iframe-ans {
        left: 47vw;
        height: 70vh;
    }

    .sec-sub {
		position: absolute;
        top: 82vh;
        left: 84vw;
    }

    .form-container {
		position: absolute;
		top: 100px;
		left: 51vw;
		width: 45vw;
		height: 70vh;
	}
</style>