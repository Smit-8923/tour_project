<?php
if(isset($_GET['token'])){
    $token = $_GET['token'];

    if(isset($_POST['reset'])){
        //$password = md5($_POST['password']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);



        include 'config.php';
        $update = "UPDATE admins SET password='$password', reset_token=NULL WHERE reset_token='$token'";
        mysqli_query($conn, $update);

        echo "<script>alert('Password reset successful!'); window.location='login.php';</script>";
    }
} else {
    echo "<script>alert('Invalid Token'); window.location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card col-md-6 mx-auto">
        <div class="card-body">
            <h4 class="text-center">Reset Password</h4>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="reset" class="btn btn-success w-100">Reset Password</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>