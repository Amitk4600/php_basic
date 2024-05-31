<?php

session_start();
include "./registration/connection.php";

if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
}


$id = $_SESSION['id'];

$query = "SELECT * FROM wallet WHERE `to` = '$id' ORDER BY `create_date` DESC";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);

if ($num > 0) {
    echo "<table class='table table-success table-striped'>
            <tr>
                <th scope='col'>id</th>
                <th scope='col'>From</th>
                <th scope='col'>To</th>
                <th scope='col'>Type</th>
                <th scope='col'>Amount</th>
            </tr>";

    $counter = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='table-info'>
                <td class='fw-bold fs-2'>" . $counter++ . "</td>
                <td class='fw-bold fs-2'>" . $row['from'] . "</td>
                <td class='fw-bold fs-2'>" . $row['to'] . "</td>
                <td class='fw-bold fs-2'>" . $row['type'] . "</td>
                <td class='fw-bold fs-2'>" . $row['amount'] . "</td>
                </tr>";
    }
    echo "</table>";
} else {
    echo '<div  style="
    color: #0019ff;
    background: ALICEBLUE;
    position: absolute;
    top: 61px;
    font-size: 22px;
    padding: 5px;
    border-radius: 5px;
    left: 44%;
  
     ">' . "No transactions found." . '</div>';
};

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
        .count {
            font-size: 7rem;
        }
    </style>
</head>

<body>

    <div class="home">
        <a href="./user_home.php"><input class="btn btn-secondary" type="submit" value="Home"></a>
    </div>

</body>

</html>