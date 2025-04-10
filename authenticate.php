<?php
session_start();
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Secure prepared statement
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            header("Location: Mayuri.php"); // Redirect to cart page after login
            exit();
        } else {
            echo "<script>alert('Invalid username or password!'); window.location.href='login.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Please enter both username and password!'); window.location.href='login.php';</script>";
    }
}
?>
