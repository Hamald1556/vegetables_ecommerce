<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Retrieve user ID from session
} else {
    // Redirect user to login page or handle authentication failure
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vegetables_ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product details from AJAX request
$productId = $_POST['productId'];
$productDescription = $_POST['productDescription'];
$productAmount = $_POST['productAmount'];
$productCategory = $_POST['productCategory'];

// Insert product details into cart table with user ID
$sql = "INSERT INTO cart (user_id, description, amount, category) VALUES ('$userId', '$productDescription', '$productAmount', '$productCategory')";
if ($conn->query($sql) === TRUE) {
    echo "Product added to cart successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
