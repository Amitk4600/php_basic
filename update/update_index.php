<?php
session_start(); // Start the session

include "../registration/connection.php";
include "../update/update.php";

$fetch = "SELECT * FROM registration WHERE id = ?";
$stmt = mysqli_prepare($conn, $fetch);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);


if ($res && $row = mysqli_fetch_assoc($res)) {
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if any input field is empty
    if (empty($_POST["name"]) && empty($_POST["email"]) &&  empty($_POST["mobile"])) {
        echo "<script>alert('Please fill in all fields')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="editPopup">
        <form method="post">
            <input type="hidden" name="id" id="edit-id">
            <label for="edit-name">Name:</label>
            <input type="text" name="name"  id="edit-name"  value="<?php echo $row['names']; ?>"><br>
            <label for="edit-email">Email:</label>
            <input type="email" name="email" id="edit-email" value="<?php echo $row['email']; ?>" required><br>
            
            <label for="edit-mobile">Mobile:</label>
            <input type="text" name="mobile" id="edit-mobile" maxlength="10" size="10" value="<?php echo $row['mobile']; ?>" required><br>
            <input type="submit" value="Submit" name="update">
         
            <button type="button" class="btn-close" aria-label="Close" onclick="cancel()">X</button>
        </form>
    </div>
<div>

    <a href="http://localhost/amit_php/login/login.php"><button type="button">Home</button></a>
    <a href="../logout.php"><button type="button">Log Out</button></a>
</div>

    <script>
        // cancel
        function cancel() {
            window.location.href = 'http://localhost/amit_php/login/login.php';
        }
    </script>
</body>

</html>