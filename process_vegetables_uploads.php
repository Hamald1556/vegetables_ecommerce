<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO vegetables (image, amount, description, uses, category) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $image, $amount, $description, $uses, $category);
    
    // File upload
    $targetDir = "vegetables/"; // Directory where images will be stored
    // $targetFile = $targetDir . basename($_FILES["vegetables-image"]["name"]);
    $targetFile = $targetDir . basename($_FILES["vegetable-image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    $image = $targetFile; // Store image path in database
    
    if (move_uploaded_file($_FILES["vegetable-image"]["tmp_name"], $targetFile)) {
        // File uploaded successfully
        // Get other form data
        $amount = $_POST['amount'];
        $description = $_POST['description'];
        $uses = $_POST['uses'];
        // $location = $_POST['location'];
        $category = $_POST['category'];
        
        // Insert data into database
        $stmt->execute();
        
        // Close statement and database connection
        $stmt->close();
        $conn->close();
        
        // Redirect to admin dashboard
        echo "<script>alert('Vegetable details uploaded successfully.'); window.location.href = 'upload_vegetables_page.php';</script>";
        exit; // Stop further execution
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
