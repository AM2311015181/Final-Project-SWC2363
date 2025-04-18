<?php
include 'db_connect.php'; // Include database connection

$message = ""; // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $prep_time = $_POST['prep_time'];
    $cook_time = $_POST['cook_time'];
    $servings = $_POST['servings'];
    $difficulty = $_POST['difficulty'];
    $category = $_POST['category'];
    if (!isset($_FILES['image_upload']) || $_FILES['image_upload']['error'] !== UPLOAD_ERR_OK) {
        die("Error: Recipe image is required");
    }
    $image_data = file_get_contents($_FILES['image_upload']['tmp_name']);

    // Insert the new recipe into the database
    $sql = "INSERT INTO recipes (title, description, ingredients, instructions, prep_time, cook_time, servings, difficulty, category, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("ssssiissss", $title, $description, $ingredients, $instructions, $prep_time, $cook_time, $servings, $difficulty, $category, $image_data);

    if ($stmt->execute()) {
        $message = "New recipe added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe - Cook Lounge</title>
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
            justify-content: center;
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
        .message {
            color: green;
            text-align: center;
        }
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container label {
            display: block;
            margin: 10px 0 5px;
        }
        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background-color: #D4AF37;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #b5942a;
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
                <li><a href="admin_index.php">ADMIN</a></li>
                <li><a href="admin_login.php">USER</a></li>
            </ul>

        </div>
    </header>

    <div class="hero">
        <h1>Add a New Recipe</h1>
        <p>Share your delicious recipe with the world!</p>
    </div>

    <div class="message"><?php echo $message; ?></div>

    <div class="form-container">
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="ingredients">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" required></textarea>

            <label for="instructions">Instructions:</label>
            <textarea id="instructions" name="instructions" required></textarea>

            <label for="prep_time">Prep Time (minutes):</label>
            <input type="number" id="prep_time" name="prep_time" required>

            <label for="cook_time">Cook Time (minutes):</label>
            <input type="number" id="cook_time" name="cook_time" required>

            <label for="servings">Servings:</label>
            <input type="number" id="servings" name="servings" required>

            <label for="difficulty">Difficulty:</label>
            <select id="difficulty" name="difficulty" required>
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
            </select>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>

            <label for="image_upload">Recipe Image (required):</label>
            <input type="file" id="image_upload" name="image_upload" accept="image/*" required>
            <p>Only image uploads are accepted</p>

            <input type="submit" value="Add Recipe">
        </form>
    </div>

    <footer>
        <p>© 2025 Cook Lounge | Excellence in Cooking</p>
    </footer>
</body>
</html>

<?php
$conn->close(); // Close database connection
?>
