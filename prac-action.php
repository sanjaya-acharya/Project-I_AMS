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