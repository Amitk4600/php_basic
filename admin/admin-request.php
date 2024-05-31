<?php

include '../registration/connection.php';
include_once "./getUserHistory.php";
if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}
$fetch = "SELECT * FROM requests WHERE `status` = 'pending'";
$result = mysqli_query($conn, $fetch);
$nums = mysqli_num_rows($result);
if ($nums > 0) {
    echo "<table  class='table  table-hover table-striped'>
        <tr>
                <th>ID</th>
                <th>User_ID</th>
                <th>ask amount</th>
                <th>Aprrove</th>
                <th>Reject</th>
      </tr>";
    $counter = 1;
    while ($rows = mysqli_fetch_assoc($result)) {
        echo "<tr class='table-dark'>
            <td>" . $counter++ . "</td>
            <td>" . $rows['user_ID'] . "</td>
            <td>" . $rows['ask_amt'] . "</td>
            <td>
                <form action='./admin-request-process.php' method='post' style='display: inline;'>
                    <input type='hidden' name='action' value='approve'>
                    <input type='hidden' name='user_ID' value='" . $rows['user_ID'] . "'>
                    <input type='hidden' name='amount' value='" . $rows['ask_amt'] . "'>
                    <input type='hidden' name='request_id' value='" . $rows['id'] . "'>
                    <button class='btn btn-secondary approve-reject' type='submit'>Approve</button>
                </form>
            </td>
            <td>
                <form action='./admin-request-process.php' method='post' onsubmit='return confirm(\"Are you sure you want to reject this request?\");' style='display: inline;'>
                    <input type='hidden' name='action' value='reject'>
                    <input type='hidden' name='request_id' value='" . $rows['id'] . "'>
                    <button class='btn btn-danger approve-reject' type='submit'>Reject</button>
                </form>
            </td>
        </tr>";
    }


    echo "</table>";
} else {
    echo '<div class="error-message">no request </div>';
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
    <style>
        form {
            width: 400px;
            margin: auto;
            position: relative;
            top: 80px;
        }

        .input-search {
            gap: 10px;
        }

        .approve-reject {
            position: relative;
            bottom: 80px;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin: auto;
            position: relative;
            top: 1%;
            left: 44%;
        }
    </style>

</head>

<body>
    <a href="./home.php"><input class="btn btn-secondary" type="submit" value="Home"></a>
    <button class="btn" onclick="displayPending('all')">Pending <span style="color: red;"><?php echo $nums ?></span></button>
    
    
    <div id="text"></div>
    <script src="./js/filterMember.js"></script>
</body>

</html>