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

    // Fetch fruit details
    $sql_fetch = "SELECT `description` FROM `fruits` WHERE id='$fruit_id'";
    $result_fetch = $conn->query($sql_fetch);
    $row = $result_fetch->fetch_assoc();
    $description = $row['description'];

    // Close connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Fruit</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- HTML Modal for Confirmation Dialog -->
<div id="confirmDeleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the fruit record for "<?php echo $description; ?>"?</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> -->
                <a href="view_uploaded_fruits.php" class="btn btn-secondary">Cancel</a>
                <a href="delete_fruits_details.php?id=<?php echo $fruit_id; ?>" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript to show confirmation modal on page load -->
<script>
    $(document).ready(function(){
        $('#confirmDeleteModal').modal('show');
    });
</script>

</body>
</html>

<?php
} else {
    echo "Fruit ID not provided.";
}
?>
