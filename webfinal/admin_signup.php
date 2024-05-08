<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tablebook"; // Corrected database name

// Check if the form is submitted
if(isset($_POST['signup'])) {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $username = $conn->real_escape_string($_POST['username']); // Escape input to prevent SQL injection
    $email = $conn->real_escape_string($_POST['email']); // Escape input to prevent SQL injection
    $password = $conn->real_escape_string($_POST['password']); // Escape input to prevent SQL injection

    // Hash the password for security

    // Insert new admin into database
    $sql = "INSERT INTO table_admins (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to login page after signup
        header("Location: admin_login.php");
        exit();
    } else {
        // Handle database insert error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
</head>
<body>
    <h1>Admin Signup</h1>
    
    <form action="" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        
        <input type="submit" name="signup" value="Sign Up">
    </form>
</body>
</html>
