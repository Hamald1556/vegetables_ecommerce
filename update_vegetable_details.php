<?php
// Check if fruit_id is provided
if(isset($_GET['id'])) {
    $fruit_id = $_GET['id'];

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

    // SQL query to fetch fruit details
    $sql = "SELECT `id`, `image`, `amount`, `description`, `uses`, `category` FROM `vegetables` WHERE id = $fruit_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch fruit details
    } else {
        echo "No fruit found.";
        exit(); // Exit if no fruit found
    }

    // Close connection
    $conn->close();
} else {
    echo "Fruit ID not provided.";
    exit(); // Exit if fruit ID not provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Fruit Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Best Commerce</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="admin_dashboard.php">Back to Dashboard</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Update Fruit Details</h2>
    <!-- <form action="process_update_fruits_details.php" method="POST"> -->
    <form action="process_update_vegetables_details.php?id=<?php echo $fruit_id; ?>" method="POST">
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $row['description']; ?>">
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $row['amount']; ?>">
        </div>
        <div class="form-group">
            <label for="uses">Uses</label>
            <input type="text" class="form-control" id="uses" name="uses" value="<?php echo $row['uses']; ?>">
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" name="category" value="<?php echo $row['category']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

</body>
</html>
