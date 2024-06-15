<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Details</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    /* Add your custom CSS styles here */
  </style>
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="fetch_user_registered.php">Manage Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="upload_fruits.php">Upload Fruits</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="upload_vegetables.php">Upload Vegetables</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="orders.php">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reports.php">Reports</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logs.php">Logs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view_delivery.php">View Delivery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view_payment.php">View Payment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reset_password.php">Reset Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>

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

// Query to fetch user details excluding admins
$sql = "SELECT user_id, first_name, last_name, address, email, phone FROM users_registration WHERE role != 'admin'";
$result = $conn->query($sql);

// Check if there are users
if ($result && $result->num_rows > 0) {
    echo "<div class='container'>";
    echo "<h2>User Details</h2>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>Address</th>";
    echo "<th>Email</th>";
    echo "<th>Phone</th>";
    echo "<th>Update</th>";
    echo "<th>Delete</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td><a href='update_fetched_user.php?id=" . $row["user_id"] . "' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></a></td>";
        echo "<td><a href='delete_fetched_user.php?id=" . $row["user_id"] . "' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></a></td>";
        echo "</tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
} else {
    // echo "<p>No users found.</p>";
    header("location: no_user.php");
}

$conn->close();
?>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
