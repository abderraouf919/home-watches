<?php
// Database connection parameters
$servername = "localhost";
$username = "your_username"; // Replace with your database username
$password = "your_password"; // Replace with your database password
$dbname = "client";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validate data (you can add more validation as needed)
    if (empty($email) || empty($password)) {
        die("Email and password are required.");
    }
    
    // Hash the password for security (recommended)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO login (Gmail, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to success page
        header("Location: quatrieme.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
