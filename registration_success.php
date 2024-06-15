<?php
// // Prevent direct access to this file
// if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
//     include('redirect.php');
//     exit;
// }

// // Your PHP code goes here
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Successful</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Registration Successful
        </div>
        <div class="card-body">
          <p>Your registration has been successful!</p>
          <button type="button" class="btn btn-primary" onclick="redirectToDashboard()">Let's Get Started</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  function redirectToDashboard() {
    // Redirect to dashboard page
    window.location.href = "index.php";
  }
</script>
</body>
</html>
