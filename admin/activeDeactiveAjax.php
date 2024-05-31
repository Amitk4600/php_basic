<?php
session_start();
include '../registration/connection.php';

if (isset($_GET['q'])) {
    $userId = $_GET['q'];
    $fetchStatusQuery = "SELECT status FROM registration WHERE user_id = '$userId'";
    $fetchStatusResult = mysqli_query($conn, $fetchStatusQuery);
    if ($fetchStatusResult) {
        $row = mysqli_fetch_assoc($fetchStatusResult);
        $currentStatus = $row['status'];
        $newStatus = ($currentStatus == 1) ? 0 : 1;
        $updateStatusQuery = "UPDATE registration SET status = '$newStatus' WHERE user_id = '$userId'";
        $updateStatusResult = mysqli_query($conn, $updateStatusQuery);

        if ($updateStatusResult) {
            if ($newStatus == 1) {
                $_SESSION['success'] = "User has been activated";
            } else {
                $_SESSION['success'] = "User has been deactivated";
            }
        }
    }
}
