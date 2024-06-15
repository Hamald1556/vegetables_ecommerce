<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vegetables_ecommerce";

// Check if user_id is provided
if(isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to delete user from users_registration table
    $sql = "DELETE FROM users_registration WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to admin dashboard upon successful deletion
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "User ID not provided.";
}
?>
