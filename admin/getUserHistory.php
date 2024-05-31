<?php
session_start();
include '../registration/connection.php';
if (!isset($_SESSION['userId'])) {
  header("location: http://localhost/amit_php/admin/admin_login.php");
}

if (isset($_GET['q'])) {
  $searchId = $_GET['q'];

  $query = "SELECT `names` FROM registration WHERE user_id = '$searchId'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      echo $row['names'];
  } else {
      echo "No user found";
  }
}

if (isset($_POST['submit'])) {
  $searchId = $_POST['search'];
  $amount = $_POST['amount'];
  $select = $_POST['select'];



  $fetch  = "SELECT * FROM `registration` WHERE `user_id` = '$searchId'";
  $result = mysqli_query($conn, $fetch);
  $nums = mysqli_num_rows($result);

  if ($nums > 0) {
    $rows = mysqli_fetch_assoc($result);
    $amt = $rows['total_amt'];

    switch ($select) {
      case 'add':
        $totalAmountAdd = $amt +  $amount;
        amountAdd($conn, $searchId, $totalAmountAdd, $amount);
        $_SESSION['success'] = $amount . " deposited to " . $searchId;
        header("location:  http://localhost/amit_php/admin/home.php");
        break;
      case 'sub':
        $totalAmountSub = $amt -  $amount;
        amountSub($conn, $searchId, $totalAmountSub, $amount);
        $_SESSION['success'] = $amount . " deducted " . $searchId;
        header("location:  http://localhost/amit_php/admin/home.php");
        break;
    }
  }
}

function AmountAdd($conn, $searchId, $totalAmountAdd, $amount)
{
  //update into register table
  $update  = "UPDATE registration SET `total_amt` = '$totalAmountAdd' WHERE `user_id` = '$searchId' ";
  mysqli_query($conn, $update);

  // wallet table 
  $insertWallet = "INSERT INTO wallet (`user_id`, `from`, `to`, `type`, `time`, `amount`, `create_date`, `update_date`) VALUES ('" . $searchId . "','Admin', '" . $searchId . "', 'amount deposited by admin', NOW() , ' $amount', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
  mysqli_query($conn, $insertWallet);
}
function AmountSub($conn, $searchId, $totalAmountSub, $amount)
{
  $update  = "UPDATE registration SET `total_amt` = '$totalAmountSub' WHERE `user_id` = '$searchId' ";
  mysqli_query($conn, $update);


  $insertWallet = "INSERT INTO wallet (`user_id`, `from`, `to`, `type`, `time`, `amount`, `create_date`, `update_date`) VALUES ('" . $searchId . "','Admin', '" . $searchId . "', 'amount deducted by admin', NOW() , ' $amount', CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())";
  mysqli_query($conn, $insertWallet);
}
