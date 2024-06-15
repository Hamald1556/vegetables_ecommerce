<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php
            // Check if user_id is provided
            if(isset($_GET['id'])) {
                $user_id = $_GET['id'];
            ?>
            <div class="alert alert-danger" role="alert">
                <strong>Warning!</strong> Are you sure you want to delete this user? This action cannot be undone.
                <br>
                <div class="text-center mt-3">
                    <a href="delete_user.php?id=<?php echo $user_id; ?>" class="btn btn-danger">Delete</a>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                </div>
            </div>
            <?php
            } else {
                echo '<div class="alert alert-danger" role="alert">
                          User ID not provided.
                        </div>';
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
