<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Fruits Found</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 110px; /* Adjust body padding to compensate for fixed navbar and sticky heading height */
        }

        .no-fruits-container {
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
        <div class="no-fruits-container">
            <div class="icon">
                <i class="fas fa-box-open"></i> <!-- Adjust icon as needed -->
            </div>
            <div class="message">
                No fruits found.
            </div>
            <div class="back-to-dashboard">
                <a href="admin_dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
