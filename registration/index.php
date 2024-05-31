<?php
session_start();

include "../displayPassword/displayPassword.php";


if (isset($_SESSION['registration_alert'])) {
  echo '<div  style="
  color: #0019ff;
  position: absolute;
    bottom: 43%;
    padding: 5px;
    border-radius: 5px;
    font-size: 18px;
    left: 38%;
    background: transparent;
   ">' . $_SESSION['registration_alert'] . '</div>';
  unset($_SESSION['registration_alert']);
} elseif (isset($_SESSION['error'])) {
  echo '<div  style="
  color: rgb(49 61 210);
  background-color: #959583;
  position: absolute;
    bottom: 43%;
    padding: 5px;
    border-radius: 5px;
    font-size: 18px;
    left: 38%;
    background: transparent;
       ">' . $_SESSION['error'] . '</div>';
  unset($_SESSION['error']);
}
if (isset($_SESSION['referral_Code'])) {
  echo '<div  style="
  color: #ffffff;
  background: #19a219;
  position: relative;
  top: 42%;
  padding: 5px;
  border-radius: 5px;
  font-size: 31px;
  left: 38%;

   ">' . $_SESSION['referral_Code'] . '</div>';
  unset($_SESSION['referral_Code']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css">

  <style>
    .pass-eye {


      position: relative;
      bottom: 3rem;
      right: 36px;
    }

    .eye {
      display: flex;
      position: relative;
      top: -2.8rem;
      left: 10rem;
      cursor: pointer;
      justify-content: center;
      align-items: center;
    }
  </style>

</head>

<body>

  <form action="registration.php" method="post">
    <h2>Registration form</h2>

    <label for="">Name</label>
    <input type="text" name="name" id="" placeholder="Enter your name " required />
    <label for="">Email</label>
    <input type="email" name="email" id="" placeholder="Email" required />
    <label for="">Mobile</label>
    <input type="tel" name="mobile" id="" maxlength="10" size="10" placeholder="mobile" required />
    <label for="">Password</label>
    <input type="password" name="password" id="password" placeholder="Password" required />
    <label for="">Confirm <span>password</span> </label>
    <div class="pass-eye">
      <span><img src="../login/assets/eye.svg" id="eyeicon" class="eye" onclick="togglePasswordVisibility('password')"></span>
    </div>

    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required />
    <div class="pass-eye">
      <span class="" style="margin-top: 1.6rem;"><img src="../login/assets/eye.svg" id="eyeicon" class="eye" onclick="togglePasswordVisibility('confirm_password')"></span>
    </div>

    <label for="">DOB</label>
    <input type="date" name="dob" id="" placeholder="DOB" required />

    <label for="">referral</label>
    <input type="text" name="referral" id="referral" placeholder="referral (optional)" maxlength="6" />
    <input type="submit" value="submit" name="submit" class="btn" />
  </form>
  <a href="http://localhost/amit_php/login/index.php"><input type="submit" value="Log in" style="  position: absolute;
    top: 5%;
    right: 0;
    background-color: #2aa3e0;
    color: cornsilk;" name="submit" class=" btn login" /></a>



  <script>

  </script>
</body>


</html>