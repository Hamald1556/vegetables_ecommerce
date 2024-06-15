<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Vegetables Details</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Upload Fruits</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Upload Vegetables</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Reports</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Logs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">View Delivery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">View Payment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Reset Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Logout</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Content area -->
<div class="container">
  <div class="row justify-content-center mt-5">
    <!-- Upload vegetables form -->
    <div id="upload-vegetables-form" class="col-md-8">
      <h2 class="text-center mb-4">Upload Vegetables Details</h2>
      <form id="vegetables-upload-form" enctype="multipart/form-data" method="post" action="process_vegetables_uploads.php">
        <div class="form-group">
          <label for="vegetable-image">Image:</label>
          <!-- <input type="file" class="form-control-file" id="vegetable-image" name="vegetable-image"> -->
          <input type="file" class="form-control-file" id="vegetable-image" name="vegetable-image">
        </div>
        <div class="form-row">
          <div class="col">
            <label for="amount">Amount:</label>
            <input type="text" class="form-control" id="amount" name="amount">
          </div>
          <div class="col">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" name="description">
          </div>
        </div>
        <div class="form-row mt-3">
          <div class="col">
            <label for="uses">Uses:</label>
            <input type="text" class="form-control" id="uses" name="uses">
          </div>
          <!-- <div class="col">
            <label for="location">Location:</label>
            <input type="text" class="form-control" id="location" name="location">
          </div> -->
        </div>
        <div class="form-group mt-3">
          <label for="category">Category:</label>
          <select class="form-control" id="category" name="category">
            <option value="fruits">Fruits</option>
            <option value="vegetables">Vegetables</option>
            <!-- Add more options as needed -->
          </select>
        </div>
        <div class="form-group mt-4">
          <button type="submit" class="btn btn-primary btn-block">Upload</button>
        </div>
      </form>
      <!-- Add View Vegetables Uploaded button -->
      <div class="mt-3 text-center">
        <a href="view_uploaded_vegetables.php" class="btn btn-secondary">View Vegetables Uploaded</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
