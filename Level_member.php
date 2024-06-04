<?php
session_start();
include "./registration/connection.php";

$id = $_SESSION['id'];

// count all level member

function levelMemberFunction($conn, $referral, $a, $level)
{
    $x = "SELECT * FROM `registration` WHERE `joining_referral` = '" . $referral . "'";
    $y = mysqli_query($conn, $x);
    $n = mysqli_num_rows($y);
    if ($n > 0) {
        $level++;
        while ($fetch1 = mysqli_fetch_assoc($y)) {
            $fetch1['level'] = $level;
            $aa = array_push($a, $fetch1);
            $a = levelMemberFunction($conn, $fetch1['referral'], $a, $level);
        }
    }
    return $a;
}


$a = [];
$uuuid = $id; //userid

$qury = "SELECT * FROM `registration` WHERE `user_id` = '" . $uuuid . "'";

$result = mysqli_query($conn, $qury);
$num = mysqli_num_rows($result);
if ($num > 0) {
    while ($fetch = mysqli_fetch_assoc($result)) {
        $level = 1;
        $fetch['level'] = $level;
        $aa = array_push($a, $fetch);
        $a = levelMemberFunction($conn, $fetch['referral'], $a, $level);
    }
}

function compare_level($a1, $b1)
{
    $retval = strnatcmp($a1['level'], $b1['level']);
    return $retval;
}
usort($a, 'compare_level');
$count = count($a);
echo "<h4> Total team $count</h4>";
echo "<br>";
$totalActiveMembers = 0;
$totalInactiveMembers = 0;

foreach ($a as $member) {
    if ($member['active_and_inactive'] == 'active') {
        $totalActiveMembers++;
    } elseif ($member['active_and_inactive'] == 'inactive') {
        $totalInactiveMembers++;
    }
}

echo " active members: " . $totalActiveMembers . "<br>";
echo " inactive members: " . $totalInactiveMembers . "<br>";


$level = isset($_GET['level']) ? $_GET['level'] : 1;  // Default level to 1 if not set

$query = "SELECT * FROM Registration WHERE `user_id` = '$id'";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

$levels = [
    1 => $row['level1'],
    2 => $row['level2'],
    3 => $row['level3'],
    4 => $row['level4'],
    5 => $row['level5']
];

$levelData = isset($levels[$level]) ? $levels[$level] : "";

$userIds = explode(" ", $levelData);

$status_filter = "";
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == "active") {
        $status_filter = " AND `active_and_inactive` = 'active'";
    } elseif ($status == "inactive") {
        $status_filter = " AND `active_and_inactive` = 'inactive'";
    }
}

// Fetch user details for the specified level
$query = "SELECT * FROM registration WHERE user_id IN ('" . implode("','", $userIds) . "')" . $status_filter;
$result = mysqli_query($conn, $query);

// Count active users
$query_active_count = "SELECT COUNT(*) as active_count FROM registration WHERE user_id IN ('" . implode("','", $userIds) . "') AND `active_and_inactive` = 'active'";
$result_active_count = mysqli_query($conn, $query_active_count);
$row_active_count = mysqli_fetch_assoc($result_active_count);
$active_count = $row_active_count['active_count'];

// Count inactive users
$query_inactive_count = "SELECT COUNT(*) as inactive_count FROM registration WHERE user_id IN ('" . implode("','", $userIds) . "') AND `active_and_inactive` = 'inactive'";
$result_inactive_count = mysqli_query($conn, $query_inactive_count);
$row_inactive_count = mysqli_fetch_assoc($result_inactive_count);
$inactive_count = $row_inactive_count['inactive_count'];
$total_count = $active_count + $inactive_count;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Level</th>
                    <th scope="col">Active</th>
                    <th scope="col">Inactive</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($levels as $lvl => $data) {
                    $userIds = explode(" ", $data);
                    
                    // Count active users for this level
                    $query_active_count = "SELECT COUNT(*) as active_count FROM registration WHERE user_id IN ('" . implode("','", $userIds) . "') AND `active_and_inactive` = 'active'";
                    $result_active_count = mysqli_query($conn, $query_active_count);
                    $row_active_count = mysqli_fetch_assoc($result_active_count);
                    $active_count = $row_active_count['active_count'];
                    
                    // Count inactive users for this level
                    $query_inactive_count = "SELECT COUNT(*) as inactive_count FROM registration WHERE user_id IN ('" . implode("','", $userIds) . "') AND `active_and_inactive` = 'inactive'";
                    $result_inactive_count = mysqli_query($conn, $query_inactive_count);
                    $row_inactive_count = mysqli_fetch_assoc($result_inactive_count);
                    $inactive_count = $row_inactive_count['inactive_count'];
                    $total_count = $active_count + $inactive_count;
                ?>
                <tr>
                    <td>Level <?php echo $lvl; ?></td>
                    <td><?php echo $active_count; ?></td>
                    <td><?php echo $inactive_count; ?></td>
                    <td><?php echo $total_count; ?></td>
                </tr>
                <?php } ?>
            </tbody>
            
            
        </table>
    </div>

    
</body>
</html>


