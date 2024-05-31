<?php
session_start();
include '../registration/connection.php';


$user_id = $_GET['user_id'];
$status = $_GET['status'];
$updateQuery = "UPDATE registration SET `status` = '$status' WHERE `user_id` = '$user_id'";
mysqli_query($conn, $updateQuery);
if ($status == 1) {
    $_SESSION['success'] = "user has been Active";
} else {
    $_SESSION['error'] = "user has been Deactive";
}
header("location: http://localhost/amit_php/admin/users_details.php");
