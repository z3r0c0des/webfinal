<?php
session_start();

// Check if the form is submitted
if(isset($_POST['add_book'])) {
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

    // Retrieve form data
    $book = $conn->real_escape_string($_POST['book']); // Escape input to prevent SQL injection
    $genre = $conn->real_escape_string($_POST['genre']); // Escape input to prevent SQL injection
    $description = $conn->real_escape_string($_POST['description']); // Escape input to prevent SQL injection

    // File upload handling
    $targetDirectory = "uploads/"; // Directory to store uploaded images
    $targetFile = $targetDirectory . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        // Create the directory if it doesn't exist
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
            // Insert new book into database
            $photoPath = $targetDirectory . basename($_FILES["photo"]["name"]);
            $sql = "INSERT INTO table_book (book, genre, description, photo, is_active) VALUES ('$book', '$genre', '$description', '$photoPath', 1)";
            if($conn->query($sql) === TRUE) {
                // Redirect back to admin dashboard after book is added
                header("Location: admin_dashboard.php");
                exit();
            } else {
                // Handle database insert error
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
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
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

    <style>
        body {
            background-color: #59ab6e;
        }

        .form-container {
            padding-left: 300px;
            height: 70%;
            width: 70%;
        }
    </style>
</head>

<body>
    <section class="bg-success py-5">
        <div class="container">
            <div class="col-md-8 text-white">
                <center>
                    <div class="form-container">
                        <h1>Welcome to the Admin Dashboard</h1>
                        <p>Logged in as Admin</p>
                        <a href="index.php">Logout</a>
                        <a href="admin_signup.php">signup</a>
                        <h2>Add Book</h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="book">Book Name:</label><br>
                            <input type="text" id="book" name="book" required><br>
                            <label for="genre">Genre:</label><br>
                            <input type="text" id="genre" name="genre" required><br>
                            <label for="description">Description:</label><br>
                            <textarea id="description" name="description" required></textarea><br>
                            <label for="photo">Book Cover Photo:</label><br>
                            <input type="file" id="photo" name="photo" accept="image/*" required><br>
                            <input type="submit" name="add_book" value="Add Book">
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </section>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
