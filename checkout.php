<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Database connection (reuse existing code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vegetables_ecommerce";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID from session
$userId = $_SESSION['user_id'];

// Fetch cart items for the current user
$sql = "SELECT cart_id, description, amount, category FROM cart WHERE user_id = '$userId'";
$result = $conn->query($sql);

// Initialize total sum
$totalSum = 0;

// Check if cart has items
if ($result->num_rows > 0) {
    // Process the checkout (update database, generate order confirmation, etc.)
    // For simplicity, let's just delete the items from the cart table

    // Delete cart items
    $deleteSql = "DELETE FROM cart WHERE user_id = '$userId'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Checkout successful. Your order has been placed.";
    } else {
        echo "Error: " . $deleteSql . "<br>" . $conn->error;
    }

} else {
    // If cart is empty
    echo "Your cart is empty.";
}

// Close database connection
$conn->close();
?>
