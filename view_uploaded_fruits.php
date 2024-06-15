<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Uploaded Fruits</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 110px; /* Adjust body padding to compensate for fixed navbar and sticky heading height */
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">Best Commerce</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="admin_dashboard.php">Back to Dashboard</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="d-flex justify-content-center">
    <div class="w-100">
      <div class="container-fluid sticky-top bg-light">
        <h2 class="text-center mt-4">View Uploaded Fruits</h2>
        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
      </div>
      <?php
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

      // SQL query to fetch data from fruits table
      $sql = "SELECT `id`, `image`, `amount`, `description`, `uses`,`category` FROM `fruits`";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<div class='table-responsive'>";
        echo "<table id='fruitTable' class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Description</th>";
        echo "<th>Amount</th>";
        echo "<th>Uses</th>";
        // echo "<th>Location</th>";
        echo "<th>Category</th>";
        echo "<th>Image</th>";
        echo "<th>Update</th>"; // Add Update column header
        echo "<th>Delete</th>"; // Add Delete column header
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        // Output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["description"] . "</td>";
          echo "<td>" . $row["amount"] . "</td>";
          echo "<td>" . $row["uses"] . "</td>";
          // echo "<td>" . $row["location"] . "</td>";
          echo "<td>" . $row["category"] . "</td>";
          echo "<td><img src='" . $row["image"] . "' class='img-thumbnail' alt='Fruit Image' style='max-width: 100px; height: auto;'></td>";
          echo "<td><a href='update_fruits_details.php?id=" . $row["id"] . "'><i class='fas fa-edit'></i></a></td>"; // Add Update link with fruit id
          echo "<td><a href='delete_confirmation.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt'></i></a></td>"; // Add Delete link with fruit id
           // Add Delete column with trash icon
          echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
      } else {
        // echo "<p class='text-center'>No fruits found.</p>";
        header("location: no_fruits_found.php");
      }

      // Close connection
      $conn->close();
      ?>
    </div>
  </div>
</div>

<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
  // Function to filter table rows based on user input
  document.getElementById("searchInput").addEventListener("keyup", function() {
    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("fruitTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0]; // Change index to filter by other columns
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  });
</script>

</body>
</html>
