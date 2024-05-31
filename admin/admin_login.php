<?php
session_start();
if (isset($_SESSION['error'])) {
    echo '<div  style="
    position: relative;
    top: 33%;
    color: red;
    z-index: 1;
    left: 54%;
    width: fit-content;
    padding: 5px;
    border-radius: 5px;
    font-size: 13px;
    text-align: center;
         ">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
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
    <style>
        .login {
            width: 495px;
            padding: 28px 19px 15px 50px;
            border-radius: 14% 0% 13% 17% / 51% 25% 0% 49%;
            background: #f8f8f8;
            position: relative;
            border: 1px solid black;
            top: 8.5rem;
            height: auto;
            left: 35%;
        }

        p {
            color: grey;
            font-size: 1rem;
            line-height: 1.9rem;
            font-weight: 300;
            position: relative;
            left: 45%;
            top: 15px;
        }

        p a {
            font-weight: 500;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="admin login">
        <div class="admin-register ">
            <div class="col">
                <div class="row">
                    <form action="./admin_login_process.php" method="post" class="xyz">
                        <h1>Login</h1>
                        <input class="form-control" type="email" name="email" id="email" placeholder="email" required>
                        <input class="form-control" type="password" name="password" id="password" placeholder="password" minlength="4" maxlength="10">
                        <input type="submit" name="submit" class="btn btn-danger fs-5 rounded-pill px-5 py-3" value="Login">
                    </form>
                    <p class="px-3 mx-3 my-2 " style="  position: absolute; top: 16rem;">Don't have an account? <a href="./admin_register.php">Signup</a></p>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>