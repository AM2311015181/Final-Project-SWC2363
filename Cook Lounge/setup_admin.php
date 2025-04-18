<?php
include 'db_connect.php';

// Create admin account if none exists
$username = "AminR";
$password = "amin15"; // Change this to a strong password in production
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Setup - Cook Lounge</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Lora', serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4;
            color: #333333;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        header {
            background-color: #2C3E50;
            border-bottom: 3px solid #D4AF37;
            width: 100%;
            padding: 15px 0;
        }
        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 20px;
        }
        .navbar img {
            height: 40px;
            margin-right: 20px;
        }
        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .navbar li {
            margin: 0 20px;
        }
        .navbar a {
            text-decoration: none;
            color: #ffffff;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s;
        }
        .navbar a:hover {
            color: #D4AF37;
        }
        .setup-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            margin: 30px auto;
            text-align: center;
        }
        .setup-container h2 {
            color: #2C3E50;
            margin-bottom: 20px;
        }
        .message {
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            margin-top: 20px;
            padding: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <img src="cook lounge logo2.png" alt="Logo">
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="recipe.php">RECIPES</a></li>
                <li><a href="admin_login.php">ADMIN</a></li>
            </ul>
        </div>
    </header>

    <div class="setup-container">
        <h2>Admin Account Setup</h2>
        <?php
        // Check if admin exists
        $check = $conn->query("SELECT id FROM admin WHERE username = '$username'");
        if ($check->num_rows == 0) {
            // Hash the password
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert admin
            $stmt = $conn->prepare("INSERT INTO admin (username, password_hash) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password_hash);
            
            if ($stmt->execute()) {
                echo '<div class="message success">';
                echo 'Admin account created successfully!';
                echo '</div>';
                echo '<div>';
                echo '<p><strong>Username:</strong> ' . htmlspecialchars($username) . '</p>';
                echo '<p><strong>Password:</strong> ' . htmlspecialchars($password) . '</p>';
                echo '</div>';
                echo '<div class="warning">';
                echo 'IMPORTANT: Change this password immediately after first login!';
                echo '</div>';
            } else {
                echo '<div class="message error">';
                echo 'Error creating admin account: ' . htmlspecialchars($conn->error);
                echo '</div>';
            }
        } else {
            echo '<div class="message">';
            echo 'Admin account already exists';
            echo '</div>';
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
