<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
</head>
<body>
    <h1>Welcome to Our Bookstore</h1>
    <p><a href="admin_login.php">Login as Admin</a></p>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tablebook"; // Corrected database name
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check if the connection is successful
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch books from database
    $sql = "SELECT * FROM table_book";
    $result = $conn->query($sql);

    // Display books
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h2>" . $row["book"] . "</h2>";
            echo "<p>Genre: " . $row["genre"] . "</p>";
            echo "<p>Description: " . $row["description"] . "</p>";
            echo '<img src="' . $row["photo"] . '" alt="Book Cover" style="max-width: 200px;"><br>';
            echo "</div>";
        }
    } else {
        echo "No books available.";
    }

    // Close database connection
    $conn->close();
    ?>
</body>
</html>
