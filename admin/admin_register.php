<?php
session_start();
if (isset($_SESSION['error'])) {
    echo '<div  style="
    
    position: relative;
    top: 19%;
    color: red;
    z-index: 1;
    left: 61%;
    width: fit-content;
    padding: 5px;
    border-radius: 5px;
      width: fit-content;
    font-size: 11px;
    text-align: center;
         ">' . $_SESSION['error'] . '</div>';

    unset($_SESSION['error']);
} elseif (isset($_SESSION['success'])) {
    echo '<div  style="
    color: green;
     position: absolute;
       width: fit-content;
    top: 15%;
    right: 20%;
    font-size: 12px;
    padding: 5px;
    border-radius: 5px;
    z-index: 1;
     ">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./css/style.css">
    <title>admin</title>
</head>

<body>
    <div class="text">
        <h1>Admin Registration</h1>
    </div>
    <div class="admin">
        <div class="admin-register">
            <div class="col">
                <div class="row">
                    <form action="./admin_register_process.php" method="post" enctype="multipart/form-data" class="xyz">
                        <h1>Registration</h1>
                        <input class="form-control" type="text" name="firstName" id="firstName" placeholder="First Name" required>
                        <input class="form-control" type="text" name="lastName" id="lastName" placeholder="Last Name" required>
                        <input class="form-control" type="email" name="email" id="email" placeholder="email" required>
                        <input class="form-control" type="tel" name="mobile" id="mobile" placeholder="Phone number" maxlength="10" required>
                        <input class="form-control" type="password" name="password" id="password" placeholder="password">
                        <input type="file" name="image" id="image">
                        <div class="button d-flex ">
                            <input type="submit" class="btn btn-danger fs-5 rounded-pill px-5 py-3" name="submit" value="Register">
                        </div>
                    </form>
                    <a href="./admin_login.php"><input type="submit" class="btn btn-danger btn-login fs-5 rounded-pill px-5 py-3" value="Login" style="position: relative;
    left: 57%;
    bottom: 4.25rem;"></a>
                </div>
            </div>
        </div>
    </div>


</body>

</html>