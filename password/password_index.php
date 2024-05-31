<?php
session_start();

include "../displayPassword/displayPassword.php";

if (!isset($_SESSION['id'])) {
  header("location: http://localhost/amit_php/login/index.php");
  exit();
}

if (isset($_SESSION['error'])) {
  echo '<div  style="
  color: #000c12;
  background: red;
  position: absolute;
  left: 17.5rem;
  padding: 5px;
  border-radius: 5px;
       ">' . $_SESSION['error'] . '</div>';

  unset($_SESSION['error']);
} elseif (isset($_SESSION['update'])) {
  echo '<div  style="
  background-color: #2f8d46;
      width: 15rem;
     text-align: center;
      padding: 5px;
    border-radius: 5px;
   ">' . $_SESSION['update'] . '</div>';

  unset($_SESSION['update']);
};

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Sevillana&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <title>Change Password</title>

  <style>
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
  <h1>Change Password</h1>
  <div class="container">

    <div class="img">
      <div class="img-section"></div>
    </div>
    <div class="container-body">
      <form class="form" action="password.php" method="post">
        <label class="label-name" for="Current password">Current password</label>
        <input type="password" name="current_password" id="cPassword" placeholder="Current password" class="input-field" />
        <span><img src="./assets/eye.svg" class="eye" id="eyeIcon" onclick="togglePasswordVisibility('cPassword')"></span>

        <label class="label-name" for="New password">New password</label>
        <input type="password" name="new_password" id="new_password" placeholder="New password" class="input-field" />
        <span><img src="./assets/eye.svg"  class="eye" onclick="togglePasswordVisibility('new_password')"></span>

        <label class="label-name" for="Confirm new password">Confirm new password</label>
        <input type="password" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm new password" class="input-field" />
        <span><img src="./assets/eye.svg"  class="eye" onclick="togglePasswordVisibility('confirm_new_password')"></span>

        <div class="bottom">
          <button type="submit" name="submit">Submit</button>
          <input type="submit" value="Home" name="home">

        </div>

      </form>
    </div>
  </div>

</body>

</html>