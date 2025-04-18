<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Recipe ID not specified.");
}

$recipe_id = $_GET['id'];

// Delete the recipe from the database
$stmt = $conn->prepare("DELETE FROM recipes WHERE recipe_id = ?");
$stmt->bind_param("i", $recipe_id);

if ($stmt->execute()) {
    header("Location: admin_index.php?message=Recipe deleted successfully.");
} else {
    die("Error deleting recipe: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
