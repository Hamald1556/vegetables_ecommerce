<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page or handle authentication failure
    header("Location: index.php");
    exit();
}

// Check if orderID and other details are present
if (isset($_GET['orderID']) && isset($_GET['productId']) && isset($_GET['description']) && isset($_GET['amount']) && isset($_GET['category'])) {
    $orderID = $_GET['orderID'];
    $productId = $_GET['productId'];
    $productDescription = $_GET['description'];
    $productAmount = $_GET['amount'];
    $productCategory = $_GET['category'];
    $userId = $_SESSION['user_id'];

    // Database connection (Update with your own database credentials)
    $host = 'localhost';
    $db = 'vegetables_ecommerce';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);

        // Insert payment details into the payment table
        $stmt = $pdo->prepare("INSERT INTO payment (product_id, user_id, order_id, amount, time, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$productId, $userId, $orderID, $productAmount, date('Y-m-d H:i:s'), 'Completed']);

        // Display success message with a link to user_dashboard page
        echo "<div style='text-align: center; margin-top: 50px;'>
                <i class='fas fa-check-circle' style='color: green; font-size: 100px;'></i>
                <h2>Payment Successful</h2>
                <p>Thank you for your purchase!</p>
                <a href='user_dashboard.php' style='text-decoration: none; color: blue;'>Go to User Dashboard</a>
              </div>";
    } catch (PDOException $e) {
        echo 'Database Error: ' . $e->getMessage();
    }
} else {
    // Handle missing parameters
    header("Location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
</body>
</html>
