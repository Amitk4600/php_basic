<?php
session_start();
include "./registration/connection.php";

$id = $_SESSION['id'];
$withRecursive = "WITH RECURSIVE registration_tree AS (
SELECT `id`,`names`,`referral`,`joining_referral`,`active_and_inactive` , 0 AS `level`
FROM registration WHERE `user_id` = '$id '
UNION ALL
SELECT r.id,r.names,r.referral,r.joining_referral,r.active_and_inactive,rt.level+1 AS `level`
FROM registration_tree rt
JOIN registration r
ON rt.referral = r.joining_referral
)
SELECT 
`level`,
SUM(CASE WHEN `active_and_inactive` = 'active' THEN 1  ELSE 0 END) AS `active`,
SUM(CASE WHEN `active_and_inactive` = 'inactive' THEN 1  ELSE 0 END) AS `inactive`,
COUNT(*) AS `total`,
(SELECT SUM(CASE WHEN `active_and_inactive` = 'active' THEN 1 ELSE 0 END) FROM registration_tree) AS `total_active`,
(SELECT SUM(CASE WHEN `active_and_inactive` = 'active' THEN 1 ELSE 0 END) FROM registration_tree) AS `total_inactive`
FROM registration_tree
GROUP BY `level`
ORDER BY `level`;
";

$recrusiveResult=mysqli_query($conn,$withRecursive);

echo "<table class='table table-striped'>";
echo "  <tr>";

echo "    <th scope='col'>level</th>";
echo "    <th scope='col'>active</th>";
echo "    <th scope='col'>inactive</th>";
echo "    <th scope='col'>total</th>";
echo "  </tr>";
$totalActive = 0;
$totalInactive = 0;
$count  =0;
while ($rows = mysqli_fetch_assoc($recrusiveResult)) {
    echo "  <tr>";
    echo "    <td>" . $rows['level'] . "</td>";
    echo "    <td>" . $rows['active'] . "</td>";
    echo "    <td>" . $rows['inactive'] . "</td>";
    echo "    <td>" . $rows['total'] . "</td>";
    echo "  </tr>";
    $totalActive += $rows['active'];
    $totalInactive += $rows['inactive'];
}

$totalTeam = $totalActive + $totalInactive;

echo "</table>";
echo "total team: $totalTeam<br>";
echo "total Active: $totalActive<br>";
echo "total Inactive: $totalInactive<br>";


//************************************************************************************** */

// function fetch_user_with_referrals($conn, $user_id, $level = 0, &$referral_count)
// {
//     $fetch = "SELECT * FROM registration WHERE `user_id` = '$user_id' ";
//     $result = mysqli_query($conn, $fetch);
//     $nums = mysqli_num_rows($result);
//     $user_data = [];
//     // Fetch user details

//     if ($nums) {
//         while ($row = mysqli_fetch_assoc($result)) {
//             // Add level to the user's data
//             $row['level'] = $level;
//             $user_data[] = $row;

//             // Fetch referrals of this user
//             $referral = $row['referral'];
//             $fetch_referrals = "SELECT * FROM registration WHERE `joining_referral` = '$referral'";
//             $result_referrals = mysqli_query($conn, $fetch_referrals);

//             if ($result_referrals) {
//                 while ($referral_row = mysqli_fetch_assoc($result_referrals)) {
//                     $referral_count++;
//                     $referral_data = fetch_user_with_referrals($conn, $referral_row['user_id'], $level + 1, $referral_count);
//                     $user_data = array_merge($user_data, $referral_data);
//                 }
//             }
//         }
//     }
//     return $user_data;
// }

// // Initialize referral count
// $referral_count = 0;

// // Fetch user data and referrals
// $user_hierarchy = fetch_user_with_referrals($conn, $id, 0, $referral_count);

// // Output the collected data
// echo "Total Referrals: $referral_count";
// // echo "<table class='table table-success table-striped'>
// // <tr>
// // <th scope='col'>table id</th>
// // <th scope='col'>user_id</th>
// // <th scope='col'>name</th>
// // <th scope='col'>email</th>
// // <th scope='col'>mobile</th>
// // <th scope='col'>active/inactive</th>
// // </tr>";

// // foreach ($user_hierarchy as $user) {
// //     echo "<tr class='table-info'> 
// //     <td class='fw-bold fs-2'>" . $user['id'] . "</td>                        
// //     <td class='fw-bold fs-2'>" . $user['user_id'] . "</td>                        
// //     <td class='fw-bold fs-2'>" . $user['names'] . "</td>
// //     <td class='fw-bold fs-2'>" . $user['email'] . "</td>
// //     <td class='fw-bold fs-2'>" . $user['mobile'] . "</td>
// //     <td class='fw-bold fs-2'>" . $user['active_and_inactive'] . "</td>
// //     </tr>";
// // }
// // echo "</table>";


// $levelCounts = [];

// function countMembersByLevel($member)
// {
//     global $levelCounts;
//     $level = $member['level'];
//     if (!isset($levelCounts[$level])) {
//         $levelCounts[$level] = [
//             'active' => 0,
//             'inactive' => 0,
//             'total' => 0,
//         ];
//     }

//     if ($member['active_and_inactive'] === 'active') {
//         $levelCounts[$level]['active']++;
//     } else {
//         $levelCounts[$level]['inactive']++;
//     }
//     $levelCounts[$level]['total']++;
// }

// array_walk($user_hierarchy, 'countMembersByLevel');

// echo "<h4> Team Members by Level</h4>";
// echo "<table class='table table-striped'>";
// echo "  <tr>";
// echo "    <th scope='col'>Level</th>";
// echo "    <th scope='col'>Active</th>";
// echo "    <th scope='col'>Inactive</th>";
// echo "    <th scope='col'>Total</th>";
// echo "  </tr>";

// foreach ($levelCounts as $level => $counts) {
//     echo "  <tr>";
//     echo "    <td>" . $level . "</td>";
//     echo "    <td>" . $counts['active'] . "</td>";
//     echo "    <td>" . $counts['inactive'] . "</td>";
//     echo "    <td>" . $counts['total'] . "</td>";
//     echo "  </tr>";
// }
// echo "</table>";
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

</body>

</html>