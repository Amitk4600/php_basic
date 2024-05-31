<?php
session_start();

include "./admin_Connection.php";

if (isset($_SESSION['success'])) {
    echo '<div  style="
    color: green;
    position: relative;
    margin: auto;
    top: 30%;
    width: fit-content;
   font-size: 15px;
    padding: 5px;
    border-radius: 5px;
    z-index: 1;
     ">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}

$id = $_SESSION["userId"];



$fetchName = "SELECT * FROM `admin` WHERE `userId` = '$id'";
$resultName = mysqli_query($conn, $fetchName);
$nums = mysqli_num_rows($resultName);
if ($nums > 0) {
    $rows = mysqli_fetch_assoc($resultName);
    $fname = $rows['firstname'];
    $lname = $rows['lastname'];
    $fullName =  $fname . " " . $lname;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
    <style>
        body {
            background: none;
        }

        .button-sec a {
            width: auto;
            text-decoration: none;
            position: relative;
            top: 15px;
        }

        .input-search p {
            position: absolute;
            top: 3rem;
            /* width: 258px; */
            left: 0;
            color: red;
        }

        .filter {
            flex-direction: row;
            gap: 30px;
        }

        .filter button {
            background: none;
        }
    </style>
</head>

<body>
    <div class="admin-image poetsen-one-regular">
        <div class="display d-flex align-items-center ">
            <?php
            include "./home_process.php";
            ?><div class="name ms-3 py-2">

                <h2>Hi <?php echo "$fullName" ?></h2>
            </div>
        </div>
    </div>
    <form action="./getUserHistory.php" method="post">
        <div class="input-search">
            <input class="form-control w-25" type="search" name="search" id="search-id" placeholder="User id" onkeyup="display(this.value)">
            <p class=" m-1 "><span id="displaytext" class="display "></span></p>
            <input class="form-control w-25" type="text" name="amount" placeholder="amount">
            <select name="select" class="form-control w-25">
                <option value="select">--select--</option>
                <option value="add">add</option>
                <option value="sub">sub</option>
            </select>
            <button class="btn search" type="submit" name="submit">submit</button>
        </div>
    </form>
    <div class="button-sec d-flex">



        <a href="./logout.php"> <input type="button" class="btn btn-secondary logout-button" name="submit" value="Logout"></a>
        <a href="./display_history.php"> <input type="button" class="btn btn-secondary " name="History" value="History" style="width: auto;"></a>
        <a href="./users_details.php"> <input type="button" class="btn btn-secondary ms-1 px-2" name="submit" value="Users Details"></a>
        <a href="./admin_user.php"> <input type="button" class="btn btn-secondary ms-1 px-2" name="submit" value="Users by admin"></a>
        <a href="./filter-users.php"><button class="fs-5 mx-1 px-1 btn btn-danger">By User</button></a>
        <a href="./filter-admin.php"> <button class="fs-5 mx-1 px-1 btn btn-danger">By Admin</button></a>
        <a href="./admin-request.php"> <button class="fs-5 mx-1 px-1 btn btn-dark">Request</button></a>
        <a href="./byAjax.php"> <input type="button" class="btn btn-info " name="submit" value="by Ajax"></a>
    </div>
    <div class="filter d-flex align-items-center justify-content-center px-3 py-1 mt-3">
    <button type="button" class="btn text-info" onclick="filterMember('all')">All members</button>
    <button type="button" class="btn text-dark" onclick="filterMember('active')">Active</button>
    <button type="button" class="btn text-danger" onclick="filterMember('inactive')">Inactive</button>
</div>
<div id="text"></div>
<script src="./js/filterMember.js"></script>


</body>

</html>