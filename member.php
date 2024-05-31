<?php
session_start();
include './registration/connection.php';

if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
}

$id = $_SESSION['id'];

$query = "SELECT referral from Registration where `user_id` ='$id' ";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if ($num > 0) {
    $referral = $row['referral'];
    echo "<h3>Referral code :</h3>" . "<b>$referral</b>";

    $referral = $row['referral'];

    $query = "SELECT * from Registration where `joining_referral` = '$referral'";
    $result = mysqli_query($conn, $query);
    $total_member = mysqli_num_rows($result);
    if ($total_member > 0) {
        echo "
   <div class='count'>$total_member</div>";
        echo "<h3>Joining member</h3>";
        echo " <table class='table table-success table-striped' >
                <tr>
                <th scope=\"col\">id</th>
                <th scope=\"col\">name</th>
                </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "   <tr class='table-info'>
            <td><a href='other_member.php?id=" . $row['id'] . "'>" . $row['id'] . "</a></td>
            <td class='fw-bold fs-2'>" . $row['names'] . "</td>
           </tr>";
        }

        echo   "</table>";
    }
}else {
    echo '<div  style="
    color: #0019ff;
    background: ALICEBLUE;
    position: absolute;
    top: 61px;
    font-size: 22px;
    padding: 5px;
    border-radius: 5px;
    left: 44%;
  
     ">' ."No record." .'</div>';
}
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
        body {
            margin: auto;
            width: 63vw;
            padding: 12px;
        }

        .count {
            border: 1px solid black;
            width: 10rem;
            height: 3rem;
            margin: 20px;
            padding: 5px;
            border-radius: 18px;
            position: relative;
            left: 82%;
            font-size: 26px;
            font-weight: 700;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
        }

        table td a {
            color: red;
            text-align: center;
            font-size: x-large;
            line-height: 2.9rem;
            margin-left: 10px;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="home">
        <a href="./user_home.php"><input class="btn btn-secondary" type="submit" value="Home"></a>
    </div>
</body>

</html>

