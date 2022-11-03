<link rel="stylesheet" href="../../imports/css/view-students.css">
<script src="../../imports/js/view-students.js" defer></script>

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
            echo "<div class='all-students'>
                    <div class='remove-students' onclick='removeAllStudents'>Remove all students</div>
                </div>";
            while ($row = $result->fetch_assoc())
            {
                echo "<div class='students-bar'>
                        <div class='student-name'>".$row['studentName']."</div>
                        <div class='go-left'>
                                <div name='".$row['studentID']."' class='remove-student' onclick='removeStudent'>Remove</div>
                            </div>
                        </div>
                    </div>";
            } 
        }			

    ?>

</div>