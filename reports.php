<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Retrieve user ID from session
} else {
    // Redirect user to login page or handle authentication failure
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Upload Fruits</a></li>
            <li class="nav-item active"><a class="nav-link" href="#">Upload Vegetables</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Orders</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Logs</a></li>
            <li class="nav-item"><a class="nav-link" href="#">View Delivery</a></li>
            <li class="nav-item"><a class="nav-link" href="#">View Payment</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Reset Password</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4">Generate Reports</h2>
    <div class="row">
    <div class="col-md-4">
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title">Uploaded Vegetables</h5>
            <p class="card-text">Generate a report of all uploaded vegetables.</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportModal" data-report="vegetables">Generate Report</button>
        </div>
    </div>
</div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Uploaded Fruits</h5>
                    <p class="card-text">Generate a report of all uploaded fruits.</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportModal" data-report="fruits">Generate Report</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Customer Orders</h5>
                    <p class="card-text">Generate a report of all customer orders.</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportModal" data-report="orders">Generate Report</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Select Report Format</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Choose the format for the report:</p>
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-secondary" id="pdfReport">PDF</a>
                    <a href="#" class="btn btn-secondary" id="excelReport">Excel</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   $('#reportModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var reportType = button.data('report'); // Extract info from data-* attributes

    var modal = $(this);
    modal.find('.modal-title').text('Generate ' + reportType.charAt(0).toUpperCase() + reportType.slice(1) + ' Report');

    // Check if the reportType is 'vegetables' to set the correct URL
    if (reportType === 'vegetables') {
        // Set the base URL for the vegetables report
        var baseUrl = 'generate_vegetables_report.php?type=' + reportType + '&format=';
    } else if (reportType === 'fruits') {
        // Set the base URL for the fruits report
        var baseUrl = 'generate_fruits_report.php?type=' + reportType + '&format=';
    } else {
        // For other report types, use the default URL
        var baseUrl = 'generate_report.php?type=' + reportType + '&format=';
    }

    modal.find('#pdfReport').attr('href', baseUrl + 'pdf');
    modal.find('#excelReport').attr('href', baseUrl + 'excel');
});

</script>

</body>
</html>
