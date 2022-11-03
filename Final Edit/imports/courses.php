<link rel="stylesheet" href="../../imports/css/courses.css">
<script src="../../imports/js/courses.js" defer></script>

<div class="courses-container">
    <?php
        $sql = "SELECT courseID, courseName, imageURL FROM courses NATURAL JOIN courseImages WHERE teacherID=? ORDER BY courseName";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $_SESSION['teacherID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows == 0) {
            echo "<div class='no-course'>No Courses!<br /><a clas='only-for-teachers' href='./add-course/'>Create New</a></div>";
        } else {
            while ($row = $result->fetch_assoc()) {
                echo "<a class='course-box' href='../view-course?c=".$row['courseID']."'>
                        <img src='../../files/course-images/".$row['imageURL']."'>
                        <div class='course-name-label'>".$row['courseName']."</div>
                    </a>";
            }
        }
    ?>
</div>

<style>

.course-container {
    width: 10vw;
}
</style>
