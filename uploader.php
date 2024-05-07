<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Check if a file was uploaded
    if (isset($_FILES["file"])) {
        $file = $_FILES["file"];
        
        // Check if the uploaded file is a SQL file
        if ($file["type"] == "application/sql") {
            // Move the uploaded file to a temporary location
            $tmp_name = $file["tmp_name"];
            $destination = "uploads/" . $file["name"];
            move_uploaded_file($tmp_name, $destination);

            // Import the SQL file into the database
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $database = "tablebook";

            // Command to import the SQL file into the database
            $command = "mysql -u$username -p$password $database < $destination";
            exec($command, $output, $return_var);

            // Check if the import was successful
            if ($return_var == 0) {
                echo "Database imported successfully";
            } else {
                echo "Error importing database: " . implode("\n", $output);
            }

            // Remove the uploaded file
            unlink($destination);
        } else {
            echo "Invalid file format. Please upload a SQL file.";
        }
    } else {
        echo "No file uploaded.";
    }
} else {
    // Redirect back to the upload form if the form wasn't submitted
    header("Location: upload_form.html");
    exit();
}
?>
