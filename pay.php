<?php
 $host = "localhost"; 
$user = "expepxiz_penky"; 
$password = "Penky@1028";
$database = "expepxiz__21051012225"; 

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the delete button is clicked
if (isset($_POST['delete'])) {
    $paymentIdToDelete = $_POST['delete'];
    
    // SQL query to delete payment by PaymentID
    $deleteQuery = "DELETE FROM transaction WHERE paymentID = $paymentIdToDelete";
    
    if ($conn->query($deleteQuery) === TRUE) {
        echo "Payment deleted successfully.";
    } else {
        echo "Error deleting payment: " . $conn->error;
    }
}

// Fetch data from Payments table
$payments_query = "SELECT * FROM transaction";
$payments_result = $conn->query($payments_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History - In a Database</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            background-color: #f4f4f4;
        }

        .payment-history {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        .delete-btn {
            background-color: #FF0000;
            color: #fff;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
        }

        .go-back-btn {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="payment-history">
        <h2>Payment History</h2>
        <table>
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                    <th>Customer ID</th>
                    <th>Product ID</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($payments_result->num_rows > 0) {
                    while ($row = $payments_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["paymentID"] . "</td>";
                        echo "<td>" . $row["paymentDate"] . "</td>";
                        echo "<td>" . $row["amount"] . "</td>";
                        echo "<td>" . $row["CustomerID"] . "</td>";
                        echo "<td>" . $row["ProductID"] . "</td>";
                        echo "<td>" . $row["status_paid"] . "</td>";
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<button class='delete-btn' type='submit' name='delete' value='" . $row["paymentID"] . "'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No payments found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="Admin.php" class="go-back-btn">Go Back</a>
    </div>

</body>

</html>
