<?php
include 'db_connect.php'; // Include database connection

$sql = "SELECT * FROM recipes ORDER BY created_at DESC"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes - Cook Lounge</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Lora', serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4;
            color: #333333;
        }
        .comments-section {
            margin-top: 30px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .comment {
            padding: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }
        .comment-form {
            margin-top: 20px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        header {
            background-color: #2C3E50;
            border-bottom: 3px solid #D4AF37;
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
        .hero {
            background: url('recipes-hero.jpg') no-repeat center/cover;
            text-align: center;
            color: #ffffff;x
            padding: 80px 20px;
        }
        .hero h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .recipe-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 40px;
            max-width: 1000px;
            margin: auto;
        }
        .recipe-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .recipe-card:hover {
            transform: scale(1.05);
        }
        .recipe-card img {
            width: 100%;
            border-radius: 10px;
            height: 180px;
            object-fit: cover;
        }
        .recipe-card h3 {
            margin-top: 15px;
            color: #2C3E50;
        }
        .recipe-card p {
            font-size: 14px;
            color: #666;
        }
        .recipe-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #D4AF37;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        footer {
            background-color: #1B1B1B;
            color: white;
            text-align: center;
            padding: 15px;
            font-weight: bold;
            margin-top: 30px;
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

    <div class="hero">
        <h1>Discover Delicious Recipes</h1>
        <p>Hand-picked recipes for every occasion.</p>
    </div>

    <div class="recipe-container">
        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='recipe-card'>";
                if (!empty($row["image_url"])) {
                    if (is_string($row["image_url"]) && filter_var($row["image_url"], FILTER_VALIDATE_URL)) {
                        echo "<img src='" . htmlspecialchars($row["image_url"]) . "' alt='Recipe Image'>";
                    } else {
                        echo "<img src='data:image/jpeg;base64," . base64_encode($row["image_url"]) . "' alt='Recipe Image'>";
                    }
                } else {
                    echo "<img src='images/default-recipe.jpg' alt='Recipe Image'>";
                }
                echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
                echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
                echo "<a href='viewrecipe.php?recipe_id=" . $row["recipe_id"] . "'>View Recipe</a>"; // Updated link
                echo "</div>";
            }
        } else {
            echo "<p>No recipes available.</p>";
        }
        ?>
    </div>

    <footer>
        <p>© 2025 Cook Lounge | Excellence in Cooking</p>
    </footer>

</body>
</html>

<?php
$conn->close(); // Close database connection
?>
