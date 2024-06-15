<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

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
    $stmt = $conn->prepare("SELECT user_id, email, password, role FROM users_registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User exists, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, store user details in session
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_role'] = $row['role'];

            // Log login event
            logLogin($row['user_id'], $_SERVER['REMOTE_ADDR'], $conn);

            // Redirect based on user role
            if ($_SESSION['user_role'] == 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: user_dashboard.php");
                exit();
            }
        } else {
            // Password is incorrect
            $_SESSION['login_error'] = "Invalid email or password";
            header("Location: index.php");
            exit();
        }
    } else {
        // User does not exist
        $_SESSION['login_error'] = "Invalid email or password";
        header("Location: index.php");
        exit();
    }

    // Close connection
    $stmt->close();
    $conn->close();
}

// Function to log login event
function logLogin($userId, $ipAddress, $conn) {
    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO login_logs (user_id, ip_address) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $ipAddress);
    
    // Execute statement
    $stmt->execute();

    // Close statement
    $stmt->close();
}
?>
