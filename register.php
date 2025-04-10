<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}

// Include database connection
require 'db_connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Handle profile picture upload
    $profile_pic = "default.jpg"; // Default profile picture
    
    if (!empty($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        $target_dir = __DIR__ . "/uploads/";
        
        // Create uploads directory if it doesn't exist
        if (!file_exists($target_dir)) {
            if (!mkdir($target_dir, 0755, true)) {
                die("Failed to create upload directory");
            }
        }
        
        // Generate unique filename
        $file_ext = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
        $new_filename = uniqid() . '.' . $file_ext;
        $target_file = $target_dir . $new_filename;
        
        // Verify image
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check === false) {
            die("File is not an image.");
        }
        
        // Move the uploaded file
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $profile_pic = "uploads/" . $new_filename;
        } else {
            error_log("File upload failed. Check permissions for: " . $target_dir);
            // Continue with default image
        }
    }

    // Insert user data
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, full_name, phone, address, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $username, $email, $password, $full_name, $phone, $address, $profile_pic);
    
    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Cake Delivery</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #ff6f61;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #ff4a3d;
        }
        .file-input {
            margin: 15px 0;
        }
        .file-input label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        a {
            color: #ff6f61;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Create Account</h2>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="tel" name="phone" placeholder="Phone" required>
            <textarea name="address" placeholder="Address" rows="3" required></textarea>
            
            <div class="file-input">
                <label for="profile_pic">Profile Picture:</label>
                <input type="file" id="profile_pic" name="profile_pic" accept="image/*">
            </div>
            
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>