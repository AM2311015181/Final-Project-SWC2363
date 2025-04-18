<?php
$servername = "localhost";
$port = 8080; // Specify the port number


$username = "root";
$password = ""; // Leave empty if no password is set
$database = "cook_lounge";

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);




// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// echo "Connected successfully"; // Uncomment this line to check if the connection is successful
?>
