<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin_login.php"); // Redirect to login if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook Lounge</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: 'Lora', serif; /* Elegant and professional font */
            margin: 0;
            padding: 0;
            background-color: #F4F4F4; /* Soft pearl white */
            color: #333333; /* Dark slate gray */
        }
        header {
            background-color: #2C3E50; /* Updated background color */
            border-bottom: 3px solid #D4AF37; /* Royal gold accent */
            padding: 15px 0;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 10px;
        }
        .navbar img {
            height: auto;
            width: 100px; /* Updated width */
            margin-right: 5px; /* Added margin */
        }
        .navbar-items {
            flex-grow: 1; /* Allow items to take space */
            display: flex;
            justify-content: center; /* Center menu */
        }
        .navbar-items ul {
            display: flex;
            list-style: none;
        }
        .navbar-items ul li {
            margin: 0 15px;
        }
        .navbar-items ul li a {
            text-decoration: none;
            color: #ffffff; /* Updated text color */
            font-weight: bold;
            transition: 0.3s;
        }
        .navbar-items ul li a:hover {
            color: #D4AF37; /* Updated hover color */
        }
        .icons img {
            width: 30px;
            cursor: pointer;
        }
        main {
            padding: 40px;
            text-align: center;
        }
        section {
            background: #FFFFFF; /* Pure white */
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 20px auto;
        }
        h2 {
            font-size: 28px;
            color: #2C3E50;
        }
        footer {
            background-color: #1B1B1B; /* Graphite gray */
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
            <img src="cook lounge logo2.png" alt="Logo" style="height: auto; width: 100px; margin-right: 5px;"> <!-- Updated logo -->

            <div class="navbar-items">
                <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="recipe.php">RECIPES</a></li>
                <li><a href="admin_login.php">LOGIN</a></li>
                </ul>
            </div>
    </header>

    <main>
        <section>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></h2>
            <p>Manage recipes and comments below.</p>
        </section>

        <section>
            <h2>Recipe Management</h2>
            <?php
            include 'db_connect.php';
            $recipes = $conn->query("SELECT * FROM recipes ORDER BY created_at DESC");
            
            if ($recipes->num_rows > 0): ?>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Title</th>
                            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($recipe = $recipes->fetch_assoc()): ?>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                <?php echo htmlspecialchars($recipe['title']); ?>
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                <a href="edit_recipe.php?id=<?php echo $recipe['recipe_id']; ?>" style="color: #D4AF37; font-weight: bold; padding: 3px 6px; border: 1px solid #D4AF37; border-radius: 3px;">EDIT</a>
                                <a href="delete_recipe.php?id=<?php echo $recipe['recipe_id']; ?>" style="color: #ff0000; font-weight: bold; padding: 3px 6px; border: 1px solid #ff0000; border-radius: 3px; margin-left: 5px;" onclick="return confirm('Are you sure?')">DELETE</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No recipes found.</p>
            <?php endif; ?>
            <div style="margin-top: 20px; display: flex; gap: 10px;">
                <a href="addrecipe.php" style="background-color: #D4AF37; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; font-weight: bold;">+ ADD RECIPE</a>
                <a href="recipe.php" style="background-color: #2C3E50; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">VIEW ALL RECIPES</a>
            </div>
        </section>

        <section>
            <h2>Recent Comments</h2>
            <?php
            $comments = $conn->query("SELECT c.*, r.title FROM comments c JOIN recipes r ON c.recipe_id = r.recipe_id ORDER BY c.created_at DESC LIMIT 5");
            
            if ($comments->num_rows > 0): ?>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Recipe</th>
                            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Comment</th>
                            <th style="text-align: left; padding: 8px; border-bottom: 1px solid #ddd;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($comment = $comments->fetch_assoc()): ?>
                        <tr>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                <?php echo htmlspecialchars($comment['title']); ?>
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                <?php echo htmlspecialchars(substr($comment['comment'], 0, 50)); ?>...
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                <a href="delete_comment.php?id=<?php echo $comment['comment_id']; ?>" style="color: #ff0000;" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No comments yet.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>© 2025 Cook Lounge | Excellence in Cooking</p>
    </footer>
</body>
</html>
