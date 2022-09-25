<?php
	require_once "./connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="" enctype="multipart/form-data">
        <label>Title</label>
        <input type="text" name="title">
        <label>File Upload</label>
        <input type="file" name="file">
        <input type="submit" value="Upload">
    </form>
</body>
</html>

<?php
if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];

    $tname = $_FILES["files"]["tmp_name"];

    $uploads_dir = './images';

    move_uploaded_file($tname, $uploads_dir.'/'.$pname);

    $sql = "Insert into courseImage Values('$title','$pname')";

    if (mysqli_query($conn, $sql)) {
        echo "File Uploaded";
    }
    else {
        echo "File not uploaded";
    }
}
?>