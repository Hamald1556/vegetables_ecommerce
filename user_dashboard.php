<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id']; // Retrieve user ID from session
} else {
    // Redirect user to login page or handle authentication failure
    header("Location: login.php");
    exit();
}

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <style>
    .navbar-brand {
      margin-right: auto;
    }
    .navbar-nav .nav-link {
      padding-right: 20px;
    }
    .product-item {
      margin-bottom: 20px; /* Add space between each card */
      vertical-align: top;
    }
    .product-item img {
      max-width: 100%; /* Ensure images are responsive */
      height: auto;
    }
    .btn-round {
      border-radius: 30px; /* Adjust the border radius to make the buttons more or less round */
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" href="#">Best Commerce</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!-- Remove Home, About, and Contact links -->
    </ul>
    <div class="dropdown mr-3">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="categoriesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories
      </button>
      <div class="dropdown-menu" aria-labelledby="categoriesDropdown">
        <div class="dropdown-submenu">
          <a class="dropdown-item dropdown-toggle" href="#">Fruits</a>
          <div class="dropdown-menu">
            <?php
            // SQL query to fetch fruits categories
            $sql_fruits_categories = "SELECT DISTINCT `category` FROM `fruits`";
            $result_fruits_categories = $conn->query($sql_fruits_categories);

            if ($result_fruits_categories->num_rows > 0) {
                while($row_fruits_category = $result_fruits_categories->fetch_assoc()) {
                    echo "<a class='dropdown-item' href='#'>" . $row_fruits_category["category"] . "</a>";
                }
            }
            ?>
          </div>
        </div>
        <div class="dropdown-submenu">
          <a class="dropdown-item dropdown-toggle" href="#">Vegetables</a>
          <div class="dropdown-menu">
            <?php
            // SQL query to fetch vegetables categories
            $sql_vegetables_categories = "SELECT DISTINCT `category` FROM `vegetables`";
            $result_vegetables_categories = $conn->query($sql_vegetables_categories);

            if ($result_vegetables_categories->num_rows > 0) {
                while($row_vegetables_category = $result_vegetables_categories->fetch_assoc()) {
                    echo "<a class='dropdown-item' href='#'>" . $row_vegetables_category["category"] . "</a>";
                }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <form class="form-inline mr-3" id="searchForm">
      <input class="form-control mr-sm-2" type="search" id="searchInput" placeholder="Search" aria-label="Search">
    </form>
    <div class="dropdown">
      <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user"></i>
      </button>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="user_profile.php">User Profile</a>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#resetPasswordModal">Reset Password</a>
        <a class="dropdown-item" href="index.php">Log Out</a>
      </div>
    </div>
    <!-- Add Cart link with icon -->
    <a class="nav-link" href="view_cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
  </div>
</nav>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="resetPasswordForm">
          <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="resetPasswordForm" class="btn btn-primary">Reset Password</button>
      </div>
    </div>
  </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Product added to cart successfully!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- User Dashboard Content -->
<div class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <!-- Add a heading for the fruits details -->
      <h2><i class="fas fa-apple-alt"></i> Fruits Details</h2> <!-- Improved font awesome icon -->
      <div class="row">
        <!-- Display fruits details fetched from the database -->
        <?php
        // SQL query to fetch data from fruits table
        $sql_fruits = "SELECT `id`, `image`, `amount`, `description`, `uses`, `category` FROM `fruits`";
        $result_fruits = $conn->query($sql_fruits);

        if ($result_fruits->num_rows > 0) {
            while($row_fruits = $result_fruits->fetch_assoc()) {
                echo "<div class='col-md-2 product-item'>";
                echo "<div class='card'>";
                echo "<img src='" . $row_fruits["image"] . "' class='card-img-top' alt='Fruit Image' style='width: 100%; height: auto;'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row_fruits["description"] . "</h5>";
                echo "<p class='card-text'>Amount: " . $row_fruits["amount"] . "</p>";
                echo "<p class='card-text'>Uses: " . $row_fruits["uses"] . "</p>";
                echo "<p class='card-text'>Category: " . $row_fruits["category"] . "</p>";
                // Add "Add to Cart" button with icon (rounded)
                echo "<button class='btn btn-primary add-to-cart' data-product-id='" . $row_fruits["id"] . "' data-product-description='" . $row_fruits["description"] . "' data-product-amount='" . $row_fruits["amount"] . "' data-product-category='" . $row_fruits["category"] . "'><i class='fas fa-cart-plus'></i>Cart</button>";
                echo "<a href='buy_now.php?id=" . $row_fruits["id"] . "&description=" . urlencode($row_fruits["description"]) . "&amount=" . $row_fruits["amount"] . "&category=" . urlencode($row_fruits["category"]) . "' class='btn btn-success buy-now'><i class='fas fa-shopping-cart'></i> Buy Now</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No fruits found.";
        }
        ?>
      </div>

      <!-- Add a heading for the vegetables details -->
      <h2 class="mt-4"><i class="fas fa-carrot"></i> Vegetables Details</h2> <!-- Improved font awesome icon -->
      <div class="row">
        <!-- Display vegetables details fetched from the database -->
        <?php
        // SQL query to fetch data from vegetables table
        $sql_vegetables = "SELECT `id`, `image`, `amount`, `description`, `uses`, `category` FROM `vegetables`";
        $result_vegetables = $conn->query($sql_vegetables);

        if ($result_vegetables->num_rows > 0) {
            while($row_vegetables = $result_vegetables->fetch_assoc()) {
                echo "<div class='col-md-2 product-item'>";
                echo "<div class='card'>";
                echo "<img src='" . $row_vegetables["image"] . "' class='card-img-top' alt='Vegetable Image' style='width: 100%; height: auto;'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $row_vegetables["description"] . "</h5>";
                echo "<p class='card-text'>Amount: " . $row_vegetables["amount"] . "</p>";
                echo "<p class='card-text'>Uses: " . $row_vegetables["uses"] . "</p>";
                echo "<p class='card-text'>Category: " . $row_vegetables["category"] . "</p>";
                // Add "Add to Cart" button with icon (rounded)
                echo "<button class='btn btn-primary add-to-cart' data-product-id='" . $row_vegetables["id"] . "' data-product-description='" . $row_vegetables["description"] . "' data-product-amount='" . $row_vegetables["amount"] . "' data-product-category='" . $row_vegetables["category"] . "'><i class='fas fa-cart-plus'></i>Cart</button>";
                echo "<a href='buy_now.php?id=" . $row_vegetables["id"] . "&description=" . urlencode($row_vegetables["description"]) . "&amount=" . $row_vegetables["amount"] . "&category=" . urlencode($row_vegetables["category"]) . "' class='btn btn-success buy-now'><i class='fas fa-shopping-cart'></i> Buy Now</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No vegetables found.";
        }
        ?>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JavaScript for Dropdown Submenu, Real-time Search, and Success Modal -->
<script>
  $(document).ready(function(){
    // Enable dropdown-submenu functionality
    $('.dropdown-submenu a.dropdown-toggle').on("click", function(e){
      $(this).next('div').toggle();
      e.stopPropagation();
      e.preventDefault();
    });

    // Real-time search functionality
    $('#searchInput').on('input', function() {
      var searchQuery = $(this).val().toLowerCase();
      $('.product-item').each(function() {
        var fruitDescription = $(this).find('.card-title').text().toLowerCase();
        var vegetableDescription = $(this).find('.card-title').text().toLowerCase();
        if (fruitDescription.indexOf(searchQuery) !== -1 || vegetableDescription.indexOf(searchQuery) !== -1) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });

    // Handle click on "Add to Cart" buttons
    $('.add-to-cart').on('click', function() {
      var productId = $(this).data('product-id');
      var productDescription = $(this).data('product-description');
      var productAmount = $(this).data('product-amount');
      var productCategory = $(this).data('product-category');

      // Send product details to server using AJAX
      $.ajax({
        url: 'addToCart.php',
        method: 'POST',
        data: {
          productId: productId,
          productDescription: productDescription,
          productAmount: productAmount,
          productCategory: productCategory
        },
        success: function(response) {
          $('#successModal').modal('show'); // Show success modal
        },
        error: function(xhr, status, error) {
          console.error(error);
          alert('Error adding product to cart. Please try again.');
        }
      });
    });
  });
</script>
</body>
</html>
