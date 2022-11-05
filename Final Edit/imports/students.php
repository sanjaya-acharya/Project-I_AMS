<link rel="stylesheet" href="../../imports/css/view-students.css">
<script src="../../imports/js/view-students.js" defer></script>


<?php
    if (isset($_POST['remove-student-btn'])) {
        foreach ($_POST['removeStudent'] as $studentID) {
            // delete marks
            $sql = "DELETE Marks FROM Marks NATURAL JOIN Works NATURAL JOIN Assignments NATURAL JOIN Courses WHERE courseID=? and studentID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $_GET['c'], $studentID);
            $stmt->execute();
            $stmt->close();

            // delete work files
            $sql = "SELECT workFileURL FROM Works NATURAL JOIN Assignments NATURAL JOIN Courses WHERE courseID=? and studentID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $_GET['c'], $studentID);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            while ($row = $result->fetch_assoc()) {
                $workFileURL = $row['workFileURL'];
                unlink('../../files/work-files/'.$workFileURL);
            }

            // delete enrollment
            $sql = "DELETE FROM Enrolments WHERE courseID=? AND studentID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ii', $_GET['c'], $studentID);
            $stmt->execute();
            $stmt->close();                
        }
    }
?>


<div class="students-container">
    <?php
        $sql = "SELECT studentName, studentID FROM Enrolments NATURAL JOIN Students WHERE courseID=? ORDER BY studentName";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_GET['c']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        if ($result->num_rows == 0) {
            echo "<div class='no-student'>No Students here!</div>";
        } else {
            while ($row = $result->fetch_assoc()) {
                $sql = "SELECT SUM(marks), courseID FROM Marks NATURAL JOIN Works NATURAL JOIN Students NATURAL JOIN Assignments NATURAL JOIN Courses WHERE courseID=? AND studentID=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ii', $_GET['c'], $row['studentID']);
                $stmt->execute();
                $marks = $stmt->get_result()->fetch_assoc()['SUM(marks)'];
                if ($marks == NULL) {
                    $marks = 0;
                }
                $stmt->close();

                echo "<form action='' method='POST'>
                        <div class='students-bar'>
                        <input class='remove-student' name='removeStudent[]' type='checkbox' onclick='validate_checkbox(this)' value='" . $row['studentID'] . "'>
                        <div class='student-name'>".$row['studentName']."</div>
                        <div class='marks'>Marks = " . $marks . "</div>
                    </div>";
            }
            echo "<div class='select-all' onclick='selectAllStudents(this)' >Select All</div>
                <input class='remove-btn' name='remove-student-btn' type='submit' value='Remove Student' disabled>
                </form>
                </div>";
        }
    ?>
</div>


<script>
function validate_checkbox() {
    let checkedCount = 0;
    let checkboxes = document.querySelectorAll('.remove-student');
    checkboxes.forEach(el => {
        if (el.checked == true) {
            checkedCount++;
        }        
    });

    if (checkedCount > 0) {
        document.querySelector('.remove-btn').disabled = false;
    } else {
        document.querySelector('.remove-btn').disabled = true;
    }
}

function selectAllStudents() {
    let checkboxes = document.querySelectorAll('.remove-student');
    checkboxes.forEach(el => {
        el.checked = true;
    });
    validate_checkbox();
}


</script>