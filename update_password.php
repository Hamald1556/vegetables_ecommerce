<?php
// Prevent direct access to this file
// if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
//     include('redirect.php');
//     exit;
// }

// Your PHP code goes here
?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        $_SESSION['reset_error'] = "Passwords do not match";
        header("Location: reset_password.php");
        exit();
    }

    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Retrieve user ID from session
    $user_id = $_SESSION['user_id'];

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
    $stmt = $conn->prepare("UPDATE users_registration SET password = ? WHERE user_id = ?");
    $stmt->bind_param("si", $hashedPassword, $user_id);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        $_SESSION['reset_success'] = "Password updated successfully";
    } else {
        $_SESSION['reset_error'] = "Failed to update password";
    }

    // Close connection
    $stmt->close();
    $conn->close();

    // Redirect back to user profile page
    header("Location: user_dashboard.php");
    exit();
}
?>
