<?php
session_start();
include '../registration/connection.php';
if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}

$fetchDetails  = "SELECT REGISTRATION.id,REGISTRATION.user_id,REGISTRATION.names,REGISTRATION.email,REGISTRATION.mobile,REGISTRATION.total_amt,WALLET.id, WALLET.user_id,WALLET.from, WALLET.to, WALLET.type, WALLET.amount 
FROM REGISTRATION 
INNER JOIN WALLET
ON REGISTRATION.user_id=WALLET.user_id
ORDER BY WALLET.id DESC;";
$result  = mysqli_query($conn, $fetchDetails);
$nums = mysqli_num_rows($result);
if ($nums > 0) {
    echo "<table '1' class='table table-success table-striped'>
    <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Names</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Total Amount</th>
            <th>From</th>
            <th>To</th>
            <th>Type</th>
            <th>Amount</th>
          </tr>";
$counter = 1;
    while ($rows = mysqli_fetch_assoc($result)) {
        echo "<tr class='table-info'>
     
     
        <td>" . $counter++ . "</td>
        <td>" . ($rows['user_id']) . "</td>
        <td>" . ($rows['names']) . "</td>
        <td>" . ($rows['email']) . "</td>
        <td>" . ($rows['mobile']) . "</td>
        <td>" . ($rows['total_amt']) . "</td>
        <td>" . ($rows['from']) . "</td>
        <td>" . ($rows['to']) . "</td>
        <td >" . ($rows['type']) . "</td>
        <td>" . ($rows['amount']) . "</td>
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

    <style>
        body {
            display: flex;
            flex-direction: column-reverse;
            gap: 20px;
            align-items: flex-end;
            justify-content: center;
        }
    </style>
</head>

<body>
    <a href="./home.php"><input class="btn btn-secondary" type="submit" value="Home"></a>
</body>

</html>