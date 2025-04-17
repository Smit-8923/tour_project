<?php
session_start();
if (isset($_SESSION['admin_name'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4 shadow" style="width: 400px;">
    <h4 class="text-center mb-4">Admin Login</h4>
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger"><?= $_GET['error'] ?></div>
    <?php endif; ?>
    <form action="login-check.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
      <div class="text-center mt-2">
        <a href="forgot-password.php">Forgot Password?</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
