<link rel="stylesheet" href="../../imports/css/courses.css">
<script src="../../imports/js/courses.js" defer></script>

<div class="courses-container">
    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'teacher') {
        $sql = "SELECT courseID, courseName, imageURL FROM courses NATURAL JOIN courseImages WHERE teacherID=? ORDER BY courseName";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_SESSION['teacherID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows == 0) {
            echo "<div class='no-course'><span style='display: block; margin-bottom: 20px;'>No Courses!</span><a class='only-for-teachers' href='../add-course/'>Create New</a><a class='only-for-students' href='../join-course/'>Join New Course</a></div>";
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "
                    <div class='course-box'>
                        <a class='linker-box' href='../view-course?c=" . $row['courseID'] . "'>
                            <img src='../../files/course-images/" . $row['imageURL'] . "'>
                            <div class='course-name-label'>" . $row['courseName'] . "</div>
                        </a>
                    </div>
                ";
            }
        }
    }

    if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') {
        $sql = "SELECT courseID, courseName, imageURL FROM courses NATURAL JOIN courseImages NATURAL JOIN Enrolments WHERE studentID=? ORDER BY courseName";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_SESSION['studentID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows == 0) {
            echo "<div class='no-course'><span style='display: block; margin-bottom: 20px;'>No Courses!</span><a class='only-for-teachers' href='../add-course/'>Create New</a><a class='only-for-students' href='../join-course/'>Join New Course</a></div>";
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "
                    <div class='course-box'>
                        <a class='linker-box' href='../view-course?c=" . $row['courseID'] . "'>
                            <img src='../../files/course-images/" . $row['imageURL'] . "'>
                            <div class='course-name-label'>" . $row['courseName'] . "</div>
                        </a>
                    </div>
                ";
            }
        }
    }

    ?>
</div>