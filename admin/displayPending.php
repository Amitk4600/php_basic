<?php
session_start();
include '../registration/connection.php';
if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}
if (isset($_GET['pendingId'])) {
    $fetch = "SELECT * FROM  requests WHERE `status` = 'pending'";
    $result = mysqli_query($conn, $fetch);
    $nums = mysqli_num_rows($result);
    if ($nums > 0) {
        echo "<table  class='table table-dark table-striped'>
        <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Request amount</th>
                    <th>status</th>
             
              </tr>";
        $counter = 1; // for count the entry 
        while ($rows = mysqli_fetch_assoc($result)) {
            echo "<tr class='table-dark'>
                  <td>" . $counter++ . "</td>
                <td>" . ($rows['user_ID']) . "</td>
                <td>" . ($rows['ask_amt']) . "</td>
                <td>" . ($rows['status']) . "</td>
                 </tr>";
        }
        echo "</table>";
    } else {
        echo '<div class="error-message">Record not found.</div>';
    }
}
