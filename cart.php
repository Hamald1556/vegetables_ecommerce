<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View policy</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .cart-item {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        .checkout-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
        }

        .remove-btn {
            background-color: #FF0000; /* Red color for remove button */
            color: white;
            padding: 8px;
            text-decoration: none;
            display: inline-block;
            margin-top: 5px;
            cursor: pointer;
        }

        .checkout-section {
            margin-top: 20px;
        }

        /* Add green color style for payment link */
        .payment-link {
            background-color: #00FF00; /* Green color for payment link */
            color: white;
            padding: 10px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
        }

    </style>
</head>

<body>
    <script src="https://www.paypal.com/sdk/js?client-id=AaeraJuJ8R3BuJwI69SnSklcn6wQTxceijE1x9qEgWLYqo9NUB9nKe4wq_Z0s1OevoQoATDJdvnZbLgw"></script>
    <h1>Your Policy To Pay Using PayPal</h1>

    <?php
    session_start();
    error_reporting(1);
    $cart=$_SESSION['CustomerID'];
    // Connect to your database (replace these variables with your actual database credentials)
   
    // Connect to the database
    $host = "localhost"; 
    $user = "expepxiz_penky"; 
    $password = "Penky@1028";
    $database = "expepxiz__21051012225"; 

    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle removing from cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['remove_from_cart'])) {
            $cart_id = $_POST['cart_id'];

            // Remove from cart table
            $delete_sql = "DELETE FROM cart WHERE CartID = $cart_id";
            $conn->query($delete_sql);
        }
    }

    // Fetch data from the cart table based on the customer ID (Assuming customer ID is 1 for simplicity)
    $customer_id = $cart;

    $cart_sql = "SELECT cart.CartID, products.ProductName, products.Price, cart.Quantity FROM cart 
                 INNER JOIN products ON cart.ProductID = products.ProductID 
                 WHERE cart.CustomerID = $cart";

    $cart_result = $conn->query($cart_sql);

    // Display cart items and calculate total price
    $total_price = 0;

    if ($cart_result->num_rows > 0) {
        while ($cart_row = $cart_result->fetch_assoc()) {
            $subtotal = $cart_row['Price'] * $cart_row['Quantity'];
            $total_price += $subtotal;

            echo '<div class="cart-item">';
            echo '<h2>' . $cart_row['ProductName'] . '</h2>';
            echo '<p>Price: $' . $cart_row['Price'] . '</p>';
            echo '<p>Quantity: ' . $cart_row['Quantity'] . '</p>';
            echo '<p>Subtotal: $' . $subtotal . '</p>';
            echo '<form action="" method="post">';
            echo '<input type="hidden" name="cart_id" value="' . $cart_row['CartID'] . '">';
            echo '<button type="submit" class="remove-btn" name="remove_from_cart">Remove from policy</button>';
            echo '</form>';
            echo '</div>';
        }

        echo '<h3>Total Price: $' . $total_price . '</h3>';
        ?>
        <div class="container mt-3 mb-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="panel-body">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "Your policy is empty";
    }

    $conn->close();
    ?>

</body>

</html>
<script src="app.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/tiny-slider.js"></script>
<script src="js/custom.js"></script>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $total_price; ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Capture the funds from the transaction

                // Insert payment information into the Payments table
                var formData= new FormData();
                var xhr = new XMLHttpRequest();

                formData.append("order_id", details.id);
                formData.append("total_price", details.purchase_units[0].amount.value);
                formData.append("customer_id", "<?php echo $customer_id; ?>");
                fetch("insert_payment.php", {
                    method: "POST",
                    body: formData
                }).then(response => {
                    if (response.ok) {
                        window.location.href = "success.php";
                    } else {
                        console.error("Failed to save transaction");
                    }
                })
                .catch(error => {
                    console.error("ERROR WHILE FATCH PAYPAL API");
                });
                // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                // xhr.onreadystatechange = function() {
                //     if (xhr.readyState == 4 && xhr.status == 200) {
                //         console.log(xhr.responseText);
                //         // Redirect or perform any necessary actions on successful payment
                //         //  // Replace with your success page
                //     }
                // };
                // xhr.send("total_price=<?php echo $total_price; ?>&=");

            });
        }
        // onError: function(err) {
        //     // Handle errors
        //     console.error(err);
        // }
    }).render('#paypal-button-container');
</script>
