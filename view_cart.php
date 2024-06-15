<?php
// Start session (if not already started)
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    // Redirect user to login page if not logged in
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

// Retrieve user ID from session
$userId = $_SESSION['user_id'];

// Fetch cart items for the current user
$sql = "SELECT cart_id, description, amount, category FROM cart WHERE user_id = '$userId'";
$result = $conn->query($sql);

// Initialize total sum
$totalSum = 0;

// Check if cart has items
if ($result->num_rows > 0) {
    // Display cart items
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Cart</title>
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" href="user_dashboard.php">Best Commerce</a>
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
  </div>
</nav>

        <div class="container mt-4">
            <h2>Cart Items</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $totalSum += $row["amount"]; // Update total sum
                        ?>
                        <tr>
                            <td><?php echo $row["description"]; ?></td>
                            <td><?php echo $row["amount"]; ?></td>
                            <td><?php echo $row["category"]; ?></td>
                            <td>
                                <form action="delete_cart_item.php" method="post"> <!-- Assuming delete_item.php handles item deletion -->
                                    <input type="hidden" name="cart_id" value="<?php echo $row["cart_id"]; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <p>Total: $<?php echo $totalSum; ?></p>
            <form action="checkout.php" method="post"> <!-- Assuming checkout.php handles checkout process -->
                <button type="submit" class="btn btn-primary">Buy Now</button>
            </form>
        </div>
    </body>
    </html>
    <?php
} else {
    // If cart is empty
    // echo "Your cart is empty.";
    header("location: empty_cart.php");
}

// Close database connection
$conn->close();
?>
