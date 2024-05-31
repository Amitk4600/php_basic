<?php
session_start();
include '../registration/connection.php';
if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}
$fetch = "";
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 'all') {
        $fetch = "SELECT * FROM `registration`";
    } elseif ($status == 'active') {
        $fetch = "SELECT * FROM `registration` WHERE `active_and_inactive` = 'active'";
    } elseif ($status == 'inactive') {
        $fetch = "SELECT * FROM `registration` WHERE `active_and_inactive` = 'inactive'";
    }
}

if ($fetch != "") {
    $result = mysqli_query($conn, $fetch);
    $nums = mysqli_num_rows($result);
    if ($nums > 0) {
        echo "<table class='table table-success table-striped'>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Names</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Active/Inactive</th>
                    <th>Action</th>
                </tr>";
        $counter = 1;
        while ($rows = mysqli_fetch_assoc($result)) {
            echo "<tr class='table-info'>
                    <td>" . $counter++ . "</td>
                    <td>" . $rows['user_id'] . "</td>
                    <td>" . $rows['names'] . "</td>
                    <td>" . $rows['email'] . "</td>
                    <td>" . $rows['mobile'] . "</td>
                    <td>" . $rows['active_and_inactive'] . "</td>
                    <td><button class='view-referrals-btn' data-user-id='" . $rows['user_id'] . "'>View Referrals</button></td>
                 </tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }
} else {
    echo "Invalid status.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="referralContainer"></div>

</body>
</html>