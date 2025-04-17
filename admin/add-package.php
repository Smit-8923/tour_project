<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    header("Location: login.php");
    exit;
}?>

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
        <a href="manage-package.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i>
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
        <a href="add-hotel.html" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add
            Hotel</span></a>
        <a href="manage-hotels.html" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i>
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
            <?= $_SESSION['admin_name'] ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="">Change Password</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <form action="insert-package.php" method="POST" enctype="multipart/form-data">
      <div class="container mt-4">
        <h2>Add New Travel Package</h2>

        <!-- Package Name -->
        <div class="mb-3">
          <label for="packageName" class="form-label">Package Name</label>
          <input type="text" class="form-control" id="packageName" name="package_name" required>
        </div>

        <!-- Short Description -->
        <div class="mb-3">
          <label for="shortDesc" class="form-label">Short Description</label>
          <textarea class="form-control" id="shortDesc" name="short_description" rows="2" required></textarea>
        </div>

        <!-- Detailed Description -->
        <div class="mb-3">
          <label for="detailDesc" class="form-label">Detailed Description</label>
          <textarea class="form-control" id="detailDesc" name="detailed_description" rows="4" required></textarea>
        </div>

        <!-- Category Dropdown -->
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select" name="category_id" id="category" required>
            <option value="">Select Category</option>
            <?php
      include 'config.php'; // Replace with your database connection file

      $cat_query = "SELECT c_id, c_name FROM category_table ORDER BY c_name ASC";
      $cat_result = mysqli_query($conn, $cat_query);

      while ($row = mysqli_fetch_assoc($cat_result)) {
        echo "<option value='" . $row['c_id'] . "'>" . htmlspecialchars($row['c_name']) . "</option>";
      }
    ?>
          </select>
        </div>


        <!-- Destination Dropdown -->
        <div class="mb-3">
          <label for="destination" class="form-label">Destination</label>
          <select class="form-select" name="destination_id" id="destination" required>
            <option value="">Select Destination</option>
            <?php
              include 'config.php'; // database connection file

              $query = "SELECT d_id, d_name FROM destination_table ORDER BY d_name ASC";
              $result = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='" . $row['d_id'] . "'>" . htmlspecialchars($row['d_name']) . "</option>";
             }
             ?>
          </select>
        </div>

        <!-- Departure City  -->
        <div class="mb-3">
        <label for="departureCity" class="form-label">Departure Cities</label>
        <div id="departureCitiesContainer">
          <input type="text" class="form-control mb-2" name="departure_cities[]" placeholder="Enter Departure City" required>
        </div>
        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addDepartureCity()">+ Add Another City</button>
        </div>



        <!-- Available Trip Dates (Multiselect) -->
        <div class="mb-3">
          <label for="tripDates" class="form-label">Available Trip Dates</label>
          <div id="tripDatesContainer">
            <input type="date" class="form-control mb-2" name="trip_dates[]" required>
          </div>
          <button type="button" class="btn btn-outline-primary btn-sm" onclick="addTripDate()">+ Add Another
            Date</button>
        </div>

        <!-- Duration: Days and Nights -->
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="days" class="form-label">How Many Days</label>
            <input type="number" class="form-control" name="days" id="days" min="1" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="nights" class="form-label">How Many Nights</label>
            <input type="number" class="form-control" name="nights" id="nights" min="0" required>
          </div>
        </div>


        <!-- Day itinerary -->
        <div class="mb-3">
          <label for="itinerary" class="form-label">Day-wise Itinerary</label>
          <textarea class="form-control" id="itinerary" rows="4" placeholder="Day 1: Arrival, Day 2: Sightseeing..."
            name="itinerary"></textarea>
        </div>

        <!-- Hotel Dropdown -->
        <div class="mb-3">
          <label for="hotel" class="form-label">Hotel</label>
          <select class="form-select" name="hotel_id" id="hotel" required>
            <option value="">Select Hotel</option>
            <?php
             include 'config.php';
             $hotel_query = "SELECT hotel_id, name FROM hotel ORDER BY name ASC";
             $hotel_result = mysqli_query($conn, $hotel_query);

             while ($row = mysqli_fetch_assoc($hotel_result)) {
             echo "<option value='" . $row['hotel_id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
             }
            ?>
          </select>
        </div>



        <!-- Base Price -->
        <div class="mb-3">
          <label for="basePrice" class="form-label">Base Price Per Person</label>
          <input type="number" class="form-control" name="base_price" id="basePrice" required>
        </div>

        <!-- Discount -->
        <div class="mb-3">
          <label for="discount" class="form-label">Discount (%)</label>
          <input type="number" class="form-control" name="discount" id="discount" min="0" max="100">
        </div>

        <!-- Child Group Price -->
        <div class="mb-3">
          <label for="childPrice" class="form-label">Child Group Price</label>
          <input type="number" class="form-control" name="child_price" id="childPrice">
        </div>

        <!-- What's Included -->
        <div class="mb-3">
          <label for="included" class="form-label">What's Included</label>
          <textarea class="form-control" name="included" id="included" rows="3"></textarea>
        </div>

        <!-- What's Not Included -->
        <div class="mb-3">
          <label for="notIncluded" class="form-label">What's Not Included</label>
          <textarea class="form-control" name="not_included" id="notIncluded" rows="3"></textarea>
        </div>

        <!-- Cover Image -->
        <div class="mb-3">
          <label for="coverImage" class="form-label">Cover Image</label>
          <input type="file" class="form-control" name="cover_image" id="coverImage" required>
        </div>

        <!-- Gallery Images -->
        <div class="mb-3">
          <label for="galleryImages" class="form-label">Gallery Images</label>
          <input type="file" class="form-control" name="gallery_images[]" id="galleryImages" multiple required>
          <small class="form-text text-muted">You can select multiple images.</small>
        </div>


        <!-- Package Status -->
        <div class="mb-3">
          <label class="form-label">Package Status</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" value="Active" checked>
            <label class="form-check-label">Active</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" value="Inactive">
            <label class="form-check-label">Inactive</label>
          </div>
        </div>

        <!-- Featured Package -->
        <div class="mb-3">
          <label class="form-label">Featured Package</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1">
            <label class="form-check-label">Mark as Featured</label>
          </div>
        </div>

        <!-- Tags / Highlights -->
        <div class="mb-3">
          <label for="tags" class="form-label">Custom Tags / Highlights (Comma Separated)</label>
          <input type="text" class="form-control" name="tags" id="tags"
            placeholder="Adventure, Family-friendly, Budget">
        </div>

        <!-- Booking Cut-off Date -->
        <div class="mb-3">
          <label for="cutoff" class="form-label">Booking Cut-off Date</label>
          <input type="date" class="form-control" name="cutoff_date" id="cutoff" required>
        </div>

        <!-- Cancellation Policy -->
        <div class="mb-3">
          <label for="cancellation_policy" class="form-label">Cancellation Policy</label>
          <textarea class="form-control" id="cancellation_policy" name="cancellation_policy" rows="4"
            required></textarea>
        </div>

        <!-- Terms & Conditions -->
        <div class="mb-3">
          <label for="terms_conditions" class="form-label">Terms & Conditions</label>
          <textarea class="form-control" id="terms_conditions" name="terms_conditions" rows="5" required></textarea>
        </div>

        <!-- Popular Package -->
        <div class="mb-3">
          <label class="form-label">Show as Popular Package</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="is_popular" value="1">
            <label class="form-check-label">Mark as Popular</label>
          </div>
        </div>

        <!-- Show in Banner -->
        <div class="mb-3">
          <label class="form-label">Show in Banner</label><br>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="show_in_banner" value="1">
            <label class="form-check-label">Display in Banner</label>
          </div>
        </div>


        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Add Package</button>
      </div>
    </form>



    <!-- Multiple Date Scirpt -->
    <script>
      function addTripDate() {
        const container = document.getElementById('tripDatesContainer');
        const input = document.createElement('input');
        input.type = 'date';
        input.name = 'trip_dates[]';
        input.classList.add('form-control', 'mb-2');
        container.appendChild(input);
      }
    </script>

    <!-- city add  -->
  <script>
  function addDepartureCity() 
  {
    const container = document.getElementById('departureCitiesContainer');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'departure_cities[]';
    input.className = 'form-control mb-2';
    input.placeholder = 'Enter Departure City';
    input.required = true;
    container.appendChild(input);
  }
  </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>