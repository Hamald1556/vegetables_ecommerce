<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit;
}

// Fetch user details from the database based on user ID
$userId = $_SESSION['user_id'];

// Database connection
$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "vegetables_ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind statement
$stmt = $conn->prepare("SELECT * FROM users_registration WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    // Fetch user details
    $userDetails = $result->fetch_assoc();
    
    // Display user details
    echo "<p>First Name: " . $userDetails['first_name'] . "</p>";
    echo "<p>Last Name: " . $userDetails['last_name'] . "</p>";
    echo "<p>Email: " . $userDetails['email'] . "</p>";
    echo "<p>Address: " . $userDetails['address'] . "</p>";
    echo "<p>Phone: " . $userDetails['phone'] . "</p>";
} else {
    echo "User not found.";
}

// Close connection
$stmt->close();
$conn->close();
?>
