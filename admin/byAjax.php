<?php
session_start();
include '../registration/connection.php';
if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}

if (isset($_SESSION['success'])) {

    echo '<div  style="
    color: green;
    position: absolute;
    top: 1%;
    right: 41%;
    font-size: 19px;
    padding: 5px;
     ">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
} elseif (isset($_SESSION['error'])) {

    echo '<div  style="
    color: red;
    position: absolute;
    top: 1%;
    right: 41%;
    font-size: 19px;
    padding: 5px;
    }
     ">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
$fetch  = "SELECT * FROM `registration`";
$result = mysqli_query($conn, $fetch);
$nums = mysqli_num_rows($result);

if ($nums > 0) {
    echo "<table  class='table table-success table-striped'>
    <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Names</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>status</th>
          </tr>";
    $counter = 1; // for count the entry 
    while ($rows = mysqli_fetch_assoc($result)) {
        $id = $rows['user_id'];
        echo "<tr class='table-info'>
              <td>" . $counter++ . "</td>
            <td>" . ($rows['user_id']) . "</td>
            <td>" . ($rows['names']) . "</td>
            <td>" . ($rows['email']) . "</td>
            <td>" . ($rows['mobile']) . "</td>
           <td> <button type='button' class='btn text-danger' onclick='block(\"".$id."\")'>Active/deactive</button></td>

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
    <title>Document</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: flex-start;

        }

        .filter {
            flex-direction: row;
            gap: 30px;
        }
    </style>
</head>

<body>
   <div id="text"></div>

    <script src="./js/filterMember.js"></script>
</body>

</html>