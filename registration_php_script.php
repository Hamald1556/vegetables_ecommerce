<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

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

    // Check if email is already registered
    $stmt = $conn->prepare("SELECT * FROM users_registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, display error and redirect back to registration page
        echo "<script>alert('Email address is already in use'); window.location.href = 'registration.php';</script>";
        exit; // Stop further execution
    } else {
        // Email is available, proceed with registration
        // Prepare and bind statement
        $stmt = $conn->prepare("INSERT INTO users_registration (first_name, last_name, address, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstname, $lastname, $address, $email, $phone, $hash);

        // Execute statement
        if ($stmt->execute() === TRUE) {
            // Redirect to success page
            header("Location: registration_success.php");
            exit;
        } else {
            echo "Error: " . $stmt->error; // Display error message
        }
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
