<?php
    session_start();

    // require_once('../../connection.php');

    // require_once('../validate-teacher.php');
    // if (!$teachervalid) {
    //     header('Location: ../../logout');
    // }
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="heading">Add New Assignment</div>

    <div>Assignment Name</div>
    <input type="text" name="assignmentName" class="assignmentName" autocomplete="off" required />

    <div>Assignment File</div>
    <input type="file" name="question" class="question" autocomplete="off" placeholder="Upload a file" required />

    <div>Pick the due Date</div>
    <input type="date" name="dueDate" class="dueDate" autocomplete="off" required />

    <div class="message"></div>

    <input type="submit" name="create-assignment" value="Create Assignment">
</form>



<style>
    * {
        display: block;
        margin: 5px 1px;
    }

input[type=file] {
    border: 1px solid black;
}


.message {
    color: red;
    font-weight: bold;
}


</style>



<?php

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

        echo "../../files/questions/".$new_file_name."<br>";
        $file_upload_path = "../../files/questions/".$new_file_name;
        move_uploaded_file($tmp_name , $file_upload_path);

        $sql ="INSERT INTO Assignments (assignmentName, assignedDate, dueDate, question, courseID) Values (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi', $_POST['assignmentName'], $today, $dueDate, $new_file_name, $_GET['c']);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo "Inserted";
    } else {
        echo $_SESSION['create-assignment-error'];

    }

}

?>
