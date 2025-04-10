<?php
// db_connection.php
$host = 'localhost';       // Database host
$db   = 'cake_delivery';  // Database name
$user = 'root';           // Database username (default for XAMPP)
$pass = '';               // Database password (default for XAMPP is blank)

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>