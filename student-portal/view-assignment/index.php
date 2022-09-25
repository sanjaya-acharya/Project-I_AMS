<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Assignment</title>
</head>
<body>
    <div class="container">
        <?php
            // track assignment url into a variable
            $assignment
        ?>
        <iframe src="https://picsum.photos/536/354" frameborder="0"></iframe>
        <form action="index.php" method="post">
            <input type="file" name="assignmentFile" id="assignmentFile" required />
            <input type="submit" value="Submit Assignment">
        </form>
    </div>

</body>

<a href="../../profile-icon.png" download="Sample File">Download</a>
<link rel="stylesheet" href="view-assignment.css">
</html>