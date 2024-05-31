<?php
session_start();
include "../registration/connection.php";



if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];

   $date = date('Y-m-d H:i:s');
   // fetch 
   $fetch  = "SELECT * FROM registration WHERE   `email` = '$email'";
   $res  = mysqli_query($conn, $fetch);
   $num = mysqli_num_rows($res);
   if ($num == 1) {
      $row = mysqli_fetch_assoc($res);

      // block user
      if ($row['status'] == 0) {
         $_SESSION['error'] = 'You are blocked';
         header("location: http://localhost/amit_php/login/index.php");
         exit();
      } else {
         $updateQuery = "UPDATE registration SET `login_id_time` = '$date ' WHERE `email` = '$email'";
        
         mysqli_query($conn, $updateQuery);
      }
      // match password
      $stored_password = $row['pass'];
      $hased_password =  $password;

      if ($hased_password === $stored_password) {
         $_SESSION["id"] = $row['user_id'];
         header("location:  http://localhost/amit_php/user_home.php");
         exit();
      } else {
         $_SESSION['error'] = 'Incorrect password';
         header("location: http://localhost/amit_php/login/index.php");
         exit();
      }
   } else {
      $_SESSION['error'] = 'Incorrect email or password';
      header("location: http://localhost/amit_php/login/index.php");
      exit();
   }
}
