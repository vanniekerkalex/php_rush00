<?php
$servername = "localhost";
$username = "root";
$password = "alex123";

// Create connection
$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    exit();
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS loginsystem";

if (mysqli_query($conn, $sql)) {

} else {
    echo "Error creating database: " . mysqli_error($conn);
    exit();
}

$dbName = "loginsystem";

$conn = mysqli_connect($servername, $username, $password, $dbName);
// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS users (
user_id int(11) not null AUTO_INCREMENT PRIMARY KEY, 
user_first VARCHAR(256) not null,
user_last VARCHAR(256) not null,
user_email VARCHAR(256) not null,
user_username VARCHAR(256) not null,
user_password VARCHAR(256) not null
)";

if (mysqli_query($conn, $sql)) {

} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>