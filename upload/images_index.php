<?php
include('../registration/connection.php');
session_start();
if (isset($_SESSION['alert'])) {
    echo '<div  style="
    color: white;
    background: green;
    position: relative;
    text-align: center;
    top: 23rem;
    padding: 5px;
    border-radius: 5px;
     ">' . $_SESSION['alert'] . '</div>';

    unset($_SESSION['alert']);
} elseif (isset($_SESSION['error'])) {
    echo '<div  style="
    color: #d8e0e4;
    background: red;
    position: relative;
    top: 23rem;
    padding: 5px;
    border-radius: 5px;
    text-align: center;
     ">' . $_SESSION['error'] . '</div>';

    unset($_SESSION['error']);
}

if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
}
$id = $_SESSION['id'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>upload photo</title>

    <style>
        .display {
            display: flex;
            height: 8vh;
            margin: 15px;
            padding: 12px;

        }
    </style>
</head>

<body>
    <div class="display">
        <?php
        $id = $_SESSION['id'];
        $query = "SELECT `image` from Registration where `user_id` = '$id'";

        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        if ($data && !empty($data['image'])) {
            echo "<img src='" . $data['image'] . "' style='width:50px'>";
        } else {
            echo "<img src='../upload/assets/user.png' width='50rem'>";
        }
        ?>
    </div>
    <form action="./upload_image.php" method="post" enctype="multipart/form-data">
        <div class="upload_img">
            <input type="file" name="upload" id="" class="upload">
            <input type="submit" value="Upload " class="btn" name="submit">
            <input type="submit" value="Home" class="btn" name="home">
        </div>
    </form>
    <div>
    </div>
</body>

</html>