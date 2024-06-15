<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <?php
      // Check if form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Check if user_id is provided
          if(isset($_POST['user_id'])) {
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
              $user_id = $conn->real_escape_string($_POST['user_id']);

              // Escape other form inputs
              $first_name = $conn->real_escape_string($_POST['first_name']);
              $last_name = $conn->real_escape_string($_POST['last_name']);
              $address = $conn->real_escape_string($_POST['address']);
              $email = $conn->real_escape_string($_POST['email']);
              $phone = $conn->real_escape_string($_POST['phone']);
              $role = $conn->real_escape_string($_POST['role']);

              // SQL query to update user details
              $sql = "UPDATE users_registration SET first_name='$first_name', last_name='$last_name', address='$address', email='$email', phone='$phone', role='$role' WHERE user_id='$user_id'";

              if ($conn->query($sql) === TRUE) {
                  // Display success notification
                  echo '<div class="alert alert-success" role="alert">
                          User details updated successfully.
                        </div>';
                  // Redirect to admin dashboard after 2 seconds
                  header("refresh:2;url=admin_dashboard.php");
              } else {
                  // Display error notification
                  echo '<div class="alert alert-danger" role="alert">
                          Error updating user details: ' . $conn->error . '
                        </div>';
              }

              $conn->close();
          } else {
              echo '<div class="alert alert-danger" role="alert">
                      User ID not provided.
                    </div>';
          }
      } else {
          echo '<div class="alert alert-danger" role="alert">
                  Invalid request.
                </div>';
      }
      ?>
    </div>
  </div>
</div>

</body>
</html>
