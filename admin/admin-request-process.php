<?php
// session_start();
// include '../registration/connection.php';
// if (!isset($_SESSION['userId'])) {
//     header("location: http://localhost/amit_php/admin/admin_login.php");
// }
// if (isset($_POST['submit'])) {
//     $id = $_POST['user_ID'];
//     $amount = $_POST['amount'];


//     $fetch  = "SELECT * FROM `registration` WHERE `user_id` = '$id'";
//     $result = mysqli_query($conn, $fetch);
//     $nums = mysqli_num_rows($result);

//     if ($nums > 0) {
//         $rows = mysqli_fetch_assoc($result);
//         $amt = $rows['total_amt'];
//         $totalAmountAdd = $amt +  $amount;
//         amountAdd($conn, $id, $totalAmountAdd, $amount);
//         $_SESSION['success'] = $amount . " deposited to " . $id;
//         header("location:  http://localhost/amit_php/admin/home.php");
//     }
// }
// if (isset($_GET['action']) && $_GET['action'] == 'reject') {
//     $userId = $_GET['user_ID'];

//     rejectRequest($conn, $userId);

// }

// function AmountAdd($conn, $id, $totalAmountAdd, $amount)
// {
//     $update  = "UPDATE request SET `status` = 'Approve' WHERE `user_id` = '$id' ";
//     mysqli_query($conn, $update);

//     //update into register table
//     $update  = "UPDATE registration SET `total_amt` = '$totalAmountAdd' WHERE `user_id` = '$id' ";
//     mysqli_query($conn, $update);

//     // wallet table 
//     $insertWallet = "INSERT INTO wallet (`user_id`, `from`, `to`, `type`, `time`, `amount`, `create_date`, `update_date`) VALUES ('" . $id . "','Admin', '" . $id . "', 'amount deposited by admin', NOW() , ' $amount', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
//     mysqli_query($conn, $insertWallet);
//     header("location:  http://localhost/amit_php/admin/home.php");
// }

// function rejectRequest($conn, $userId)
// {
//     $update = "UPDATE request SET `status` = 'Reject' WHERE `user_id` = '$userId' ";
//     mysqli_query($conn, $update);
//     $_SESSION['success'] = "Request rejected.";
//     header("location: http://localhost/amit_php/admin/home.php");
// }




// if (isset($_POST['submit'])) {
//     $id = $_POST['user_ID'];
//     $amount = $_POST['amount'];

//     $fetch = "SELECT * FROM `registration` WHERE `user_id` = '$id'";
//     $result = mysqli_query($conn, $fetch);

//     if ($result) {
//         $nums = mysqli_num_rows($result);
//         if ($nums > 0) {
//             $rows = mysqli_fetch_assoc($result);
//             $amt = $rows['total_amt'];
//             $totalAmountAdd = $amt +  $amount;
//             amountAdd($conn, $id, $totalAmountAdd, $amount);
//             $_SESSION['success'] = $amount . " deposited to " . $id;
//             header("location: http://localhost/amit_php/admin/home.php");
//             exit();
//         } else {
//             $_SESSION['error'] = "User not found.";
//             header("location: http://localhost/amit_php/admin/home.php");
//             exit();
//         }
//     } else {
//         $_SESSION['error'] = "Error: " . mysqli_error($conn);
//         header("location: http://localhost/amit_php/admin/home.php");
//         exit();
//     }
// }

// if (isset($_GET['action']) && $_GET['action'] == 'reject' && isset($_GET['user_ID'])) {
//     $userId = $_GET['user_ID'];

//     $update = "UPDATE request SET `status` = 'Reject' WHERE `user_id` = '$userId' ";
//     $result = mysqli_query($conn, $update);

//     if ($result) {
//         $_SESSION['success'] = "Request rejected.";
//         header("location: http://localhost/amit_php/admin/home.php");
//         exit();
//     } else {
//         $_SESSION['error'] = "Error: " . mysqli_error($conn);
//         header("location: http://localhost/amit_php/admin/home.php");
//         exit();
//     }
// }

// function amountAdd($conn, $id, $totalAmountAdd, $amount)
// {
//     $update = "UPDATE request SET `status` = 'Approve' WHERE `user_id` = '$id'";
//     mysqli_query($conn, $update);

//     $update = "UPDATE registration SET `total_amt` = '$totalAmountAdd' WHERE `user_id` = '$id'";
//     mysqli_query($conn, $update);

//     $insertWallet = "INSERT INTO wallet (`user_id`, `from`, `to`, `type`, `time`, `amount`, `create_date`, `update_date`) VALUES ('$id', 'Admin', '$id', 'amount deposited by admin', NOW(), '$amount', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
//     mysqli_query($conn, $insertWallet);
// }

// // admin-request-process.php

// session_start();
// include '../registration/connection.php';
// if (!isset($_SESSION['userId'])) {
//     header("location: http://localhost/amit_php/admin/admin_login.php");
// }

// if (isset($_POST['submit'])) {
//     $id = $_POST['user_ID'];
//     $amount = $_POST['amount'];
//     $requestId = $_POST['request_id'];

//     $fetch = "SELECT * FROM `registration` WHERE `user_id` = '$id'";
//     $result = mysqli_query($conn, $fetch);
//     $nums = mysqli_num_rows($result);

//     if ($nums > 0) {
//         $rows = mysqli_fetch_assoc($result);
//         $amt = $rows['total_amt'];
//         $totalAmountAdd = $amt + $amount;
//         amountAdd($conn, $id, $totalAmountAdd, $amount, $requestId);
//         $_SESSION['success'] = $amount . " deposited to " . $id;
//         header("location: http://localhost/amit_php/admin/home.php");
//     }
// }

// if (isset($_GET['action']) && $_GET['action'] == 'reject') {
//     $requestId = $_GET['request_id'];
//     rejectRequest($conn, $requestId);
//     $_SESSION['success'] = "Request rejected.";
//     header("location: http://localhost/amit_php/admin/home.php");
// }

// function amountAdd($conn, $id, $totalAmountAdd, $amount, $requestId)
// {
//     $update = "UPDATE request SET `status` = 'Approve' WHERE `id` = '$requestId'";
//     mysqli_query($conn, $update);

//     // Update registration table
//     $update = "UPDATE registration SET `total_amt` = '$totalAmountAdd' WHERE `user_id` = '$id'";
//     mysqli_query($conn, $update);

//     // Insert into wallet table
//     $insertWallet = "INSERT INTO wallet (`user_id`, `from`, `to`, `type`, `time`, `amount`, `create_date`, `update_date`) 
//                      VALUES ('$id', 'Admin', '$id', 'amount deposited by admin', NOW(), '$amount', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
//     mysqli_query($conn, $insertWallet);
// }

// function rejectRequest($conn, $requestId)
// {
//     $update = "UPDATE request SET `status` = 'Rejected' WHERE `id` = '$requestId'";
//     mysqli_query($conn, $update);
// }
session_start();
include '../registration/connection.php';
if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'approve') {
        $id = $_POST['user_ID'];
        $amount = $_POST['amount'];
        $requestId = $_POST['request_id'];

        $fetch = "SELECT * FROM `registration` WHERE `user_id` = '$id'";
        $result = mysqli_query($conn, $fetch);
        $nums = mysqli_num_rows($result);

        if ($nums > 0) {
            $rows = mysqli_fetch_assoc($result);
            $amt = $rows['total_amt'];
            $totalAmountAdd = $amt + $amount;
            amountAdd($conn, $id, $totalAmountAdd, $amount, $requestId);
            $_SESSION['success'] = $amount . " deposited to " . $id;
            header("location: http://localhost/amit_php/admin/home.php");
            exit;
        }
    } elseif ($_POST['action'] == 'reject') {
        $requestId = $_POST['request_id'];
        rejectRequest($conn, $requestId);
        $_SESSION['success'] = "Request rejected.";
        header("location: http://localhost/amit_php/admin/home.php");
        exit;
    }
}

function amountAdd($conn, $id, $totalAmountAdd, $amount, $requestId)
{
    $date = date('Y-m-d H:i:s');

    $update = "UPDATE requests SET `status` = 'Approve' WHERE `id` = '$requestId'";
    mysqli_query($conn, $update);

    // active 
    $fetchStatus = "SELECT * FROM requests WHERE `status` = 'Approve' AND `id` = '$requestId'";
    $results = mysqli_query($conn, $fetchStatus);
    $nums  = mysqli_num_rows($results);
    if ($nums > 0) {
        $update = "UPDATE registration 
        SET `active_id_time` = '$date', `active_and_inactive` = 'active' 
        WHERE `user_id` = '$id'";
        mysqli_query($conn, $update);
    }

    // Update registration table
    $update = "UPDATE registration SET `total_amt` = '$totalAmountAdd' WHERE `user_id` = '$id'";
    mysqli_query($conn, $update);

    // Insert into wallet table
    $insertWallet = "INSERT INTO wallet (`user_id`, `from`, `to`, `type`, `time`, `amount`, `create_date`, `update_date`) 
                     VALUES ('$id', 'Admin', '$id', 'amount deposited by admin', NOW(), '$amount', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
    mysqli_query($conn, $insertWallet);
}

function rejectRequest($conn, $requestId)
{
    $date = date('Y-m-d H:i:s');

    $update = "UPDATE requests SET `status` = 'Rejected' WHERE `id` = '$requestId'";
    mysqli_query($conn, $update);

    $fetchStatus = "SELECT * FROM requests WHERE `status` = 'Rejected' AND `id` = '$requestId'";
    $results = mysqli_query($conn, $fetchStatus);
    $nums  = mysqli_num_rows($results);
    $row = mysqli_fetch_assoc($results);
    $id = $row['user_ID'];
    if ($nums > 0) {
        $update = "UPDATE registration 
        SET `inactive_id_time` = '$date'
        WHERE `user_id` = '$id'";
        mysqli_query($conn, $update);
    }
}
