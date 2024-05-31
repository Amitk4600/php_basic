<?php
session_start();
include('../registration/connection.php');

if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
}

if (isset($_POST['submit'])) {

    $id = $_SESSION['id'];
    $file = $_FILES['upload']['name'];
    $temp_name = $_FILES['upload']['tmp_name'];
    $file_type = $_FILES['upload']['type'];
    $file_size = $_FILES['upload']['size'];

    // check file size 
    if (($file_size > 1048576) || ($file_size < 204800)) {


        $_SESSION['error'] = "File must be less than 1MB and greater than 200KB.";
        header("location: http://localhost/amit_php/upload/images_index.php");
        exit();
    } elseif (
        ($file_type != 'image/jpg') &&
        ($file_type != 'image/jpeg') &&
        ($file_type != 'image/png') &&
        ($file_type != 'image/gif')
    ) {

        $_SESSION['error'] = "Invalid file type. Only  JPG, GIF and PNG types are accepted.";
        header("location: http://localhost/amit_php/upload/images_index.php");
        exit();
    } else {

        $folder = "img/" . $file;

        if (move_uploaded_file($temp_name, $folder)) {

            $sql  = "UPDATE Registration SET `image` = '$folder' WHERE `user_id` = '$id';";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['alert'] = "Image upload successful.";
                header("location: http://localhost/amit_php/upload/images_index.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Image upload failed.";
            header("location: http://localhost/amit_php/upload/images_index.php");
            exit();
        }
    }
}

if (isset($_POST['home'])) {
    header("location: http://localhost/amit_php/user_home.php");
    exit();
}
