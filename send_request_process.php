<?php
session_start();
include "./registration/connection.php";

if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
}

$id = $_SESSION["id"];

if (isset($_POST['submit'])) {
    $amount = $_POST['amt'];
    $text = $_POST['textarea'];
    
    $insert = "INSERT INTO requests(`user_ID`,`reqst`,`ask_amt`)VALUES('" . $id . "','" . $text . "','" . $amount . "')";
      $result = mysqli_query($conn, $insert);
      $_SESSION['registration_alert'] = "Request sent successful.";
        header("location:http://localhost/amit_php/user_home.php");
        exit();
}
