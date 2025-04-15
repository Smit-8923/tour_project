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
        body { display: flex; }
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
        .sidebar a:hover { background: #495057; }
        .content { margin-left: 250px; padding: 20px; width: 100%; }
        @media (max-width: 768px) {
            .sidebar { width: 80px; }
            .content { margin-left: 80px; }
            .sidebar a span { display: none; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center">iTravel Admin</h4>
        <a href="dashboard.php" class="d-flex align-items-center"><i class="bi bi-speedometer2 me-2"></i> <span>Dashboard</span></a>
        
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#categoryMenu">
                <i class="bi bi-folder me-2"></i> <span>Category</span>
            </a>
            <div id="categoryMenu" class="collapse ms-3">
                <a href="add-category.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add Category</span></a>
                <a href="manage-category.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i> <span>Manage Category</span></a>
            </div>
        </div>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#destinationMenu">
                <i class="bi bi-geo-alt me-2"></i> <span>Destination</span>
            </a>
            <div id="destinationMenu" class="collapse ms-3">
                <a href="add-destination.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add Destination</span></a>
                <a href="manage-destination.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i> <span>Mange Destination</span></a>
            </div>
          
        </div>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#packagesMenu">
                <i class="bi bi-box me-2"></i> <span>Packages</span>
            </a>
            <div id="packagesMenu" class="collapse ms-3">
                <a href="add-package-form.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add Package</span></a>
                <a href="manage-packages.html" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i> <span>Manage Packages</span></a>
            </div>
        </div>
    

        <a href="#" class="d-flex align-items-center"><i class="bi bi-calendar-check me-2"></i> <span>Bookings</span></a>
        
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#usersMenu">
                <i class="bi bi-people me-2"></i> <span>Manage Users</span>
            </a>
        </div>

        <a href="#" class="d-flex align-items-center"><i class="bi bi-credit-card me-2"></i> <span>Payments</span></a>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#hotelMenu">
                <i class="bi bi-building me-2"></i> <span>Manage Hotels</span>
            </a>
            <div id="hotelMenu" class="collapse ms-3">
                <a href="add-hotel.html" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add Hotel</span></a>
                <a href="manage-hotels.html" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i> <span>Manage Hotels</span></a>
            </div>
        </div>
        <a href="#" class="d-flex align-items-center"><i class="bi bi-chat-left-text me-2"></i> <span>User Feedback</span></a>
    
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
        
        <!-- Category Page -->
        <div class="container mt-4">
            <h2>Add Categories</h2>
            <form action="insert-category.php" method="POST">
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" name="c_name">
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
