<?php
session_start();
include_once "./admin_Connection.php";


if (isset($_POST['submit'])) {

    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = trim($_POST['email']);
    $mobile = $_POST['mobile'];
    $pass = $_POST['password'];

    $date = date('Y-m-d H:i:s');

    $fetch = "SELECT * FROM `admin` WHERE `email`= '$email' OR `mobile`='$mobile'";
  
    $result = mysqli_query($conn, $fetch);
    $num = mysqli_num_rows($result);


    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['email'] == $email) {
            $_SESSION['error'] = 'email already';
        } elseif ($row['mobile'] == $mobile) {
            $_SESSION['error'] = 'mobile already';
            header("location:  http://localhost/amit_php/admin/admin_register.php");
        }
    }

    if (preg_match('/\s/', $pass)) {
        $_SESSION['error'] = "Password contains whitespace!";
        header("location:  http://localhost/amit_php/admin/admin_register.php");
    }
    if (strlen($pass) < 8) {
        $_SESSION['error'] = "Password must be at least 8 characters long!";
        header("location:  http://localhost/amit_php/admin/admin_register.php");
    }
    // image upload

    $file = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    if (($file_size > 1048576) || ($file_size < 204800)) {
        $_SESSION['error'] = "File must be less than 1MB and greater than 200KB.";
        header("location: http://localhost/amit_php/admin/admin_register.php");
    } elseif (
        ($file_type != 'image/jpg') &&
        ($file_type != 'image/jpeg') &&
        ($file_type != 'image/png') &&
        ($file_type != 'image/gif')
    ) {
        $_SESSION['error'] = "Invalid file type. Only  JPG, GIF and PNG types are accepted.";
        header("location:  http://localhost/amit_php/admin/admin_register.php");
    } else {
        $folder = "image/" . $file;
        (move_uploaded_file($temp_name, $folder));
        $date = date('Y-m-d H:i:s');

        $sponsorUserId = random_int(10000, 99999);

        $insertQuery = "INSERT INTO `admin`(userId, firstname,lastname, email, mobile, passwrd, img, reg_date) VALUES('" . $sponsorUserId . "','" . $fname . "','" . $lname . "','" . $email . "','" . $mobile . "','" .  base64_encode($pass) . "','" . $file . "','" . $date . "');";
        $insertResult = mysqli_query($conn, $insertQuery);
        $_SESSION['success'] = "Registration successful";
        header("location:  http://localhost/amit_php/admin/admin_register.php");
    }
}
