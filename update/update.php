<?php


include "../registration/connection.php"; 

if (!isset($_SESSION['id'])) {
    header("location: http://localhost/amit_php/login/index.php");
    exit();
 }
 
if (isset($_POST['update'])) {
    $id = $_SESSION['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    
    

    
    $update = $conn->prepare("UPDATE registration SET names=?, email=?, mobile=? WHERE id=?");
    $update->bind_param("sssi", $name, $email, $mobile, $id);

    if ($update->execute()) {
        echo "<script>alert('Update successful'); window.location.href = 'http://localhost/amit_php/login/login.php';</script>";
        exit; 
    } else {
        echo "ERROR: " . $conn->error;
    }
}
?>