<?php
session_start();
include "./admin_Connection.php";

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $pass = base64_encode($_POST['password']);

    $fetch = "SELECT * FROM `admin` WHERE `email`= '$email'";
    $result = mysqli_query($conn, $fetch);
    $nums = mysqli_num_rows($result);
    $rows = mysqli_fetch_assoc($result);

    $password = $rows['passwrd'];
    $matchEmail = $rows['email'];


    if ($pass !== $password) {
        $_SESSION['error'] = 'password does not match';
        header("location:  http://localhost/amit_php/admin/admin_login.php");
    } else {
        if ($email == $matchEmail && $pass == $password) {
            $fetchUserId = "SELECT * FROM `admin` WHERE `email`= '$email'  AND `passwrd` = '" . $password . "'";
            $result = mysqli_query($conn, $fetchUserId);
            $nums = mysqli_num_rows($result);
            if ($nums > 0) {
                $rows = mysqli_fetch_assoc($result);
                $_SESSION['userId'] = $rows['userId'];
                header("location:  http://localhost/amit_php/admin/home.php");
            }
        } else {
            $_SESSION['error'] = 'email and  password  not match';
            header("location:  http://localhost/amit_php/admin/admin_login.php");
        }
    }
}
