<?php

date_default_timezone_set('Asia/Calcutta');

$servername = "localhost";
$username = "root";
$password = "";
$dataBase = "registerr";

$conn = mysqli_connect($servername, $username, $password, $dataBase);

// create table 

// $sql = "CREATE TABLE `admin` (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     userId INT(255) UNIQUE,
//     firstname VARCHAR(200) NOT NULL,
//     lastname VARCHAR(200) NOT NULL,
//     mobile VARCHAR(50) UNIQUE NOT NULL,
//     passwrd VARCHAR(255) NOT NULL,
//     img VARCHAR(255) NOT NULL,
//     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//     up_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
//     )";


// if (mysqli_query($conn, $sql)) {
//     echo "Table admin created successfully";
// } else {
//     echo "Error creating table: " . mysqli_error($conn);
// }
