<?php
session_start();

// Check if admin is already logged in
if(isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tablebook"; // Corrected database name
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if form is submitted
if(isset($_POST['login'])) {
    // Retrieve username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform SQL query to check if username and password match
    $sql = "SELECT * FROM table_admins WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // If a row is returned, authentication is successful
    if($result->num_rows == 1) {
        // Set session variable
        $_SESSION['admin_id'] = $row['id'];
        
        // Redirect to admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Authentication failed, show error message
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <?php if(isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
