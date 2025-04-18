<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check credentials against database
    $stmt = $conn->prepare("SELECT id, password_hash FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password_hash'])) {
            $_SESSION["admin_id"] = $admin['id'];
            $_SESSION["admin_username"] = $username;
            $_SESSION['loggedin'] = true;
            header("Location: admin_index.php");
            exit();
        }
    }
    
    $error_message = "Invalid username or password.";
    header("Location: admin_login.php?error=" . urlencode($error_message));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Cook Lounge</title>
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
            justify-content: center;
            height: 100vh;
        }
        header {
            background-color: #2C3E50;
            border-bottom: 3px solid #D4AF37;
            width: 100%;
            padding: 15px 0;
        }
        .navbar {
            display: flex;
            justify-content: center; /* Center the navbar */
            align-items: center;
            padding: 10px 20px;
        }
        .navbar img {
            height: 40px;
            margin-right: 20px; /* Add space between logo and links */
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
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #2C3E50;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-container input[type="submit"] {
            background-color: #D4AF37;
            color: white;
            border: none;
            cursor: pointer;
        }
        .login-container input[type="submit"]:hover {
            background-color: #b5942a;
        }
        .error {
            color: red;
            margin-top: 10px;
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
                <li><a href="admin_login.php">LOGIN</a></li>
        </ul>
        </div>
    </header>

    <div class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        
    <a href="setup_admin.php" class="admin-btn">
        <span class="btn-icon">+</span>
        Create New Admin
    </a>

<style>
.admin-btn {
    display: block;
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    background-color: #2C3E50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 600;
    text-align: center;
    font-family: 'Lora', serif;
    font-size: 16px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.admin-btn:hover {
    background-color: #1A252F;
}

.btn-icon {
    font-weight: bold;
    margin-right: 8px;
}
</style>
        
        
        <?php if (isset($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>
    
</body>
</html>
