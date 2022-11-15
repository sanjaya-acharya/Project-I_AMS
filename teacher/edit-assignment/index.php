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
    if (!$teacherValid || !$assignmentValid) {
        header('Location: ../../logout');
    }

    if(isset($_POST['edit-assignment'])) {
        $today = date("Y-m-d");
        $dueDate = $_POST['dueDate'];
    
        $file_name = $_FILES['question']['name'];
        $file_size = $_FILES['question']['size'];
        $tmp_name = $_FILES['question']['tmp_name'];
        $error = $_FILES['question']['error'];
    
        $sql = "SELECT questionURL FROM Assignments WHERE assignmentID=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_GET['a']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        $row = $result->fetch_assoc();
        $questionURL = $row['questionURL'];
        unlink('../../files/assignment-questions/'.$questionURL);
        
        $sql = "SELECT workFileURL FROM Works NATURAL JOIN Assignments WHERE assignmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_GET['a']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        while ($row = $result->fetch_assoc()) {
            $workFileURL = $row['workFileURL'];
            unlink('../../files/work-files/'.$workFileURL);
        }
        
        $sql = "DELETE Marks FROM Marks JOIN Works ON Marks.workID = Works.workID NATURAL JOIN Assignments WHERE assignmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_GET['a']);
        $stmt->execute();
        $stmt->close();
        
        $sql = "DELETE Works FROM Works NATURAL JOIN Assignments WHERE assignmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_GET['a']);
        $stmt->execute();
        $stmt->close();
    
        $file_ex = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_ex_lc = strtolower($file_ex);
        $new_file_name = uniqid("qn-", true).'.'.$file_ex_lc;

        $file_upload_path = "../../files/assignment-questions/".$new_file_name;
        move_uploaded_file($tmp_name , $file_upload_path);
    
        $sql ="UPDATE Assignments SET assignmentName=?, dueDate=?, questionURL=? WHERE assignmentID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $_POST['assignmentName'], $dueDate, $new_file_name, $_GET['a']);
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

        header("Location: ../view-course/?c=" . $courseID . "&msg=Assignment Edited");
        exit();
    }

?>
<link rel="stylesheet" href="../../imports/css/form.css">
<div class="form-container" style="margin-top: 30px;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="heading">Edit Assignment</div>
    
        <div class="Label">New Assignment Name</div>
        <input class="input-field assignmentName" type="text" name="assignmentName" autocomplete="off" required />
    
        <div class="Label">Question File</div>
        <input class="input-field question" accept=".jpg, .jpeg, .png, .pdf" style="padding: 0;" type="file" name="question" autocomplete="off" placeholder="Upload a file" required />
    
        <div class="Label">Publish Date</div>
        <input class="input-field publishDate" type="date" name="publishDate" autocomplete="off" required />

        <div class="Label">Publish Time</div>
        <input class="input-field publishTime" type="time" name="publishTime" autocomplete="off" required disabled />

        <div class="Label">Pick the due Date</div>
        <input class="input-field dueDate" type="date" name="dueDate" autocomplete="off" required disabled />

    
        <div class="message"></div>
    
        <input class="submit" type="submit" name="create-assignment" value="Create Assignment">
    </form>    
</div>


<script>
    let dueDate = document.querySelector(".dueDate");
    let publishDate = document.querySelector(".publishDate");
    let publishTime = document.querySelector(".publishTime");
    let uploadField = document.querySelector(".question");
    publishDate.setAttribute("min", today);

    publishDate.onchange = function () {
        dueDate.setAttribute("min", publishDate.value);
        dueDate.value = '';

        if (publishDate.value == '') {
            publishTime.disabled = true;
            dueDate.disabled = true;
        } else {
            publishTime.disabled = false;
            dueDate.disabled = false;
        }
    }

    uploadField.onchange = function() {
        if(this.files[0].size > 25*1024*1024){
            alert("File is too big!");
            this.value = "";
        }
    }
</script>

<style>
input:disabled {
    cursor: no-drop;
}

</style>