<?php
session_start();
include "./registration/connection.php";

if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
}

$id = $_SESSION['id'];

$query = "SELECT * from Registration where `user_id` ='$id'";
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
        echo "<div class='count'>Total: $nums, Active: $active_count, Inactive: $inactive_count</div>";
        if ($nums > 0) {
            echo "<table class='table table-success table-striped'>
                <tr>
                <th scope='col'>id</th>
                <th scope='col'>user_id</th>
                <th scope='col'>name</th>
                <th scope='col'>email</th>
                <th scope='col'>mobile</th>
                <th scope='col'>Type</th>
                <th scope='col'>active/inactive</th>
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
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .button {
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: space-around;
        }
    </style>
</head>

<body>
    <div class="button">
        <div class="home">
            <a href="./user_home.php"><input class="btn btn-secondary" type="submit" value="Home"></a>
        </div>
        <a href="./display_level.php?level=1"><button class="btn btn-danger">Level 1 Data</button></a>
        <a href="./display_level.php?level=2"><button class="btn btn-danger">Level 2 Data</button></a>
        <a href="./display_level.php?level=3"><button class="btn btn-danger">Level 3 Data</button></a>
        <a href="./display_level.php?level=4"><button class="btn btn-danger">Level 4 Data</button></a>
        <a href="./display_level.php?level=5"><button class="btn btn-danger">Level 5 Data</button></a>
        <a href="?status=active"><button class="btn btn-success">Active Users</button></a>
        <a href="?status=inactive"><button class="btn btn-warning">Inactive Users</button></a>
    </div>
</body>

</html>