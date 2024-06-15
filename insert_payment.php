

<?php
error_reporting(1);
session_start();

if (empty($_SESSION['CustomerID'])) {
    header("Location: Login.php");
    exit;
}

$customer_id = $_SESSION['CustomerID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture POST data
    $paymentID = isset($_POST['order_id']) ? $_POST['order_id'] : '';
    $total_price = isset($_POST['total_price']) ? $_POST['total_price'] : 0;
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 1;

    // Validate required fields
    if (empty($paymentID) || empty($total_price)) {
        echo "Payment ID and total price are required.";
        exit;
    }

    // Database connection details
      $host = "localhost"; 
    $user = "expepxiz_penky"; 
    $password = "Penky@1028";
    $database = "expepxiz__21051012225"; 

    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // Insert payment information into the transaction table
    $payment_date = date('Y-m-d');
    $insert_payment_sql = "INSERT INTO transaction (paymentID, paymentDate, amount, status_paid, customerid, productId) VALUES (?, ?, ?, 'SUCCESS PAID', ?, ?)";

    $stmt = $conn->prepare($insert_payment_sql);
    if ($stmt) {
        $stmt->bind_param("ssdii", $paymentID, $payment_date, $total_price, $customer_id, $product_id);
        if ($stmt->execute()) {
            echo "Payment information inserted successfully.";
        } else {
            echo "Error inserting payment information: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>


