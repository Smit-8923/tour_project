<?php
// Start session
session_start();

// Include database connection
include 'config.php'; // Ensure this file has correct DB credentials

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Make sure this path is correct

// Check if form is submitted
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Validate email input
    if (empty($email)) {
        echo '<div class="alert alert-danger">Please enter your email.</div>';
        exit;
    }

    // Secure query
    $email = mysqli_real_escape_string($conn, $email);

    // Check if email exists
    $query = "SELECT * FROM admins WHERE username = '$email'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo '<div class="alert alert-danger">Database query failed: ' . mysqli_error($conn) . '</div>';
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        // Generate reset token
        $token = bin2hex(random_bytes(50));

        // Store token in database
        $update_query = "UPDATE admins SET reset_token = '$token' WHERE username = '$email'";
        if (!mysqli_query($conn, $update_query)) {
            echo '<div class="alert alert-danger">Token update failed: ' . mysqli_error($conn) . '</div>';
            exit;
        }

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'smitrana8923@gmail.com';
            $mail->Password = 'ycs car xvh fpb qqno'; // App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email headers
            $mail->setFrom('your-email@gmail.com', 'iTravel Support');
            $mail->addAddress($email); // Recipient email

            // Email content
            $mail->isHTML(true);
            $token = urlencode($token);
            $baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/itravel/itravel/admin/reset-password.php?token=" . $token;

            $mail->Subject = "Password Reset Request - iTravel";
            $mail->Body = "
                <p>Click the link below to reset your password:</p>
                <p><a href='$baseUrl' target='_blank'>Reset Password</a></p>
                <br>
                <p>If you didn’t request this, you can ignore this email.</p>
            ";

            $mail->send();
            echo '<div class="alert alert-success">An email has been sent to your email address. Please check your inbox.</div>';
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Email sending failed: ' . $mail->ErrorInfo . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Email not found!</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4" style="width: 400px;">
    <h4 class="text-center mb-4">Forgot Password</h4>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Enter Your Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100" name="submit">Send Rest Link</button>
    </form>
    <div class="text-center mt-3">
      <a href="login.php">Back to Login</a>
    </div>
  </div>
</div>
</body>
</html>
