<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cake Delivery</title>
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
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
            text-align: left;
            font-size: 14px;
        }
        input[type="text"], input[type="password"], input[type="email"] {
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
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #ff4a3d;
        }
        a {
            color: #ff6f61;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover {
            text-decoration: underline;
        }
        p {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }
        .forgot-password {
            text-align: right;
            margin-bottom: 15px;
        }
        .forgot-password a {
            font-size: 13px;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 400px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="authenticate.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <div class="forgot-password">
                <a href="#" onclick="openForgotPasswordModal()">Forgot Password?</a>
            </div>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Create one</a></p>
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgotPasswordModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeForgotPasswordModal()">&times;</span>
            <h2>Reset Password</h2>
            <p>Enter your email address and we'll send you a link to reset your password.</p>
            <form action="reset_password.php" method="post">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Send Reset Link</button>
            </form>
        </div>
    </div>

    <script>
        // Function to open the forgot password modal
        function openForgotPasswordModal() {
            document.getElementById('forgotPasswordModal').style.display = 'block';
        }
        
        // Function to close the forgot password modal
        function closeForgotPasswordModal() {
            document.getElementById('forgotPasswordModal').style.display = 'none';
        }
        
        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            if (event.target == document.getElementById('forgotPasswordModal')) {
                closeForgotPasswordModal();
            }
        }
    </script>
</body>
</html>