<?php
date_default_timezone_set('Asia/Calcutta');

$servername = "localhost";
$username  = "root";
$password = "";
$dbanme = "registerr";
$conn = new mysqli($servername, $username, $password, $dbanme);

if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}
?>