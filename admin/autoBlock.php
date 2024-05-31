<?php
session_start();
include '../registration/connection.php';
if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}
$fetch = "SELECT * FROM registration WHERE `total_amt` = 0 ";
$result = mysqli_query($conn, $fetch);
$nums = mysqli_num_rows($result);
$current = date('Y-m-d H:i:s');

if ($nums > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        $id = $rows['user_id'];
        $fetchTime = $rows['register_date'];
        $time = date('Y-m-d H:i:s', strtotime($fetchTime . ' +24 hours '));
        if (strtotime($current) >= strtotime($time)) {
            $updateQuery = "UPDATE registration SET `status` = 0 ";
            mysqli_query($conn, $updateQuery);
            $_SESSION['error'] = 'You are auto blocked';
            header("location: http://localhost/amit_php/login/index.php");
            exit();
        }
    }
}
