<script>
    // window.location.href = "../dashboard/?m=course-added";
    if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!
var yyyy = today.getFullYear();

if (dd < 10) {
    dd = '0' + dd
}

if (mm < 10) {
    mm = '0' + mm
}

today = yyyy + '-' + mm + '-' + dd;
</script>

<?php
    session_start();

    require_once('../../connection.php');

    require_once('../../validate-teacher.php');

    if (!$teacherValid || !$courseValid) {
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

        $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_ex_lc = strtolower($file_ex);
        $new_file_name = uniqid("qn-", true).'.'.$file_ex_lc;

        $file_upload_path = "../../files/assignment-questions/".$new_file_name;
        move_uploaded_file($tmp_name, $file_upload_path);

        $sql ="INSERT INTO Assignments (assignmentName, assignedDate, dueDate, questionURL, courseID) Values (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssi', $_POST['assignmentName'], date("Y-m-d"), $_POST['dueDate'], $new_file_name, $_GET['c']);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        header("Location: ../view-course/?c=" . $_GET['c']);
        exit();
    }

    require_once('../../imports/navbar.php');

?>

<link rel="stylesheet" href="../../imports/css/form.css">

<div class="form-container" style="margin-top: 30px;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="heading">Add New Assignment</div>
    
        <div class="Label">Assignment Name</div>
        <input class="input-field assignmentName" type="text" name="assignmentName" autocomplete="off" required />
    
        <div class="Label">Question File</div>
        <input class="input-field question" accept=".jpg, .jpeg, .png, .pdf" style="padding: 0;" type="file" name="question" autocomplete="off" placeholder="Upload a file" required />
    
        <div class="Label">Pick the due Date</div>
        <input class="input-field dueDate" type="date" name="dueDate" autocomplete="off" required />
    
        <div class="message"></div>
    
        <input class="submit" type="submit" name="create-assignment" value="Create Assignment">
    </form>    
</div>


<script>
    document.querySelector(".dueDate").setAttribute("min", today);

    var uploadField = document.querySelector(".question");

    uploadField.onchange = function() {
        if(this.files[0].size > 25*1024*1024){
        alert("File is too big!");
        this.value = "";
        }
    }
</script>