

<!-- user_profile.php -->
<?php
session_start();

// Assuming you have a session variable storing user information after login
// Example: $_SESSION['user_id'] contains the ID of the logged-in user
// You'll need to replace this with your actual session variable
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Retrieve user ID from session

// Connect to your database (replace with your database connection details)
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

// Prepare a SQL statement to fetch user details based on user ID
$sql = "SELECT first_name, last_name, address, email, phone FROM users_registration WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // "i" indicates the type of parameter (integer)

// Execute the prepared statement
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $address = $row['address'];
    $email = $row['email'];
    $phone = $row['phone'];
    // Add more fields as needed
} else {
    echo "User not found";
}

$stmt->close(); // Close the prepared statement
$conn->close(); // Close the database connection
?>

<?php
// session_start();

// Check if profile was updated and display modal message
if (isset($_SESSION['profile_updated']) && $_SESSION['profile_updated'] == true) {
    echo '<div class="modal" tabindex="-1" role="dialog" id="profileUpdatedModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Profile Updated</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Your profile has been successfully updated.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>';

    // Unset the session variable
    unset($_SESSION['profile_updated']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- User Profile form -->
    <div class="container">
        <h1>User Profile</h1>
        <form action="update_profile.php" method="POST">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
            <!-- Button to go back to dashboard -->
            <a href="user_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
