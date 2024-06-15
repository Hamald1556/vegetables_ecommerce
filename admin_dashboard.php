<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <style>
    /* Content area */
    .content {
      padding: 20px;
    }

    /* Grid layout */
    .grid-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    /* Grid item */
    .grid-item {
      background-color: #f8f9fa;
      border: 1px solid #dee2e6;
      padding: 20px;
      text-align: center;
    }

    /* Icon size */
    .grid-item i {
      font-size: 48px;
      margin-bottom: 10px;
      color: #343a40; /* dark color for icons */
    }

    /* Link color */
    .grid-item a {
      color: #343a40;
      text-decoration: none;
    }

    /* Hover effect */
    .grid-item:hover {
      background-color: #e9ecef;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Admin Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Manage Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view_uploaded_fruits.php">View-Uploaded-Fruits</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view_uploaded_vegetables.php">View-Uploaded-Vegetables</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="order.php">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Reports</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Logs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">View Delivery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">View Payment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Reset Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Modal Confirmation Message -->
<div class="modal fade" id="sessionTimeoutModal" tabindex="-1" role="dialog" aria-labelledby="sessionTimeoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sessionTimeoutModalLabel">Session Timeout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Your session is about to expire due to inactivity. Do you want to continue?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="sessionTimeoutContinue">Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- Content area -->
<div class="content">
  <div class="grid-container">
    <!-- Manage Users -->
    <div class="grid-item">
      <a href="fetch_user_registered.php">
        <i class="fas fa-users"></i>
        <div>Manage Users</div>
      </a>
    </div>
    <!-- Upload Fruits -->
    <div class="grid-item">
      <a href="upload_fruits_page.php">
        <i class="fas fa-upload"></i>
        <div>Upload Fruits</div>
      </a>
    </div>
    <!-- Upload Vegetables -->
    <div class="grid-item">
      <a href="upload_vegetables_page.php">
        <i class="fas fa-upload"></i>
        <div>Upload Vegetables</div>
      </a>
    </div>
    <!-- Orders -->
    <div class="grid-item">
      <a href="order.php">
        <i class="fas fa-shopping-cart"></i>
        <div>Orders</div>
      </a>
    </div>
    <!-- Reports -->
    <div class="grid-item">
      <a href="reports.php">
        <i class="fas fa-chart-bar"></i>
        <div>Reports</div>
      </a>
    </div>
    <!-- Logs -->
    <div class="grid-item">
      <a href="logs.php">
        <i class="fas fa-clipboard"></i>
        <div>Logs</div>
      </a>
    </div>
    <!-- View Delivery -->
    <div class="grid-item">
      <a href="">
        <i class="fas fa-truck"></i>
        <div>View Delivery</div>
      </a>
    </div>
    <!-- View Payment -->
    <div class="grid-item">
      <a href="">
        <i class="fas fa-money-bill-wave"></i>
        <div>View Payment</div>
      </a>
    </div>
    <!-- Reset Password -->
    <div class="grid-item">
      <a href="admin_reset_password.php">
        <i class="fas fa-key"></i>
        <div>Reset Password</div>
      </a>
    </div>
    <!-- Logout -->
    <div class="grid-item">
      <a href="logout.php">
        <i class="fas fa-sign-out-alt"></i>
        <div>Logout</div>
      </a>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your footer scripts -->
<script>
// Track user activity
var inactivityTime = 10; // In seconds, adjust as needed
var warningTime = 5; // Show modal warning after this time

var inactivityTimer;
var warningTimer;

function resetTimers() {
  clearTimeout(inactivityTimer);
  clearTimeout(warningTimer);
  startInactivityTimer();
}

function startInactivityTimer() {
  inactivityTimer = setTimeout(function() {
    // Show modal warning
    $('#sessionTimeoutModal').modal('show');

    // Start countdown
    startWarningTimer();
  }, inactivityTime * 10000);
}

function startWarningTimer() {
  var remainingTime = (warningTime - 1) * 10000;
  warningTimer = setInterval(function() {
    $('#sessionTimeoutModal .modal-body').text('Your session is about to expire due to inactivity. Do you want to continue? ' + (remainingTime / 10000) + ' seconds remaining.');
    remainingTime -= 10000;
    if (remainingTime < 0) {
      clearInterval(warningTimer);
      logout();
    }
  }, 10000);
}

// Continue session
$('#sessionTimeoutContinue').click(function() {
  resetTimers();
  $('#sessionTimeoutModal').modal('hide');
});

// Logout function (redirect to index)
function logout() {
  window.location.href = 'index.php'; // Adjust the URL to your index page
}

// Start timers on page load
$(document).ready(function() {
  resetTimers();
});

// Reset timers on user activity
$(document).mousemove(resetTimers);
$(document).keypress(resetTimers);
</script>
<script>
$(document).ready(function() {
    // Continue session
    $('#sessionTimeoutContinue').click(function() {
        resetTimers();
        $('#sessionTimeoutModal').modal('hide');
    });

    // Logout function (redirect to index)
    function logout() {
        window.location.href = 'index.php'; // Adjust the URL to your index page
    }

    // No button click event handler
    $('#sessionTimeoutModal button[data-dismiss="modal"]').click(function() {
        logout(); // Logout when user clicks "No"
    });

    // Track user activity
    var inactivityTime = 10; // In seconds, adjust as needed
    var inactivityTimer;

    function resetTimers() {
        clearTimeout(inactivityTimer);
        startInactivityTimer();
    }

    function startInactivityTimer() {
        inactivityTimer = setTimeout(function() {
            // Show modal warning
            $('#sessionTimeoutModal').modal('show');
        }, inactivityTime * 10000);
    }

    // Start timers on page load
    resetTimers();

    // Reset timers on user activity
    $(document).mousemove(resetTimers);
    $(document).keypress(resetTimers);
});
</script>

</body>
</html>
