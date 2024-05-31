<?php
session_start();
include "./registration/connection.php";

if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
}
if (isset($_SESSION['registration_alert'])) {
    echo '<div  style="
    color: red;
    position: absolute;
    bottom: 24%;
    padding: 5px;
    border-radius: 5px;
    font-size: 18px;
    left: 38%;
    background: transparent;
     ">' . $_SESSION['registration_alert'] . '</div>';
    unset($_SESSION['registration_alert']);
}
// image display
echo "<div class='display'>";
$id = $_SESSION["id"];
$query = "SELECT * from Registration where `user_id` = '$id' ";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if ($data['status'] == 0) {
    $_SESSION['error'] = 'You are blocked due to some illegal activity.';
    header("location: http://localhost/amit_php/login/index.php");
}
if ($data && !empty($data['image'])) {
    echo "<img src='./upload/" . $data['image'] . "' style='width:50px'>";
} else {
    echo "<img src='./upload/assets/user.png' width='50rem'>";
}
echo "</div>";
include "./login/fetchdata.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Document</title>
    <style>
        button {
            border: none;
            font-size: 19px;
            font-weight: 800;
            color: #b21c1c;
        }

        .change_and_member {
            display: flex;
            align-items: center;
            position: relative;
            top: 1rem;
            justify-content: space-around;
        }
    </style>
</head>

<body>

    <div class="btn">
        <a href="http://localhost/amit_php/password/password_index.php"><button type="button" class="btn btn-outline-primary">Change Password</button></a>
        <a href="./logout.php"><button type="button" class="btn btn-outline-primary">Log Out</button></a>
    </div>
    <div class="change_and_member ">
        <a href="../amit_php/upload/images_index.php"><button type="button" class="btn btn-outline-primary">Change photo</button></a>
        <a href="./member.php"><button type="button" class="btn btn-outline-primary" name="member">member</button></a>
        <a href="./wallet.php"><button type="button" class="btn btn-outline-success" name="member">History</button></a>
        <a href="./send_request.php"><button type="button" class="btn btn-outline-dark" name="member">Request</button></a>
        <a href="./total_member.php"><button type="button" class="btn btn-outline-danger" name="total_member">Total Member</button></a>

    </div>
</body>

</html>