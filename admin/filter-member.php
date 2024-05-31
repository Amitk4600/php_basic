<?php

session_start();
include '../registration/connection.php';


if (isset($_GET['q'])) {
    $fetch  = "SELECT * FROM `registration`"; 
} elseif (isset($_GET['block'])) {
    $fetch  = "SELECT * FROM `registration` WHERE `status` = 0";
} elseif (isset($_GET['unblock'])) {
    $fetch  = "SELECT * FROM `registration` WHERE `status` = 1";
}
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
         
          </tr>";
    $counter = 1; // for count the entry 
    while ($rows = mysqli_fetch_assoc($result)) {
        echo "<tr class='table-info'>
              <td>" . $counter++ . "</td>
            <td>" . ($rows['user_id']) . "</td>
            <td>" . ($rows['names']) . "</td>
            <td>" . ($rows['email']) . "</td>
            <td>" . ($rows['mobile']) . "</td>
             </tr>";
    }
    echo "</table>";
}
