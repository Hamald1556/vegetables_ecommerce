<?php
session_start();

 $host = "localhost"; 
$user = "expepxiz_penky"; 
$password = "Penky@1028";
$database = "expepxiz__21051012225"; 
$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a form input named 'amount'
    $amount_paid = $_POST["amount"];
    $customer_id = $_SESSION["CustomerID"]; // Fetch customer ID from session

    // Fetch total amount from the cart
    $total_amount_query = "SELECT SUM(products.Price * cart.Quantity) AS total FROM cart 
                           INNER JOIN products ON cart.ProductID = products.ProductID 
                           WHERE cart.CustomerID = $customer_id";

    $total_result = $conn->query($total_amount_query);
    $total_row = $total_result->fetch_assoc();
    $total_amount = $total_row['total'];

    // Compare the paid amount with the total amount
    if ($amount_paid == $total_amount) {

        // Redirect to PayPal for payment
        header("Location: https://www.paypal.com/36RGT9ZFDWU6Y");

        // Note: Replace YOUR_PAYPAL_TOKEN with the actual token obtained from PayPal API

        // Insert payment data into Payments table
        $insert_payment_query = "INSERT INTO Payments (PaymentDate, Amount, CustomerID, ProductID) 
                                VALUES (CURRENT_DATE, $amount_paid, $customer_id, 
                                (SELECT ProductID FROM cart WHERE CustomerID = $customer_id LIMIT 1))";
        $conn->query($insert_payment_query);

        // Update the payment status to 'paid'
        $update_payment_query = "UPDATE Payments SET Status = 'Paid' WHERE CustomerID = $customer_id";
        $conn->query($update_payment_query);

        echo "Payment successful ....your welcom . Thank you!";
    } else {
        echo "Amount paid does not match the total amount. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - E-commerce Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .payment-form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #4CAF50;
        }

        .back-btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007BFF;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="payment-form">
        <h2>Payment Details</h2>
        <form method="post">
            <label for="amount">Amount Paid:</label>
            <input type="number" id="amount" name="amount" required>

            <button type="submit">Submit Payment</button>
            <button class="back-btn" onclick="location.href='cart.php'" type="button">Back</button>
        </form>
    </div>

</body>

</html>
 -->
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #payment-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Set a maximum width */
            width: 100%;
            text-align: center;
        }

        .input-group {
            display: flex;
            flex-direction: column; /* Change to column on small screens */
            margin-bottom: 10px;
        }

        .input-group label,
        .input-group input {
            width: 100%; /* Full width on small screens */
        }

        input {
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px; /* Add margin for better spacing */
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        @media only screen and (min-width: 600px) {
            /* Add additional styles for larger screens if needed */
            .input-group {
                flex-direction: row;
            }

            .input-group label,
            .input-group input {
                width: 48%;
            }
        }
    </style>
    <script src="https://www.paypal.com/sdk/js?client-id=AaOEB8gQ0GiyL3DJER-ZxfunlAke7ZN5PV5W7bRdJjmm2GiYxVTP7RO70DiVWHXGM6QuIzdXP1ovnQB8"></script>
</head>
<body>

    <div id="payment-form">
        <h2>Payment Details</h2>

        <div class="input-group">
            <label for="card-number">Card Number:</label>
            <input type="text" id="card-number" placeholder="Enter card number" required>
        </div>

        <div class="input-group">
            <label for="expiry-date">Expiry Date:</label>
            <input type="text" id="expiry-date" placeholder="MM/YY" required>
        </div>

        <div class="input-group">
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" placeholder="Enter CVV" required>
        </div>

        <div class="input-group">
            <label for="amount">Amount:</label>
            <input type="text" id="amount" placeholder="Enter amount" required>
        </div>

        <button onclick="processPayment()">Make Payment</button>

        <div id="paypal-button-container"></div>

        <script>
            function processPayment() {
                const cardNumber = document.getElementById('card-number').value;
                const expiryDate = document.getElementById('expiry-date').value;
                const cvv = document.getElementById('cvv').value;
                const amount = document.getElementById('amount').value;

                if (validateCardDetails(cardNumber, expiryDate, cvv) && validateAmount(amount)) {
                    transferMoney();
                    alert("Payment successful!");
                } else {
                    alert("Invalid card details or amount. Please check and try again.");
                }
            }

            function validateCardDetails(cardNumber, expiryDate, cvv) {
                // Implement card validation logic here
                return true;
            }

            function validateAmount(amount) {
                // Implement amount validation logic here
                return !isNaN(parseFloat(amount)) && isFinite(amount) && parseFloat(amount) > 0;
            }

            function transferMoney() {
                console.log("Money transferred to business account.");
            }

            // Render the PayPal button
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: document.getElementById('amount').value || '10.00' // Default to 10.00 if no amount is provided
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Transaction completed by ' + details.payer.name.given_name);
                    });
                }
            }).render('#paypal-button-container');
        </script>
    </div>

</body>
</html>
