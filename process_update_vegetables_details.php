<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if(isset($_POST['description']) && isset($_POST['amount']) && isset($_POST['uses']) && isset($_POST['category'])) {
        // Sanitize inputs to prevent SQL injection
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $uses = $_POST['uses'];
        $category = $_POST['category'];

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

            // SQL query to update fruit details
            $sql = "UPDATE vegetables SET description='$description', amount='$amount', uses='$uses', category='$category' WHERE id='$fruit_id'";

            if ($conn->query($sql) === TRUE) {
                // Redirect to fruits_success_update.php with success message
                header("Location: vegetables_success_update.php?success=1");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }

            // Close connection
            $conn->close();
        } else {
            echo "Fruit ID not provided.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
