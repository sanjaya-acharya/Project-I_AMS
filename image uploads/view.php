<?=
require_once('../connection.php');
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
    <a href="index.php">&#8592;</a>
    <?php
        $sql = "Select * from courseimages";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            while ($images = mysqli_fetch_assoc($res)) {
                ?>
                <div class="alb">
                    <img src="uploads/<?= $images['image'] ?>" alt="Image" class="courseImage">
                </div>
                <?php
            }
        }
    ?>
<style>
    body {
        display:flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        min-height: 100vh;
    }
    .courseImage {
        width: 100px;
        height: 100px;
    }
</style>

</body>
</html>
