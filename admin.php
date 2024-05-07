<?php
// Database connection settings
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "tablebook";

// Create connection
$conn = new mysqli('127.0.0.1', 'root', '', 'tablebook');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Book = $_POST["Book"];
    $Description = $_POST["Description"];
    $IsActive = isset($_POST["IsActive"]) ? 1 : 0; // Check if the checkbox is checked
    $Genre=$_POST["Genre"];
    
    // Insert data into the database
    $sql = "INSERT INTO tablebook (BOOK, DESCRIPTION, IS_ACTIVE, Genre) VALUES ('$Book', '$Description', $IsActive,'$Genre')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
