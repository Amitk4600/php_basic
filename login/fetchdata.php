<?php
include "./registration/connection.php";
include_once "./countMember.php";
// Check if user is logged in
if (!isset($_SESSION['id'])) {
   header("location: http://localhost/amit_php/login/index.php");
   exit();
}

$id = $_SESSION['id'];
$fetch = "SELECT * FROM registration WHERE `user_id` = '$id' ";
$result = mysqli_query($conn, $fetch);
$nums = mysqli_num_rows($result);
if ($nums > 0) {
   echo "<table class='table table-success table-striped'>
         <tr>
            <th scope='col'>id</th>
            <th scope='col'>name</th>
            <th scope='col'>email</th>
            <th scope='col'>mobile</th>
            <th scope='col'>wallet</th>
            <th scope='col'>update</th>
         </tr>";
   while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr class='table-info'>
            <td>" . $row['id'] . "</td>
            <td>" . $row['names'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['mobile'] . "</td>
            <td>" . $row['total_amt'] . "</td>
            <td><a href='../update/update_index.php'><button class='btn btn-outline-info'>Update</button></a></td>
         </tr>";
   }
   echo "</table>";
}

$query = "SELECT * FROM Registration WHERE `user_id` ='$id' ";
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

$sql = "SELECT * FROM  `registration` WHERE `user_id` IN ('$ddata') ORDER BY `id` ASC";
$result = mysqli_query($conn, $sql);
$nums = mysqli_num_rows($result);
echo "<div > <h2>total member: $nums</h2></div>";
echo "<form method='GET'>";
echo "<select name='levels'>";
echo "<option value='level1'" . ($_GET['levels'] == 'level1' ? ' selected' : '') . ">Level 1</option>";
echo "<option value='level2'" . ($_GET['levels'] == 'level2' ? ' selected' : '') . ">Level 2</option>";
echo "<option value='level3'" . ($_GET['levels'] == 'level3' ? ' selected' : '') . ">Level 3</option>";
echo "<option value='level4'" . ($_GET['levels'] == 'level4' ? ' selected' : '') . ">Level 4</option>";
echo "<option value='level5'" . ($_GET['levels'] == 'level5' ? ' selected' : '') . ">Level 5</option>";
echo "</select>";

echo "<input type='submit' value='Show Members'>";
echo "</form>";

if (isset($_GET['levels'])) {
   $level = $_GET['levels'];
   $levelData = "";
   if ($level == 'level1') {
      $levelData = $level1;
   } elseif ($level == 'level2') {
      $levelData = $level2;
   } elseif ($level == 'level3') {
      $levelData = $level3;
   } elseif ($level == 'level4') {
      $levelData = $level4;
   } elseif ($level == 'level5') {
      $levelData = $level5;
   }
   $userIds = explode(" ", $levelData);

   $query = "SELECT * FROM registration WHERE user_id IN ('" . implode("','", $userIds) . "')";
   $result = mysqli_query($conn, $query);
   $num_levels = mysqli_num_rows($result);

   if ($num_levels > 0) {
      echo "<div class='sub-count'><h2>referral member: $num_levels of   $level </h2></div>";
      echo "<table class='table table-success table-striped'>
         <tr>
            <th scope='col'>id</th>
            <th scope='col'>name</th>
            <th scope='col'>email</th>
            <th scope='col'>mobile</th>
            <th scope='col'>wallet</th>
          </tr>";

      while ($row_levels = mysqli_fetch_assoc($result)) {
         echo "<tr class='table-info'>
            <td>" . $row_levels['id'] . "</td>
            <td>" . $row_levels['names'] . "</td>
            <td>" . $row_levels['email'] . "</td>
            <td>" . $row_levels['mobile'] . "</td>
            <td>" . $row_levels['total_amt'] . "</td>
        
         </tr>";
      }
      echo "</table>";
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
         border: 1px solid black;
         width: 10rem;
         height: 3rem;
         margin: 20px;
         padding: 5px;
         border-radius: 18px;
         position: relative;
         left: 82%;
         font-size: 26px;
         font-weight: 700;
         box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
      }
   </style>
</head>

<body>
</body>

</html>