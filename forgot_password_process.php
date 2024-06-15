<?php
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

if (isset($_POST['submit'])) {
    // Recieve the values inserted in the reset page and remove special characters
    $email = strtolower(mysqli_real_escape_string($conn, stripslashes(htmlentities(strip_tags(trim($_POST['email']))))));

    $code = random_int(1000, 9999);
    $hash = password_hash($code, PASSWORD_DEFAULT);

    // Check if email exists in the database
    $select = "SELECT * FROM users_registration WHERE email='$email'";
    if ($sql = mysqli_query($conn, $select)) {
        if (mysqli_num_rows($sql) == 1) {
            while ($row = mysqli_fetch_array($sql)) {
                $mail = $row['email'];

                require('mailer.php');

                $query = "UPDATE users_registration SET password='$hash' WHERE email='$email'";
                if (mysqli_query($conn, $query)) {
                     header("location: email_sent_message.php");
                    exit();
                } else {
                    $message = "Dear Mr/Mrs. Failed to connect to the database.";
                    header("Location: reset-password.php?message=$message");
                    exit();
                }
            }
        } else {
            header("location: email_not_found.php");
            exit();
        }
    }
}
?>