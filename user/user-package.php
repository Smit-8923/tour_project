<?php
    include("config.php");
    session_start();
?>
<?php
include 'config.php';

// Filters
$search = $_GET['search'] ?? '';
$min_price = $_GET['min_price'] ?? '';
$max_price = $_GET['max_price'] ?? '';
$category = $_GET['category'] ?? '';
$destination = $_GET['destination'] ?? '';
$departure = $_GET['departure_city'] ?? '';

// Query builder
$query = "
SELECT p.*, c.c_name, d.d_name, h.name AS hotel_name
FROM packages p
LEFT JOIN category_table c ON p.category_id = c.c_id
LEFT JOIN destination_table d ON p.destination_id = d.d_id
LEFT JOIN hotel h ON p.hotel_id = h.hotel_id
WHERE p.status = 'Active'
";


$conditions = [];

if ($search) $conditions[] = "(p.package_name LIKE '%$search%' OR d.d_name LIKE '%$search%')";
if ($category) $conditions[] = "p.category_id = $category";
if ($destination) $conditions[] = "p.destination_id = $destination";
if ($departure) $conditions[] = "p.departure_city LIKE '%$departure%'";
if ($min_price !== '') $conditions[] = "p.base_price >= $min_price";
if ($max_price !== '') $conditions[] = "p.base_price <= $max_price";

if ($conditions) {
    $query .= " AND " . implode(" AND ", $conditions);
}

$result = mysqli_query($conn, $query);

// Check for SQL errors
if (!$result) {
    die("<div class='alert alert-danger m-4'>SQL Error: " . mysqli_error($conn) . "</div><pre>$query</pre>");
}

// Fetch dropdown values
$cat_result = mysqli_query($conn, "SELECT * FROM category_table");
$dest_result = mysqli_query($conn, "SELECT * FROM destination_table");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Packages - iTravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICONS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

 <!-- header start -->
 <nav class="navbar navbar-expand-lg bg-dark-body-tertiary sticky-top" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">iTravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="user-package.php">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="contact.php">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="username ms-4">
                <?php 
                            
                            if(isset($_SESSION['username'])) {
                                echo '<div class="dropdown">
                                        <button class="btn btn-outline-success dropdown-toggle px-4 py-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['username'] . '</button>
                                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                        </ul>
                                      </div>';
                            } else {
                                echo '<a href="user/login.php" class="btn btn-danger px-4 py-2">Login</a>';
                            }
                        ?>
                </div>
        </div>
    </nav>
    <!-- header-end  -->


<div class="container mt-4">
    <form method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Package or City" value="<?= htmlspecialchars($search) ?>">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <form method="GET">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">Filters</div>
                    <div class="card-body">

                        <label class="form-label">Min Price</label>
                        <input type="number" class="form-control mb-2" name="min_price" value="<?= htmlspecialchars($min_price) ?>">

                        <label class="form-label">Max Price</label>
                        <input type="number" class="form-control mb-2" name="max_price" value="<?= htmlspecialchars($max_price) ?>">

                        <label class="form-label">Destination</label>
                        <select name="destination" class="form-select mb-2">
                            <option value="">-- All --</option>
                            <?php while ($d = mysqli_fetch_assoc($dest_result)) { ?>
                                <option value="<?= $d['d_id'] ?>" <?= $d['d_id'] == $destination ? 'selected' : '' ?>>
                                    <?= $d['d_name'] ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Category</label>
                        <select name="category" class="form-select mb-2">
                            <option value="">-- All --</option>
                            <?php while ($c = mysqli_fetch_assoc($cat_result)) { ?>
                                <option value="<?= $c['c_id'] ?>" <?= $c['c_id'] == $category ? 'selected' : '' ?>>
                                    <?= $c['c_name'] ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label class="form-label">Departure City</label>
                        <input type="text" name="departure_city" class="form-control mb-3" value="<?= htmlspecialchars($departure) ?>">

                        <button type="submit" class="btn btn-outline-primary w-100">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Package Cards -->
        <div class="col-md-9">
            <div class="row">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow">
                                <img src="../upload/<?= $row['cover_image'] ?>" class="card-img-top" alt="<?= $row['package_name'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['package_name'] ?></h5>
                                    <p class="card-text"><strong>Destination:</strong> <?= $row['d_name'] ?></p>
                                    <p class="card-text"><strong>Category:</strong> <?= $row['c_name'] ?></p>
                                    <p class="card-text"><strong>Price:</strong> ₹<?= $row['base_price'] ?></p>
                                    <p class="card-text"><strong>Departure:</strong> <?= $row['departure_city'] ?? 'N/A' ?></p>
                                    <a href="view-package-details.php?id=<?php echo $row['id']; ?>" class="btn btn-info">View Details</a>   
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-warning">No packages found matching your filters.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


</body>
</html>
<!-- footer start -->
<footer style="background-color: #e3f2fd;" class="text-dark pt-5 pb-4">
        <div class="container text-md-left">
            <div class="row text-md-left">

                <!-- Company Info -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">iTravel</h5>
                    <p>
                        Explore the India with us. We offer the best tour and travel packages tailored for unforgettable
                        experiences.
                    </p>
                </div>

                <!-- Useful Links -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Quick Links</h6>
                    <p><a href="#" class="text-dark text-decoration-none">Home</a></p>
                    <p><a href="#packages" class="text-dark text-decoration-none">Packages</a></p>
                    <p><a href="#" class="text-dark text-decoration-none">About</a></p>
                    <p><a href="#" class="text-dark text-decoration-none">Contact</a></p>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    <p><i class="bi bi-geo-alt-fill me-2"></i> Ahmedabad, Gujarat, India</p>
                    <p><i class="bi bi-envelope-fill me-2"></i> support@itravel.com</p>
                    <p><i class="bi bi-phone-fill me-2"></i> +91 9876543210</p>
                </div>

                <!-- Social Media -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Follow Us</h6>
                    <a href="#" class="text-dark me-3 fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-dark me-3 fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-dark me-3 fs-5"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-dark me-3 fs-5"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="text-center py-3 border-top border-secondary mt-4">
            <p class="mb-0">&copy; <span id="copyrightYear"></span> iTravel. All Rights Reserved.</p>
        </div>
    </footer>
    <!-- footer end -->
      <!-- Year Script -->
    <script>
        document.getElementById("copyrightYear").textContent = new Date().getFullYear();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        // Get the current year
        const currentYear = new Date().getFullYear();

        // Set the current year in the span with id 'copyrightYear'
        document.getElementById('copyrightYear').textContent = currentYear;
    </script>
</body>
</html>