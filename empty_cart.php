<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empty Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .empty-cart-container {
            text-align: center;
            margin-top: 50px;
        }
        .icon {
            font-size: 100px;
            color: #adb5bd; /* Adjust color as needed */
        }
        .message {
            margin-top: 20px;
            font-size: 24px;
            color: #6c757d; /* Adjust color as needed */
        }
        .back-to-dashboard {
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="empty-cart-container">
            <div class="icon">
                <i class="fas fa-shopping-cart"></i> <!-- Adjust icon as needed -->
            </div>
            <div class="message">
                Your cart is empty.
            </div>
            <div class="back-to-dashboard">
                <a href="user_dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
