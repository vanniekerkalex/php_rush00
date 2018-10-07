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

// ADD PRODUCTS

// sql to create table for products
$sql = "SELECT 1 FROM products LIMIT 1";
if (mysqli_query($conn, $sql)) {

} else {
    $sql = "CREATE TABLE IF NOT EXISTS products (
        prod_id int(11) not null AUTO_INCREMENT PRIMARY KEY, 
        prod_name VARCHAR(256) not null,
        prod_price int(11) not null,
        prod_img VARCHAR(256) not null
        )";
    
    if (mysqli_query($conn, $sql)) {
    
        $sql = "INSERT INTO products (prod_name, prod_price, prod_img) VALUES ('Apple Airpods', '3000', './img/1.png');";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO products (prod_name, prod_price, prod_img) VALUES ('iPhone 6', '6750', './img/2.jpg');";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO products (prod_name, prod_price, prod_img) VALUES ('iPhone 5 case', '300', './img/3.jpg');";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO products (prod_name, prod_price, prod_img) VALUES ('iPhone 6 case', '325', './img/4.jpg');";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO products (prod_name, prod_price, prod_img) VALUES ('Skullcandy JIB', '400', './img/5.jpg');";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO products (prod_name, prod_price, prod_img) VALUES ('iPhone 5', '3500', './img/6.jpg');";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO products (prod_name, prod_price, prod_img) VALUES ('Samsung S7', '8750', './img/7.jpg');";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO products (prod_name, prod_price, prod_img) VALUES ('Samsung S6 case', '280', './img/8.jpg');";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO products (prod_name, prod_price, prod_img) VALUES ('Samsung headphones', '495', './img/9.jpeg');";
        mysqli_query($conn, $sql);
    
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}
    
    // sql to create table for baskets
$sql = "CREATE TABLE IF NOT EXISTS basket (
    basket_id int(11) not null AUTO_INCREMENT PRIMARY KEY, 
    user_name VARCHAR(256) not null,
    prod_id int(11) not null,
    prod_qty int(11) not null
    )";
        
if (mysqli_query($conn, $sql)) {
    
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
mysqli_close($conn);
?>