<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <form method="POST" action="login_php_script.php" id="loginForm">
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
              <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
              <div class="invalid-feedback"></div>
              <?php
                session_start(); // Start the session
                if(isset($_SESSION['login_error'])) {
                    echo '<div class="text-danger">' . $_SESSION['login_error'] . '</div>'; // Display login error if set
                    unset($_SESSION['login_error']); // Clear login error from session
                }
              ?>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
          <div class="mt-3">
            <p>If you don't have an account, <a href="registration.php">register here</a>.</p>
            <p><a href="forgot_password.php">Forgot your password?</a></p>
          </div>
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
  // JavaScript form validation
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      var form = document.getElementById('loginForm');
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
        var emailField = document.getElementById('email');
        var passwordField = document.getElementById('password');
        if (!emailField.checkValidity()) {
          emailField.classList.add('is-invalid');
          emailField.nextElementSibling.textContent = emailField.validationMessage;
        }
        if (!passwordField.checkValidity()) {
          passwordField.classList.add('is-invalid');
          passwordField.nextElementSibling.textContent = passwordField.validationMessage;
        }
      }, false);
    }, false);
  })();
</script>
</body>
</html>
