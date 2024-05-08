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

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <style>
        body {
            background-color: #59ab6e;
        }
    </style>
</head>
<body>


<section class="bg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
    <center>
    <div style="padding-left:300px; height:70%;width:70%;">
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
    </div>
</center>
    </div>
            </div>
    </section>
</div>
</body>
</html>
