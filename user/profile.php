<?php
session_start();
include 'config.php'; // Include your database connection file

if(!isset($_SESSION['user_email'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

$user_email = $_SESSION['user_email'];

// Fetch user details
$sql = "SELECT user_name, user_email, user_mobile, user_dob FROM user_table WHERE user_email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST['user_name'];
    $user_mobile = $_POST['user_mobile'];
    $user_dob = $_POST['user_dob'];

    $update_sql = "UPDATE user_table SET user_name = ?, user_mobile = ?, user_dob = ? WHERE user_email = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssss", $user_name, $user_mobile, $user_dob, $user_email);

    if ($update_stmt->execute()) {
        $_SESSION['success_message'] = "Profile updated successfully!";
        header("Location: home.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- header start -->
<nav class="navbar navbar-expand-lg bg-dark-body-tertiary sticky-top" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">iTravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user-package.php">Packages</a>
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
    <div class="container mt-5">
        <h2 class="text-center">User Profile</h2>

        <?php if(isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success"><?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
        <?php endif; ?>

        <form method="POST" class="shadow p-4 bg-light rounded">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="user_name" class="form-control" value="<?= htmlspecialchars($user['user_name']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email (Cannot be changed)</label>
                <input type="email" class="form-control" value="<?= htmlspecialchars($user['user_email']); ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Mobile</label>
                <input type="text" name="user_mobile" class="form-control" value="<?= htmlspecialchars($user['user_mobile']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="user_dob" class="form-control" value="<?= htmlspecialchars($user['user_dob']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="index.html" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
