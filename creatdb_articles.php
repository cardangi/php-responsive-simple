 <?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CREATING DB "CONTENT"
$sql = "CREATE DATABASE content";
if ($conn->query($sql) === TRUE) {
    echo "Database <b>content</b> created successfully<br/><br/>";
} else {
    echo "Error creating database: " . $conn->error . "<br/><br/>";
}

require('connection.php');

// CREATING TABLE "ARTICLES"
$sql2 = "CREATE TABLE articles (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title TEXT NOT NULL,
subtitle TEXT NOT NULL,
description TEXT NOT NULL,
content TEXT NOT NULL,
date TIMESTAMP
)";

if ($conn->query($sql2) === TRUE) {
    echo "Table <b>articles</b> created successfully<br/><br/>";
}
else{
    echo "Error creating table: " . $conn->error . "<br/><br/>";
}

require('connectionclose.php');

?> 