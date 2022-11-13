<?php
    session_start();

    require_once('../../connection.php');

    // error_reporting(0);

    require_once('../../validate-teacher.php');
    if (!$teacherValid || !$courseValid) {
        header('Location: ../../logout');
        exit();
    }

    if (!isset($_GET['c'])) {
        header('Location: ../dashboard/?msg=Select a course');
        exit();
    }

    if(isset($_POST['edit-course'])) {
        $sql = "UPDATE Courses SET courseName=? WHERE courseID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $_POST['courseName'], $_GET['c']);

        if ($stmt->execute()) {
            header("Location: ../dashboard");
            exit();
        } else {
            echo "Couldn't edit the course";
        }
        $stmt->close();
        $conn->close();
    }

    require_once('../../imports/navbar.php');

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
            <div class="heading">Edit Course</div>

            <div class="Label">New Course Name</div>
            <input class="input-field" type="text" name="courseName" class="courseName" autocomplete="off" required />

            <div class="message"></div>

            <input class="submit" type="submit" name="edit-course" value="Edit Course">
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
