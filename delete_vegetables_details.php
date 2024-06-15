<?php
// Check if fruit ID is provided
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

    // SQL query to delete fruit details
    $sql = "DELETE FROM vegetables WHERE id='$fruit_id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the view page with success message
        header("Location: view_uploaded_vegetables.php?success=1");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    echo "Fruit ID not provided.";
}
?>
