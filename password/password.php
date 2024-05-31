<?php
session_start();
include "../registration/connection.php";

if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
 }
 
if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];
    $curr_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_new_password'];

    // fetch data

    $fetch = "SELECT * FROM registration WHERE id = $id";
    $result  = mysqli_query($conn, $fetch);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $rows = mysqli_fetch_assoc($result);
        $stored_password = $rows['pass'];
        $hased_password = hash('sha256', $curr_password);
        if ($stored_password !== $hased_password) {

            $_SESSION['error'] = "password does not  same, please input same password !";

            header("location: http://localhost/amit_php/password/password_index.php");
            exit();
        }
        if (preg_match('/\s/', $new_password)) {
            $_SESSION['error'] = "password has whitespace!";

            header("location: http://localhost/amit_php/password/password_index.php");
            exit();
        } 
        elseif (strlen($new_password) < 8 || !preg_match("/[0-9]/", $new_password) || !preg_match("/[A-Z]/", $new_password) || !preg_match("/[a-z]/", $new_password)) { 

            $_SESSION['error'] = "Your password must be at least 8 characters long and contain at least one number, one uppercase letter, and one lowercase letter."; 

            header("location: http://localhost/amit_php/password/password_index.php");
            exit();
        }

        if ($new_password !== $confirm_password) {
            $_SESSION['error'] = "Passwords do not match.";
       
            header("location: http://localhost/amit_php/password/password_index.php");
            exit();
        } else {
            $hashed_new_password = hash('sha256', $new_password); 
            $update  = "UPDATE Registration SET pass = '$hashed_new_password' WHERE id = $id";
            $result = mysqli_query($conn, $update);

            if ($result) {
                $_SESSION['update'] =
                    "Password Update successful.";
                header("location: http://localhost/amit_php/password/password_index.php");
                exit();
            }
        }
    }
}

if(isset($_POST['home'])){
    header("location: http://localhost/amit_php/user_home.php");
                exit();
}
