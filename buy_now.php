<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect user to login page or handle authentication failure
    header("Location: index.php");
    exit();
}

// Retrieve product details from query parameters
if (isset($_GET['id']) && isset($_GET['description']) && isset($_GET['amount']) && isset($_GET['category'])) {
    $productId = $_GET['id'];
    $productDescription = $_GET['description'];
    $productAmount = $_GET['amount'];
    $productCategory = $_GET['category'];
} else {
    // Redirect or handle error if any parameter is missing
    header("Location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- PayPal SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AaOEB8gQ0GiyL3DJER-ZxfunlAke7ZN5PV5W7bRdJjmm2GiYxVTP7RO70DiVWHXGM6QuIzdXP1ovnQB8"></script>
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Buy Now</h2>
            <p>Product ID: <?php echo htmlspecialchars($productId); ?></p>
            <p>Description: <?php echo htmlspecialchars($productDescription); ?></p>
            <p>Amount: <?php echo htmlspecialchars($productAmount); ?></p>
            <p>Category: <?php echo htmlspecialchars($productCategory); ?></p>

            <!-- PayPal button container -->
            <div id="paypal-button-container"></div>
        </div>
    </div>
</div>

<!-- PayPal JavaScript SDK -->
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo htmlspecialchars($productAmount); ?>'
                    },
                    description: '<?php echo htmlspecialchars($productDescription); ?>'
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Redirect to purchase.php with necessary details
                window.location.href = 'purchase.php?orderID=' + data.orderID + '&productId=<?php echo htmlspecialchars($productId); ?>&description=<?php echo htmlspecialchars($productDescription); ?>&amount=<?php echo htmlspecialchars($productAmount); ?>&category=<?php echo htmlspecialchars($productCategory); ?>';
            });
        },
        onError: function (err) {
            console.error('PayPal Button Error:', err);
        }
    }).render('#paypal-button-container');
</script>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
