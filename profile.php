<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
require 'db_connection.php';

// Fetch user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email, full_name, phone, address, profile_pic FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email, $full_name, $phone, $address, $profile_pic);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Cake Delivery</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }
        h2 {
            margin-bottom: 15px;
            color: #333;
            font-size: 22px;
        }
        .profile-pic {
            margin-bottom: 15px;
        }
        .profile-pic img {
            max-width: 100px;
            border-radius: 50%;
            border: 3px solid #ff6f61;
        }
        .info {
            text-align: left;
            margin-top: 15px;
        }
        .info p {
            margin-bottom: 10px;
            color: #555;
            font-size: 14px;
        }
        a {
            color: #ff6f61;
            text-decoration: none;
            font-size: 12px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Profile</h2>
        <!-- Profile Picture (Upar) -->
        <div class="profile-pic">
            <?php if ($profile_pic): ?>
                <img src="<?php echo $profile_pic; ?>" alt="Profile Picture">
            <?php else: ?>
                <p>No image uploaded.</p>
            <?php endif; ?>
        </div>

        <!-- User Information (Niche) -->
        <div class="info">
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Full Name:</strong> <?php echo $full_name; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            <p><strong>Address:</strong> <?php echo $address; ?></p>
        </div>

        <!-- Logout Link -->
        <a href="logout.php">Logout</a>&nbsp&nbsp
        <a href="index.php">Go Home</a>
    </div>
</body>
</html>