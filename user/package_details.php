<?php
$conn = new mysqli('localhost', 'root', '', 'itravel');

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "SELECT * FROM packages WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $package = $result->fetch_assoc();
    $galleryImages = explode(',', $package['gallery_images']);
  } else {
    echo "Package not found.";
    exit;
  }
} else {
  echo "Invalid request.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $package['name']; ?> - Package Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="mb-3"><?php echo $package['name']; ?></h2>
  <img src="../uploads/<?php echo $package['cover_image']; ?>" class="img-fluid mb-4" alt="Cover Image">

  <div class="row">
    <div class="col-md-8">
      <h4>Short Description</h4>
      <p><?php echo $package['short_description']; ?></p>

      <h4>Detailed Description</h4>
      <p><?php echo $package['detailed_description']; ?></p>

      <h4>Itinerary</h4>
      <p><?php echo nl2br($package['itinerary']); ?></p>

      <h4>Inclusions</h4>
      <ul>
        <?php foreach (explode("\n", $package['inclusions']) as $inc) {
          echo "<li>$inc</li>";
        } ?>
      </ul>

      <h4>Exclusions</h4>
      <ul>
        <?php foreach (explode("\n", $package['exclusions']) as $exc) {
          echo "<li>$exc</li>";
        } ?>
      </ul>
    </div>

    <div class="col-md-4">
      <div class="bg-white p-3 shadow-sm rounded">
        <p><strong>Category:</strong> <?php echo $package['category']; ?></p>
        <p><strong>Destination:</strong> <?php echo $package['destination']; ?></p>
        <p><strong>Duration:</strong> <?php echo $package['duration']; ?></p>
        <p><strong>Trip Dates:</strong> <?php echo $package['trip_dates']; ?></p>
        <p><strong>Departure Cities:</strong> <?php echo $package['departure_cities']; ?></p>
        <p><strong>Base Price:</strong> ₹<?php echo $package['price']; ?></p>
        <?php if ($package['discount'] > 0) { ?>
          <p><strong>Discount:</strong> <?php echo $package['discount']; ?>%</p>
        <?php } ?>
        <p><strong>Child/Group Price:</strong> ₹<?php echo $package['child_price']; ?></p>
        <p><strong>Booking Cut-off:</strong> <?php echo $package['booking_cutoff']; ?></p>
        <p><strong>Tags:</strong> <?php echo $package['tags']; ?></p>
      </div>

      <div class="mt-4">
        <a href="booking_form.php?package_id=<?php echo $package['id']; ?>" class="btn btn-success w-100">Book Now</a>
      </div>
    </div>
  </div>

  <!-- Gallery -->
  <?php if (!empty($galleryImages[0])) { ?>
    <h4 class="mt-5">Gallery</h4>
    <div class="row">
      <?php foreach ($galleryImages as $img) { ?>
        <div class="col-md-3 mb-3">
          <img src="../uploads/<?php echo $img; ?>" class="img-fluid rounded" alt="Gallery Image">
        </div>
      <?php } ?>
    </div>
  <?php } ?>
</div>

</body>
</html>
