<?php
session_start();
include "./registration/connection.php";

$id = $_SESSION['id'];

$query = "SELECT * FROM Registration WHERE `user_id` = '$id'";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

$level1 = $row['level1'];
$level2 = $row['level2'];
$level3 = $row['level3'];
$level4 = $row['level4'];
$level5 = $row['level5'];

$levelAll = $level1 . ' ' . $level2 . ' ' . $level3 . ' ' . $level4 . ' ' . $level5;
$data = str_replace(" ", "','", $levelAll);
$ddata = str_replace(",''", "", $data);

$status_filter = "";
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == "active") {
        $status_filter = " AND `active_and_inactive` = 'active'";
    } elseif ($status == "inactive") {
        $status_filter = " AND `active_and_inactive` = 'inactive'";
    }
}

$sql = "SELECT * FROM `registration` WHERE `user_id` IN ('$ddata') $status_filter ORDER BY `id` ASC";
if ($num > 0) {
    $result = mysqli_query($conn, $sql);

    $active_count_query = "SELECT COUNT(*) as active_count FROM `registration` WHERE `user_id` IN ('$ddata') AND `active_and_inactive` = 'active'";
    $inactive_count_query = "SELECT COUNT(*) as inactive_count FROM `registration` WHERE `user_id` IN ('$ddata') AND `active_and_inactive` = 'inactive'";

    $active_result = mysqli_query($conn, $active_count_query);
    $inactive_result = mysqli_query($conn, $inactive_count_query);

    $active_count = mysqli_fetch_assoc($active_result)['active_count'];
    $inactive_count = mysqli_fetch_assoc($inactive_result)['inactive_count'];

    if ($result) {
        $nums = mysqli_num_rows($result);
      
        if ($nums > 0) {
            echo "<table class='table table-success table-striped'>
                <tr>
                <th scope='col'>ID</th>
                <th scope='col'>User ID</th>
                <th scope='col'>Name</th>
                <th scope='col'>Email</th>
                <th scope='col'>Mobile</th>
                <th scope='col'>Type</th>
                <th scope='col'>Active/Inactive</th>
                </tr>";
            $cont = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $level = '';
                if (strpos($level1, $row['user_id']) !== false) {
                    $level = '1';
                } elseif (strpos($level2, $row['user_id']) !== false) {
                    $level = '2';
                } elseif (strpos($level3, $row['user_id']) !== false) {
                    $level = '3';
                } elseif (strpos($level4, $row['user_id']) !== false) {
                    $level = '4';
                } elseif (strpos($level5, $row['user_id']) !== false) {
                    $level = '5';
                }

                echo "<tr class='table-info'> 
                <td class='fw-bold fs-2'>" . $cont++ . "</td>
                    <td class='fw-bold fs-2'>" . $row['user_id'] . "</td>                        
                    <td class='fw-bold fs-2'>" . $row['names'] . "</td>
                    <td class='fw-bold fs-2'>" . $row['email'] . "</td>
                    <td class='fw-bold fs-2'>" . $row['mobile'] . "</td>
                    <td class='fw-bold fs-2'>" . 'Level :' . $level . "</td>
                    <td class='fw-bold fs-2'>" . $row['active_and_inactive'] . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo '<div style="
                color: #0019ff;
                background: ALICEBLUE;
                position: absolute;
                top: 61px;
                font-size: 22px;
                padding: 5px;
                border-radius: 5px;
                left: 44%;
            ">' . "No member found." . '</div>';
        }
    } else {
        echo '<div style="
            color: #0019ff;
            background: ALICEBLUE;
            position: absolute;
            top: 61px;
            font-size: 22px;
            padding: 5px;
            border-radius: 5px;
            left: 44%;
        ">' . "No member found." . '</div>';
    }
}
?>
