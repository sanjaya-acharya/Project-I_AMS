<?php
    session_start();
    require_once('../../connection.php');
    require_once('../../validate-teacher.php');
    if (!$teachervalid) {
        header('Location: ../../logout');
    }

    if(isset($_POST['edit-assignment'])) {
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
        } else {
            echo $_SESSION['edit-assignment-error'];
        }
    }

?>

<link rel="stylesheet" href="../../imports/css/form.css">

<div class="form-container" style="margin-top: 30px;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="heading">Edit Assignment</div>
    
        <div class="Label">New Assignment Name</div>
        <input class="input-field" type="text" name="assignmentName" class="assignmentName" autocomplete="off" required />
    
        <div class="Label">Question File</div>
        <input class="input-field" style="padding: 0;" type="file" name="question" class="question" autocomplete="off" placeholder="Upload a file" required />
    
        <div class="Label">Pick the due Date</div>
        <input class="input-field" type="date" name="dueDate" class="dueDate" autocomplete="off" required />
    
        <div class="message"></div>
    
        <input class="submit" type="submit" name="edit-assignment" value="Edit Assignment">
    </form>    
</div>