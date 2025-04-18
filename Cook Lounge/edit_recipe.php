<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Recipe ID not specified.");
}

$recipe_id = $_GET['id'];
$message = "";

// Fetch the recipe details
$stmt = $conn->prepare("SELECT * FROM recipes WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $recipe = $result->fetch_assoc();
} else {
    die("Recipe not found.");
}

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

    // Update the recipe in the database
    $sql = "UPDATE recipes SET title=?, description=?, ingredients=?, instructions=?, prep_time=?, cook_time=?, servings=?, difficulty=?, category=?, image_url=? WHERE recipe_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiissssi", $title, $description, $ingredients, $instructions, $prep_time, $cook_time, $servings, $difficulty, $category, $image_data, $recipe_id);

    if ($stmt->execute()) {
        $message = "Recipe updated successfully!";
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
    <title>Edit Recipe - Cook Lounge</title>
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
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            margin: 30px auto;
            text-align: left;
        }
        .form-container h2 {
            color: #2C3E50;
            margin-bottom: 20px;
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
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="submit"] {
            background-color: #D4AF37;
            color: white;
            border: none;
            cursor: pointer;
            padding: 12px;
            font-weight: bold;
        }
        .form-container input[type="submit"]:hover {
            background-color: #b5942a;
        }
        .message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
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

    <div class="form-container">
        <h2>Edit Recipe</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($recipe['description']); ?></textarea>

            <label for="ingredients">Ingredients:</label>
            <textarea id="ingredients" name="ingredients" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>

            <label for="instructions">Instructions:</label>
            <textarea id="instructions" name="instructions" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea>

            <label for="prep_time">Prep Time (minutes):</label>
            <input type="number" id="prep_time" name="prep_time" value="<?php echo htmlspecialchars($recipe['prep_time']); ?>" required>

            <label for="cook_time">Cook Time (minutes):</label>
            <input type="number" id="cook_time" name="cook_time" value="<?php echo htmlspecialchars($recipe['cook_time']); ?>" required>

            <label for="servings">Servings:</label>
            <input type="number" id="servings" name="servings" value="<?php echo htmlspecialchars($recipe['servings']); ?>" required>

            <label for="difficulty">Difficulty:</label>
            <select id="difficulty" name="difficulty" required>
                <option value="Easy" <?php echo ($recipe['difficulty'] == 'Easy') ? 'selected' : ''; ?>>Easy</option>
                <option value="Medium" <?php echo ($recipe['difficulty'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
                <option value="Hard" <?php echo ($recipe['difficulty'] == 'Hard') ? 'selected' : ''; ?>>Hard</option>
            </select>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($recipe['category']); ?>" required>

            <label for="image_upload">Recipe Image (required):</label>
            <input type="file" id="image_upload" name="image_upload" accept="image/*" required>
            <p>Only image uploads are accepted</p>
            <?php if (!empty($recipe['image_url'])): ?>
                <p>Current Image: [Uploaded Image]</p>
            <?php endif; ?>

            <input type="submit" value="Update Recipe">
        </form>
        <div class="message"><?php echo $message; ?></div>
    </div>

    <footer>
        <p>© 2025 Cook Lounge | Excellence in Cooking</p>
    </footer>
</body>
</html>

<?php
$conn->close(); // Close database connection
?>
