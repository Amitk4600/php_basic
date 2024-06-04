<?php
session_start();
include "./registration/connection.php";

$id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
}
// count all level member

function levelMemberFunction($conn, $referral, $a, $level)
{
    $x = "SELECT * FROM `registration` WHERE `joining_referral` = '" . $referral . "' ";
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
    
        $level = 0;
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
echo "<table class='table table-striped'>";
echo "  <tr>";
echo "    <th scope='col'></th>";
echo "    <th scope='col'>ID</th>";
echo "    <th scope='col'>Name</th>";
echo "    <th scope='col'>Active_Inactive Member</th>";
echo "    <th scope='col'>Levels</th>";
echo "  </tr>";
$count = 1;
foreach ($a as $member) {
    echo "  <tr>";
    echo "    <td>" . $count++ . "</td>";
    echo "    <td>" . $member['user_id'] . "</td>";
    echo "    <td>" . $member['names'] . "</td>";

    // Add status based on active_and_inactive value
    if ($member['active_and_inactive'] === 'active') {
        $totalActiveMembers++;
        echo "    <td style='background: green; color:white; width: 80px; text-align:center'>Active</td>"; 
    } else {
        $totalInactiveMembers++;
        echo "    <td style='background: red; color:white; width: 80px; text-align:center'>Inactive</td>";
    }
    echo "    <td style='text-align:center;width: 80px;'>" . $member['level'] . "</td>";
    echo "  </tr>";
}
echo "</table>";

// (Optional) Print summary of active and inactive members
echo "<p>Total Active Members: $totalActiveMembers</p>";
echo "<p>Total Inactive Members: $totalInactiveMembers</p>";

$levelCounts = [];

function countMembersByLevel($member) {
    global $levelCounts;
    $level = $member['level'];
    if (!isset($levelCounts[$level])) {
        $levelCounts[$level] = [
            'active' => 0,
            'inactive' => 0,
            'total' => 0,
        ];
    }

    if ($member['active_and_inactive'] === 'active') {
        $levelCounts[$level]['active']++;
    } else {
        $levelCounts[$level]['inactive']++;
    }
    $levelCounts[$level]['total']++;
}

// Count members by level
array_walk($a, 'countMembersByLevel');

// Display level-wise data
echo "<h4> Team Members by Level</h4>";
echo "<table class='table table-striped'>";
echo "  <tr>";
echo "    <th scope='col'>Level</th>";
echo "    <th scope='col'>Active</th>";
echo "    <th scope='col'>Inactive</th>";
echo "    <th scope='col'>Total</th>";
echo "  </tr>";

// Loop through level counts and display data
foreach ($levelCounts as $level => $counts) {
    echo "  <tr>";
    echo "    <td>" . $level . "</td>";
    echo "    <td>" . $counts['active'] . "</td>";
    echo "    <td>" . $counts['inactive'] . "</td>";
    echo "    <td>" . $counts['total'] . "</td>";
    echo "  </tr>";
}

echo "</table>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <title>Document</title>
</head>

<body>
     
</body>

</html>