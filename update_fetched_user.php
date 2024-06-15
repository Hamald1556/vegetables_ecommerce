<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User Details</title>
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
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="admin_dashboard.php">Back to Dashboard</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Update User Details</div>
        <div class="card-body">
          <?php
          // Check if user_id parameter is provided
          if(isset($_GET['id'])) {
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

              // Escape user_id to prevent SQL injection
              $user_id = $conn->real_escape_string($_GET['id']);

              // Query to fetch user details based on user_id
              $sql = "SELECT user_id, first_name, last_name, address, email, phone, role FROM users_registration WHERE user_id = '$user_id'";
              $result = $conn->query($sql);

              // Check if user exists
              if ($result && $result->num_rows > 0) {
                  // Fetch user details
                  $user = $result->fetch_assoc();
                  ?>
                  <form action="update_user.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <div class="form-group">
                      <label for="first_name">First Name</label>
                      <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="last_name">Last Name</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="role">Role</label>
                      <input type="text" class="form-control" id="role" name="role" value="<?php echo $user['role']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                  </form>
                  <?php
              } else {
                  echo "<p class='text-danger'>User not found.</p>";
              }

              $conn->close();
          } else {
              echo "<p class='text-danger'>User ID not provided.</p>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

</body>
</html>
