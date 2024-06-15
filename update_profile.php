<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user ID from session
    $user_id = $_SESSION['user_id'];

    // Connect to your database (replace with your database connection details)
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

    // Prepare SQL statement to update user profile
    $sql = "UPDATE users_registration SET first_name=?, last_name=?, address=?, email=?, phone=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $first_name, $last_name, $address, $email, $phone, $user_id); // "sssssi" indicates types of parameters (string, string, string, string, string, integer)

    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Profile updated successfully, set session variable
        $_SESSION['profile_updated'] = true;
        // Redirect to user profile page
        header("Location: user_profile.php");
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $stmt->close(); // Close the prepared statement
    $conn->close(); // Close the database connection
} else {
    // If the request method is not POST, redirect to the user profile page
    header("Location: user_profile.php");
}
?>
