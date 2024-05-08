<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">

    <div class="w-100 d-flex justify-content-between" style="padding-left:20px;">
    <div>
    <a class="navbar-sm-brand text-light text-decoration-none" style="padding-right:30px;" href="contact.html">Contact Information</a>
    <a class="navbar-sm-brand text-light text-decoration-none" style="padding-left:30px;" href="about.html">About</a>
</div>
    <a class="text-light" href="admin_login.php" target="_blank" style="padding-right:40px; text-decoration: none;">Login</a>
    </div>

    </nav>

    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Zebra Bookshop</h2>
    
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Cart</h2>

                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Checkout</h2>
                    </ul>
                </div>

            </div>

            </div>
           <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
           Welcome to Our Bookstore
            </a>

    </div>
</nav>

<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>

            <footer class="bg-dark" id="tempaltemo_footer">
        

</footer>
</body>
</html>
