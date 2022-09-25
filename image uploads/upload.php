<?php
require_once '../connection.php';

if (isset($_POST["submit"]) && isset($_FILES["my_image"])) {
    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "</pre>";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 125000) {
            $em = "File too large!";
            header("Location: index.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = "uploads/".$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Now inserting into database
                $sql = "INSERT INTO courseImages VALUES ('IMG005', '$new_img_name')";
                mysqli_query($conn, $sql);
                header("Location: view.php");
            } else {
                $em = "File not supported";
                header("Location: index.php?error=$em");
            }
        }
    }
} else {
    $em = "Unknown error occured!";
    header("Location: index.php?error=$em");
}
?>