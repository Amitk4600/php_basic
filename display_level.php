<?php
session_start();
include "./registration/connection.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
}

$id = $_SESSION['id'];
$level = isset($_GET['level']) ? $_GET['level'] : 1;  // Default level to 1 if not set

$query = "SELECT * from Registration where `user_id` ='$id'";
$result = mysqli_query($conn, $query);
$num = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);

$level1 = $row['level1'];
$level2 = $row['level2'];
$level3 = $row['level3'];
$level4 = $row['level4'];
$level5 = $row['level5'];

// Set the appropriate level data based on the level parameter
$levelData = "";
if ($level == 1) {
    $levelData = $level1;
} elseif ($level == 2) {
    $levelData = $level2;
} elseif ($level == 3) {
    $levelData = $level3;
} elseif ($level == 4) {
    $levelData = $level4;
} elseif ($level == 5) {
    $levelData = $level5;
}

// Split the level data into an array of user ids
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1>Level <?php echo $level; ?> Data</h1>
        <p>Active Users: <?php echo $active_count; ?></p>
        <p>Inactive Users: <?php echo $inactive_count; ?></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Type</th>
                    <th scope='col'>active/inactive</th>
                </tr>
            </thead>
            <?php $count =1; ?>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $count++ ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['names']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td>Level <?php echo $level; ?></td>
                        <td><?php echo $row['active_and_inactive'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="home">
        <a href="./total_member.php"><input class="btn btn-secondary" type="submit" value="Home"></a>
        <a href="?level=<?php echo $level; ?>&status=active"><button class="btn btn-success">Active Users</button></a>
        <a href="?level=<?php echo $level; ?>&status=inactive"><button class="btn btn-warning">Inactive Users</button></a>
    </div>
</body>

</html>
