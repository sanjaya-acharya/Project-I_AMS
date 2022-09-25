<?php
    if (isset($_GET['assignmentID'])) {
        $assignmentID = $_GET['assignmentID'];
        # select assignment using ID and preview questions
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Assignment</title>
</head>
<body>
    <?php
        # if assignment is already completed
        # get assignment file name and download option, option to delete the assignment
        # else
    ?>
    <form action="#" method="post">
        <input type="file" name="assignmentFile">
        <input type="submit" value="Upload">
    </form>
</body>
</html>