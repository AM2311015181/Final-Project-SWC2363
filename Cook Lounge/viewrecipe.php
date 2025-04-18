<?php
include 'db_connect.php'; // Include database connection

// Fetch the recipe details based on the recipe_id passed in the URL
$recipe_id = $_GET['recipe_id'];
$sql = "SELECT * FROM recipes WHERE recipe_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();

if (!$recipe) {
    // Handle case where recipe is not found
    echo "Recipe not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['title']); ?> - Cook Lounge</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Lora', serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4;
            color: #333333;
        }
        header {
            background-color: #2C3E50;
            border-bottom: 3px solid #D4AF37;
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
        .hero {
            background: url('recipes-hero.jpg') no-repeat center/cover;
            text-align: center;
            color: #ffffff;
            padding: 80px 20px;
        }
        .hero h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .recipe-details {
            padding: 20px;
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .recipe-details img {
            width: 100%;
            border-radius: 10px;
            height: auto;
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
        <h1><?php echo htmlspecialchars($recipe['title']); ?></h1>
        <p>Discover the details of this delicious recipe.</p>
    </div>

    <div class="recipe-details">
        <?php
        if (!empty($recipe['image_url'])) {
            if (is_string($recipe['image_url']) && filter_var($recipe['image_url'], FILTER_VALIDATE_URL)) {
                // Handle URL case
                $headers = @get_headers($recipe['image_url']);
                $image_exists = $headers && strpos($headers[0], '200');
                echo '<img src="' . ($image_exists ? htmlspecialchars($recipe['image_url']) : 'images/default-recipe.jpg') . '" 
                     alt="Recipe Image" 
                     onerror="this.src=\'images/default-recipe.jpg\'">';
            } else {
                // Handle binary data case
                echo '<img src="data:image/jpeg;base64,' . base64_encode($recipe['image_url']) . '" alt="Recipe Image">';
            }
        } else {
            echo '<img src="images/default-recipe.jpg" alt="Recipe Image">';
        }
        ?>
        <h2>Description</h2>
        <p><?php echo htmlspecialchars($recipe['description']); ?></p>
        <h2>Ingredients</h2>
        <p><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>
        <h2>Instructions</h2>
        <p><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
        <h2>Prep Time</h2>
        <p><?php echo htmlspecialchars($recipe['prep_time']); ?> minutes</p>
        <h2>Cook Time</h2>
        <p><?php echo htmlspecialchars($recipe['cook_time']); ?> minutes</p>
        <h2>Servings</h2>
        <p><?php echo htmlspecialchars($recipe['servings']); ?></p>
        <h2>Difficulty</h2>
        <p><?php echo htmlspecialchars($recipe['difficulty']); ?></p>
        <h2>Category</h2>
        <p><?php echo htmlspecialchars($recipe['category']); ?></p>
    </div>

    <footer>
        <p>© 2025 Cook Lounge | Excellence in Cooking</p>
    </footer>
</body>
</html>

<?php
$stmt->close();
$conn->close(); // Close database connection
?>
