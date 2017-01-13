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

// CREATING DB "USERS"
$sql = "CREATE DATABASE users";
if ($conn->query($sql) === TRUE) {
    echo "Database <b>users</b> created successfully<br/><br/>";
} else {
    echo "Error creating database: " . $conn->error . "<br/><br/>";
}

require('connection.php');

// CREATING TABLE "USERS"
$sql2 = "CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
access INT(6) NOT NULL,
name VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
password CHAR(96) NOT NULL,
date TIMESTAMP
)";

if ($conn2->query($sql2) === TRUE) {
    echo "Table <b>users</b> created successfully<br/><br/>";
} else {
    echo "Error creating table: " . $conn->error . "<br/><br/>";
}

require('connectionclose.php');

?> 