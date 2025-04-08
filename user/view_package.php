<?php
$conn = new mysqli('localhost', 'root', '', 'itravel');
$sql = "SELECT * FROM packages WHERE status='Active'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Available Packages - iTravel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <h2 class="mb-4">Explore Travel Packages</h2>
    <div class="row">

      <?php while($row = $result->fetch_assoc()) { ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="../uploads/<?php echo $row['cover_image']; ?>" class="card-img-top" alt="Package Image">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['name']; ?></h5>
              <p class="card-text"><?php echo $row['short_description']; ?></p>
              <p><strong>Destination:</strong> <?php echo $row['destination']; ?></p>
              <p><strong>Price:</strong> ₹<?php echo $row['price']; ?></p>
              <a href="package_details.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</body>
</html>
