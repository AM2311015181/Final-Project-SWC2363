<?php
include 'db_connect.php';

if (!isset($_GET['id'])) {
    die("Comment ID not specified.");
}

$comment_id = $_GET['id'];

// Delete the comment from the database
$stmt = $conn->prepare("DELETE FROM comments WHERE comment_id = ?");
$stmt->bind_param("i", $comment_id);

if ($stmt->execute()) {
    header("Location: admin_index.php?message=Comment deleted successfully.");
} else {
    die("Error deleting comment: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
