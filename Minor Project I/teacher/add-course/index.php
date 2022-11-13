<script>
    // window.location.href = "../dashboard/?m=course-added";
    if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}
</script>

<?php
    // error_reporting(0);
    session_start();
    
    require_once('../../connection.php');

    require_once('../../imports/navbar.php');

    require_once('../../validate-teacher.php');
    if (!$teacherValid) {
        header('Location: ../../logout');
    }

    if(isset($_POST['create-course'])) {
        $sql = "INSERT INTO Courses (courseName, teacherID, imageID) Values (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $imageIDS =  array(50747,  99006,  87043,  30642,  71231,  74722,  61175,  98329,  89566,  65317,  43074,  42202,  81310,  20094,  54400,  39118,  57306,  56545,  49382,  60846,  91193,  58596,  50142);
        $imageID = $imageIDS[rand(1,23)];

        $stmt->bind_param('sii', $_POST['courseName'], $_SESSION['teacherID'], $imageID);
        if ($stmt->execute()) {
            header("Location: ../dashboard/?msg=New Course Added");
            exit();
        } else {
            echo "Couldn't add the course";
        }

        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="../../imports/css/form.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <div class="heading">Add New Course</div>

            <div class="Label">Course Name</div>
            <input class="input-field" type="text" name="courseName" class="courseName" autocomplete="off" required />

            <!-- <div class="Label">Select Image</div>
            <div class="image-container">
                <input type="radio" name="imageID" class="radio-btn rb-50747" value="" required /><img class="course-image 50747" src="../../files/course-images/BackToSchool.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-99006" value="" required /><img class="course-image 99006" src="../../files/course-images/Geometry.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-87043" value="" required /><img class="course-image 87043" src="../../files/course-images/Psychology.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-30642" value="" required /><img class="course-image 30642" src="../../files/course-images/Math.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-71231" value="" required /><img class="course-image 71231" src="../../files/course-images/Chemistry.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-74722" value="" required /><img class="course-image 74722" src="../../files/course-images/Physics.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-61175" value="" required /><img class="course-image 61175" src="../../files/course-images/Biology.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-98329" value="" required /><img class="course-image 98329" src="../../files/course-images/WorldStudies.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-89566" value="" required /><img class="course-image 89566" src="../../files/course-images/English.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-65317" value="" required /><img class="course-image 65317" src="../../files/course-images/WorldHistory.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-43074" value="" required /><img class="course-image 43074" src="../../files/course-images/SocialStudies.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-42202" value="" required /><img class="course-image 42202" src="../../files/course-images/Geography.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-81310" value="" required /><img class="course-image 81310" src="../../files/course-images/Writing.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-20094" value="" required /><img class="course-image 20094" src="../../files/course-images/USHistory.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-54400" value="" required /><img class="course-image 54400" src="../../files/course-images/LanguageArts.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-39118" value="" required /><img class="course-image 39118" src="../../files/course-images/Honors.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-57306" value="" required /><img class="course-image 57306" src="../../files/course-images/Breakfast.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-56545" value="" required /><img class="course-image 56545" src="../../files/course-images/Graduation.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-49382" value="" required /><img class="course-image 49382" src="../../files/course-images/BookClub.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-60846" value="" required /><img class="course-image 60846" src="../../files/course-images/Reachout.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-91193" value="" required /><img class="course-image 91193" src="../../files/course-images/LearnLanguage.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-58596" value="" required /><img class="course-image 58596" src="../../files/course-images/Read.jpg">
                <input type="radio" name="imageID" class="radio-btn rb-50142" value="" required /><img class="course-image 50142" src="../../files/course-images/Code.jpg">
            </div> -->

            <div class="message"></div>

            <input class="submit" type="submit" name="create-course" value="Create Course">
        </form>
    </div>
</body>

<script>
    let btns = document.querySelectorAll('.radio-btn');
    let imgs = document.querySelectorAll('.course-image');

    btns[0].checked = true;
    imgs[0].classList.add('selected-img');

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

</html>