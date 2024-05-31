<?php

include "./admin_Connection.php";
if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}
$id = $_SESSION["userId"];
$fetchImg = "SELECT * FROM `admin` WHERE `userId` = '$id'";
$resultImg = mysqli_query($conn, $fetchImg);
$nums = mysqli_num_rows($resultImg);
if ($nums > 0) {
    $rows = mysqli_fetch_assoc($resultImg);
    $img = $rows['img'];

    if (!empty($img)) {
        echo "<img src= 'image/" . $img . "' style='width:100px ;border-radius:50%'>";
    }
}
