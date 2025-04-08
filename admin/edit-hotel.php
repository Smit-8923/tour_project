<?php
$conn = new mysqli("localhost", "root", "", "itravel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM hotel WHERE hotel_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$hotel = $result->fetch_assoc();
$stmt->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - iTravel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <style>
    body {
      display: flex;
    }

    .sidebar {
      width: 250px;
      background: #343a40;
      color: white;
      height: 100vh;
      position: fixed;
      padding-top: 20px;
    }

    .sidebar a {
      padding: 10px;
      display: block;
      color: white;
      text-decoration: none;
    }

    .sidebar a:hover {
      background: #495057;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
      width: 100%;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 80px;
      }

      .content {
        margin-left: 80px;
      }

      .sidebar a span {
        display: none;
      }
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h4 class="text-center">iTravel Admin</h4>
    <a href="dashboard.php" class="d-flex align-items-center"><i class="bi bi-speedometer2 me-2"></i>
      <span>Dashboard</span></a>

    <div class="dropdown">
      <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse"
        data-bs-target="#categoryMenu">
        <i class="bi bi-folder me-2"></i> <span>Category</span>
      </a>
      <div id="categoryMenu" class="collapse ms-3">
        <a href="add-category.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add
            Category</span></a>
        <a href="manage-category.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i>
          <span>Manage Category</span></a>
      </div>
    </div>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse"
        data-bs-target="#destinationMenu">
        <i class="bi bi-geo-alt me-2"></i> <span>Destination</span>
      </a>
      <div id="destinationMenu" class="collapse ms-3">
        <a href="add-destination.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add
            Destination</span></a>
        <a href="manage-destination.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i>
          <span>Mange Destination</span></a>
      </div>

    </div>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse"
        data-bs-target="#packagesMenu">
        <i class="bi bi-box me-2"></i> <span>Packages</span>
      </a>
      <div id="packagesMenu" class="collapse ms-3">
        <a href="add-package.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add
            Package</span></a>
        <a href="manage-packages.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i>
          <span>Manage Packages</span></a>
      </div>
    </div>


    <a href="#" class="d-flex align-items-center"><i class="bi bi-calendar-check me-2"></i> <span>Bookings</span></a>

    <div class="dropdown">
      <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse"
        data-bs-target="#usersMenu">
        <i class="bi bi-people me-2"></i> <span>Manage Users</span>
      </a>
    </div>

    <a href="#" class="d-flex align-items-center"><i class="bi bi-credit-card me-2"></i> <span>Payments</span></a>

    <div class="dropdown">
      <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse"
        data-bs-target="#hotelMenu">
        <i class="bi bi-building me-2"></i> <span>Manage Hotels</span>
      </a>
      <div id="hotelMenu" class="collapse ms-3">
        <a href="add-hotel.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add
            Hotel</span></a>
        <a href="manage-hotel.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i>
          <span>Manage Hotels</span></a>
      </div>
    </div>
    <a href="#" class="d-flex align-items-center"><i class="bi bi-chat-left-text me-2"></i> <span>User
        Feedback</span></a>

    <a href="#" class="d-flex align-items-center"><i class="bi bi-box-arrow-right me-2"></i> <span>Logout</span></a>
  </div>

    <!-- Main Content -->
    <div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
      <div class="container-fluid">
        <span class="navbar-brand">Admin Dashboard</span>
        <div class="dropdown ms-auto">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
            Admin
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="">Change Password</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>


    <div class="container mt-5">
  <h2>Edit Hotel</h2>
  <form action="update-hotel.php" method="POST" enctype="multipart/form-data" class="row g-3">
    <input type="hidden" name="id" value="<?= $hotel['hotel_id'] ?>">

    <div class="col-md-6">
      <label class="form-label">Hotel Name</label>
      <input type="text" name="name" class="form-control" value="<?= $hotel['name'] ?>" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">City</label>
      <input type="text" name="city" class="form-control" value="<?= $hotel['city'] ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label">State</label>
      <input type="text" name="state" class="form-control" value="<?= $hotel['state'] ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label">Country</label>
      <input type="text" name="country" class="form-control" value="<?= $hotel['country'] ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label">Contact Number</label>
      <input type="text" name="contact_number" class="form-control" value="<?= $hotel['contact_number'] ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?= $hotel['email'] ?>">
    </div>

    <div class="col-md-6">
      <label class="form-label">Rating</label>
      <input type="number" step="0.1" max="5" name="rating" class="form-control" value="<?= $hotel['rating'] ?>">
    </div>

    <div class="col-md-12">
      <label class="form-label">Address</label>
      <textarea name="address" class="form-control"><?= $hotel['address'] ?></textarea>
    </div>

    <div class="col-md-12">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control"><?= $hotel['description'] ?></textarea>
    </div>

    <div class="col-md-6">
      <label class="form-label">Status</label>
      <select name="status" class="form-select">
        <option value="Active" <?= $hotel['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
        <option value="Inactive" <?= $hotel['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Current Image</label><br>
      <?php if ($hotel['image']): ?>
        <img src="uploads/<?= $hotel['image'] ?>" width="100">
      <?php else: ?>
        No image
      <?php endif; ?>
    </div>

    <div class="col-md-12">
      <label class="form-label">Upload New Image</label>
      <input type="file" name="image" class="form-control">
    </div>

    <div class="col-md-12">
      <button type="submit" class="btn btn-primary">Update Hotel</button>
      <a href="manage-hotel.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
