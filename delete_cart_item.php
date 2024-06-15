<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if cart_id is set and not empty
if(isset($_POST['cart_id']) && !empty($_POST['cart_id'])) {
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

    // Retrieve cart_id from the form
    $cartId = $_POST['cart_id'];

    // Delete item from the cart
    $sql = "DELETE FROM cart WHERE cart_id = '$cartId'";
    if ($conn->query($sql) === TRUE) {
        // Item deleted successfully, redirect back to cart page
        header("Location: view_cart.php");
    } else {
        echo "Error deleting item: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // If cart_id is not set or empty, redirect back to cart page
    header("Location: view_cart.php");
}
?>
