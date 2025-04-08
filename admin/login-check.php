<?php
session_start();
$conn = new mysqli("localhost", "root", "", "itravel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM admin WHERE email=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    $_SESSION['admin_id'] = $admin['admin_id'];
    $_SESSION['admin_name'] = $admin['admin_name'];
    $_SESSION['admin_email'] = $admin['email'];
    header("Location: dashboard.php");
} else {
    header("Location: login.php?error=Invalid email or password");
}
$stmt->close();
$conn->close();
