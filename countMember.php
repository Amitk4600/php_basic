<?php

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="./Level_member.php">Level member</a><br>
    <a href="./optimization.php">Level member optimize</a>
</body>
</html>