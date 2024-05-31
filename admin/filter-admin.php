<?php
session_start();
include '../registration/connection.php';

if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}

$fetch = "SELECT * FROM `registration` WHERE `created_by` = 'admin'";
$result = mysqli_query($conn, $fetch);
$nums = mysqli_num_rows($result);

if ($nums > 0) {
    echo "<table  class='table  table-hover table-striped'>
        <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Names</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>created by</th>
              </tr>";
    $counter = 1;
    while ($rows = mysqli_fetch_assoc($result)) {
        echo "<tr class='table-dark'>
         
         
            <td>" . $counter++ . "</td>
            <td>" . ($rows['user_id']) . "</td>
            <td>" . ($rows['names']) . "</td>
            <td>" . ($rows['email']) . "</td>
            <td>" . ($rows['mobile']) . "</td>
            <td>" . ($rows['created_by']) . "</td>
                  </tr>";
    }

    echo "</table>";
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
   
    <title>Document</title>
</head>
<body>
<a href="./home.php"><input class="btn btn-secondary" type="submit" value="Home"></a>
</body>
</html>