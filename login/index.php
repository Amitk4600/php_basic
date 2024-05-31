<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>login</title>

  <style>
    .pass-eye {
      display: flex;
      position: absolute;
      top: 12.2rem;
      right: 2%;
      cursor: pointer;
    }
  </style>
</head>

<body>



  <div class="login_page">
    <div class="top">
      <h1>Login</h1>

      <p>Please fill the details to Login</p>
    </div>
    <form action="login.php" method="post">
      <input type="email" name="email" id="" placeholder="Enter your Email" required />
      <input type="password" name="password" id="password" placeholder="Password" class="input-field" required />
      <div class="pass-eye">
        <span><img src="./assets/eye.svg" id="eyeicon" class="eye" onclick="togglePasswordVisibility('password')"></span>

         <!-- eye  -->
   <?php
   include "../displayPassword/displayPassword.php"
 
    ?> 
      </div>

      <?php

      session_start();
      if (isset($_SESSION['error'])) {
        echo '<div style="color:red">' . $_SESSION['error'] . '</div>';

        unset($_SESSION['error']);
      }


      ?>
      <span style="width: 134px;left: 78%;">Forgot Password?</span>
      <input type="submit" name="submit" value="Login" class="btn" />

    </form>
    <div class="bottom">
      <p>You don't have an account yet?</p>
      <a href="http://localhost/amit_php/registration/index.php">Sign Up</a>
    </div>
  </div>

 
</body>

</html>