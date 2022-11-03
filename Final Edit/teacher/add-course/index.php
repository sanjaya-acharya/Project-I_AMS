<?php
    session_start();

    require_once('../../connection.php');

    // require_once('../validate-teacher.php');
    // if (!$teachervalid) {
    //     header('Location: ../../logout');
    // }
?>

<form method="post" onsubmit="return validateForm();">
    <div class="form-container">
        <div class="heading">Add New Course</div>

        <div>Course Name</div>
        <input type="text" name="courseName" class="courseName" autocomplete="off" required />

        <div>
            <div>Select one image</div>
            <input type="radio" name="imageID" class="radio-btn rb-50747" value="50747" required checked /><img class="course-image 50747" src="../../files/course-images/BackToSchool.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-99006" value="99006" required /><img class="course-image 99006" src="../../files/course-images/Geometry.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-87043" value="87043" required /><img class="course-image 87043" src="../../files/course-images/Psychology.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-30642" value="30642" required /><img class="course-image 30642" src="../../files/course-images/Math.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-71231" value="71231" required /><img class="course-image 71231" src="../../files/course-images/Chemistry.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-74722" value="74722" required /><img class="course-image 74722" src="../../files/course-images/Physics.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-61175" value="61175" required /><img class="course-image 61175" src="../../files/course-images/Biology.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-98329" value="98329" required /><img class="course-image 98329" src="../../files/course-images/WorldStudies.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-89566" value="89566" required /><img class="course-image 89566" src="../../files/course-images/English.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-65317" value="65317" required /><img class="course-image 65317" src="../../files/course-images/WorldHistory.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-43074" value="43074" required /><img class="course-image 43074" src="../../files/course-images/SocialStudies.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-42202" value="42202" required /><img class="course-image 42202" src="../../files/course-images/Geography.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-81310" value="81310" required /><img class="course-image 81310" src="../../files/course-images/Writing.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-20094" value="20094" required /><img class="course-image 20094" src="../../files/course-images/USHistory.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-54400" value="54400" required /><img class="course-image 54400" src="../../files/course-images/LanguageArts.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-39118" value="39118" required /><img class="course-image 39118" src="../../files/course-images/Honors.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-57306" value="57306" required /><img class="course-image 57306" src="../../files/course-images/Breakfast.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-56545" value="56545" required /><img class="course-image 56545" src="../../files/course-images/Graduation.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-49382" value="49382" required /><img class="course-image 49382" src="../../files/course-images/BookClub.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-60846" value="60846" required /><img class="course-image 60846" src="../../files/course-images/Reachout.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-91193" value="91193" required /><img class="course-image 91193" src="../../files/course-images/LearnLanguage.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-58596" value="58596" required /><img class="course-image 58596" src="../../files/course-images/Read.jpg">
            <input type="radio" name="imageID" class="radio-btn rb-50142" value="50142" required /><img class="course-image 50142" src="../../files/course-images/Code.jpg">
        </div>

        <div class="message"></div>

        <input type="submit" name="create-course" value="Create Course">
    </div>
</form>

<style>
    * {
        box-sizing: border-box;
    }

    .radio-btn {
        display: none;
    }

    .course-image {
        width: 200px;
        height: 100px;
        margin: 20px;
        display: inline-block;
        border: 1px solid black;
    }

    .selected-img {
        border: 3px solid #00f;
        box-shadow: 0 0 10px 10px #aaa;
    }

    .message {
        color: red;
        font-weight: bold;
    }
</style>


<script>



let btns = document.querySelectorAll('.radio-btn');
let imgs = document.querySelectorAll('.course-image');

imgs.forEach(element => {
    element.addEventListener('click', (e) => {
        document.querySelector('.rb-' + e.target.className.split(" ")[1]).checked = true;

        unselectAll();
        e.target.classList.add('selected-img')
    });
});

function unselectAll () {
    imgs.forEach(element => {
        element.classList.remove('selected-img')
        
    });
}

</script>


<?php

if(isset($_POST['create-course'])) {
    $sql = "INSERT INTO Courses (courseName, teacherID, imageID) Values (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $_POST['courseName'], $_SESSION['teacherID'], $_POST['imageID']);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

?>


<script>
    // window.location.href = "../dashboard/?m=course-added";
</script>