<script>
    // window.location.href = "../dashboard/?m=course-added";
    if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
    session_start();

    require_once('../../connection.php');

    require_once('../../validate-teacher.php');

    if (!$teachervalid) {
        header('Location: ../../logout');
        exit();
    }

    if(isset($_POST['create-assignment'])) {
        $today = date("Y-m-d");
        $dueDate = $_POST['dueDate'];

        $file_name = $_FILES['question']['name'];
        $file_size = $_FILES['question']['size'];
        $tmp_name = $_FILES['question']['tmp_name'];
        $error = $_FILES['question']['error'];

        require_once('./validate-uploads.php');

        if ($today > $dueDate) {
            $_SESSION['create-assignment-error'] = "Pick a valid due date";
            echo $_SESSION['create-assignment-error'];
        } else if (isvalid($file_name, $file_size, $tmp_name, $error)) {
            $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_ex_lc = strtolower($file_ex);
            $new_file_name = uniqid("qn-", true).'.'.$file_ex_lc;

            $file_upload_path = "../../files/assignment-questions/".$new_file_name;
            move_uploaded_file($tmp_name, $file_upload_path);

            $sql ="INSERT INTO Assignments (assignmentName, assignedDate, dueDate, questionURL, courseID) Values (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssssi', $_POST['assignmentName'], $today, $dueDate, $new_file_name, $_GET['c']);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            header("Location: ../view-course/?c=" . $_GET['c'] . "&msg=New Assignment Added");
            exit();
        } else {
            echo $_SESSION['create-assignment-error'];

        }
    }
?>


<link rel="stylesheet" href="../../imports/css/form.css">

<div class="form-container" style="margin-top: 30px;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="heading">Add New Assignment</div>
    
        <div class="Label">Assignment Name</div>
        <input class="input-field" type="text" name="assignmentName" class="assignmentName" autocomplete="off" required />
    
        <div class="Label">Question File</div>
        <input class="input-field" style="padding: 0;" type="file" name="question" class="question" autocomplete="off" placeholder="Upload a file" required />
    
        <div class="Label">Pick the due Date</div>
        <input class="input-field" type="date" name="dueDate" class="dueDate" autocomplete="off" required />
    
        <div class="message"></div>
    
        <input class="submit" type="submit" name="create-assignment" value="Create Assignment">
    </form>    
</div>