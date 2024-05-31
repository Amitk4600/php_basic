<?php
session_start();
include '../registration/connection.php';
if (!isset($_SESSION['userId'])) {
    header("location: http://localhost/amit_php/admin/admin_login.php");
}
// function getUser($conn, $user_id)
// {
//     $query = "SELECT * FROM `registration` WHERE `user_id` = '$user_id'";
//     print_r($query);
//     die;
//     $result = mysqli_query($conn, $query);
//     $row = mysqli_fetch_assoc($result);

//     $level1 = $row['level1'];
//     $level2 = $row['level2'];
//     $level3 = $row['level3'];
//     $level4 = $row['level4'];
//     $level5 = $row['level5'];
//     $levelAll = $level1 . ' ' . $level2 . ' ' . $level3 . ' ' . $level4 . ' ' . $level5;

//     $data = str_replace(" ", "','", $levelAll);
//     $ddata = str_replace(",''", "", $data);

//     $sql = "SELECT * FROM  `registration` WHERE `user_id` IN ('$ddata') ORDER BY `id` ASC";
//     $result = mysqli_query($conn, $sql);
//     $nums = mysqli_num_rows($result);
//     echo "<div > <h2>total member: $nums</h2></div>";
//     if (isset($_GET['levels'])) {
//         $level = $_GET['levels'];
//         $levelData = "";
//         if ($level == 'level1') {
//             $levelData = $level1;
//         } elseif ($level == 'level2') {
//             $levelData = $level2;
//         } elseif ($level == 'level3') {
//             $levelData = $level3;
//         } elseif ($level == 'level4') {
//             $levelData = $level4;
//         } elseif ($level == 'level5') {
//             $levelData = $level5;
//         }

//         $userIds = explode(" ", $levelData);
//         $query = "SELECT * FROM registration WHERE user_id IN ('" . implode("','", $userIds) . "')";
//         $result = mysqli_query($conn, $query);
//         $num_levels = mysqli_num_rows($result);

//         if ($num_levels > 0) {

//             echo "<table class='table table-success table-striped'>
//          <tr>
//             <th scope='col'>id</th>
//             <th scope='col'>name</th>
//             <th scope='col'>email</th>
//             <th scope='col'>mobile</th>
//             <th scope='col'>wallet</th>
//           </tr>";

//             while ($row_levels = mysqli_fetch_assoc($result)) {
//                 echo "<tr class='table-info'>
//             <td>" . $row_levels['id'] . "</td>
//             <td>" . $row_levels['names'] . "</td>
//             <td>" . $row_levels['email'] . "</td>
//             <td>" . $row_levels['mobile'] . "</td>
//             <td>" . $row_levels['total_amt'] . "</td>
        
//          </tr>";
//             }
//             echo "</table>";
//         }
//     }

//     if (isset($_GET['view_referrals']) && isset($_GET['user_id'])) {
//         $user_id = $_GET['user_id'];
//         print_r($user_id);
//         $referralUsers = getUser($conn, $user_id); 


//         if (!empty($referralUsers)) { 
//             echo "<h3>Users who joined with referral code of User ID: $user_id</h3>";

//             echo "<ul>";
//             foreach ($referralUsers as $referralUser) {
//                 echo "<li>User ID: " . htmlspecialchars($referralUser['user_id']) . ", Name: " . htmlspecialchars($referralUser['names']) . "</li>";
//             }
//             echo "</ul>";
//         } else {
//             echo "No users joined with the referral code of User ID: $user_id";
//         }
//     } else {
//         echo "User ID not provided.";
//     }
// }



// if (isset($_GET['view_referrals']) && isset($_GET['user_id'])) {
//     $user_id = $_GET['user_id'];
//     $referralUsers = getUser($conn, $user_id); 

//     if (!empty($referralUsers)) { 
//         echo "<h3>Users who joined with referral code of User ID: $user_id</h3>";

//         echo "<ul>";
//         foreach ($referralUsers as $referralUser) {
//             echo "<li>User ID: " . htmlspecialchars($referralUser['user_id']) . ", Name: " . htmlspecialchars($referralUser['names']) . "</li>";
//         }
//         echo "</ul>";
//     } else {
//         echo "No users joined with the referral code of User ID: $user_id";
//     }
// } else {
//     echo "User ID or view_referrals not provided.";
// }

// function getUser($conn, $user_id)
// {
//     $query = "SELECT * FROM `registration` WHERE `joining_referral` = '$user_id'";
//     $result = mysqli_query($conn, $query);
//     $referralUsers = array();
    
//     while ($row = mysqli_fetch_assoc($result)) {
//         $referralUsers[] = $row;
//     }

//     return $referralUsers;
// }


function getUser($conn, $user_id)
{
    $query = "SELECT * FROM `registration` WHERE `user_id` = '$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $level1 = $row['level1'];
    $level2 = $row['level2'];
    $level3 = $row['level3'];
    $level4 = $row['level4'];
    $level5 = $row['level5'];
    $levelAll = $level1 . ' ' . $level2 . ' ' . $level3 . ' ' . $level4 . ' ' . $level5;

    $data = str_replace(" ", "','", $levelAll);
    $ddata = str_replace(",''", "", $data);

    $sql = "SELECT * FROM  `registration` WHERE `user_id` IN ('$ddata') ORDER BY `id` ASC";
    $result = mysqli_query($conn, $sql);
    $nums = mysqli_num_rows($result);
    $referralUsers = array(); 

    if (!empty($levelAll)) {
        $userIds = explode(" ", $levelAll);
        $query = "SELECT * FROM registration WHERE user_id IN ('" . implode("','", $userIds) . "')";
        $result = mysqli_query($conn, $query);

        while ($row_levels = mysqli_fetch_assoc($result)) {
            $referralUsers[] = $row_levels; 
        }
    }

    return $referralUsers; 
}

if (isset($_GET['view_referrals']) && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $referralUsers = getUser($conn, $user_id);

    if (!empty($referralUsers)) {
        echo "<h3>Users who joined with the referral code of User ID: $user_id</h3>";

        echo "<table class='table table-success table-striped'>";
        echo "<tr><th>User ID</th><th>Name</th><th>Email</th><th>Active/Inactive</th></tr>";

        foreach ($referralUsers as $referralUser) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($referralUser['user_id']) . "</td>";
            echo "<td>" . htmlspecialchars($referralUser['names']) . "</td>";
            echo "<td>" . htmlspecialchars($referralUser['email']) . "</td>";
            echo "<td>" . htmlspecialchars($referralUser['active_and_inactive']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No users joined with the referral code of User ID: $user_id";
    }
} else {
    echo "User ID not provided.";
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

</head>

<body>
</body>

</html>