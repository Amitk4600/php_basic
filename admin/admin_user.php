<?php
session_start();
include '../registration/connection.php';

if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}
if (isset($_SESSION['registration_alert'])) {
    echo '<div  style="
  color: #0019ff;
      position: absolute;
    top: 52px;
    padding: 5px;
    left: 35%;
      ">' . $_SESSION['registration_alert'] . '</div>';
    unset($_SESSION['registration_alert']);
} elseif (isset($_SESSION['error'])) {
    echo '<div  style="
    color: rgb(49 61 210);
    position: absolute;
    top: 52px;
    padding: 5px;
    left: 41%;
   ">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['referral_Code'])) {
    echo '<div  style="
  color: #ffffff;
  background: #19a219;
  position: absolute;
  width: fit-content;
  top: 71%;
  padding: 5px;
  border-radius: 5px;
  font-size: 18px;
  left: 62%;
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./css/admin_user.css">
</head>

<body>
    <div class="registration p-4">
        <div class="registration-form d-flex p-3">
            <form action="./admin_user_process.php" method="post" class=" p-3">
                <h2>Registration form of users by admin</h2>
                <input type="text" name="name" class="form-control px-1 mt-1 " id="" placeholder="Enter your name " required />
                <input type="email" name="email" class="form-control px-1 mt-1" id="" placeholder="Email" required />
                <input type="tel" name="mobile" class="form-control px-1 mt-1" id="" maxlength="10" size="10" placeholder="mobile" required />
                <input type="password" name="password" class="form-control px-1 mt-1" id="password" placeholder="Password" required />
                <input type="password" name="confirm_password" class="form-control px-1 mt-1" id="confirm_password" placeholder="Confirm password" required />
                <input type="date" name="dob" class="form-control px-1 mt-1" id="" placeholder="DOB" required />
                <input type="text" name="referral" class="form-control px-1 mt-1" id="referral" placeholder="referral (optional)" maxlength="6" />
                <input type="submit" value="submit" name="submit" class="btn btn-danger" />
            </form>
        </div>
    </div>
</body>


</html>