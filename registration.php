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
  <title>Registration Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .error-message {
      color: red;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Registration
        </div>
        <div class="card-body">
          <form id="registrationForm" method="POST" action="registration_php_script.php" novalidate>
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="firstname" required>
              <div class="error-message"></div>
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control" id="lastname" placeholder="Enter last name" name="lastname" required>
              <div class="error-message"></div>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" required>
              <div class="error-message"></div>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
              <div class="error-message"></div>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="tel" class="form-control" id="phone" placeholder="Enter phone number" name="phone" required>
              <div class="error-message"></div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
              <div class="error-message"></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
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
  // Custom form validation using JavaScript
  $(document).ready(function() {
    $('#registrationForm').submit(function(e) {
      $('.error-message').text(''); // Clear previous error messages
      
      // Perform validation for each input field
      var isValid = true;
      
      if ($('#firstname').val().trim() === '') {
        $('#firstname').next('.error-message').text('First name is required');
        isValid = false;
      }
      
      if ($('#lastname').val().trim() === '') {
        $('#lastname').next('.error-message').text('Last name is required');
        isValid = false;
      }
      
      if ($('#address').val().trim() === '') {
        $('#address').next('.error-message').text('Address is required');
        isValid = false;
      }
      
      if ($('#email').val().trim() === '') {
        $('#email').next('.error-message').text('Email address is required');
        isValid = false;
      }
      
      if ($('#phone').val().trim() === '') {
        $('#phone').next('.error-message').text('Phone number is required');
        isValid = false;
      }
      
      if ($('#password').val().trim() === '') {
        $('#password').next('.error-message').text('Password is required');
        isValid = false;
      }
      
      if (!isValid) {
        e.preventDefault(); // Prevent form submission if validation fails
      }
    });
  });
</script>
</body>
</html>
