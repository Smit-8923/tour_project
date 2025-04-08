<?php
// Database connection
$host = "localhost";
$username = "root"; // Change if needed
$password = "";     // Change if needed
$database = "itravel"; // Your database name

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get category name
$c_name = $_POST['c_name'];

// Insert into category table
$sql = "INSERT INTO category_table (c_name) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $c_name);

if ($stmt->execute()) {
    echo "<script>alert('Category added successfully!'); window.location.href='add-category.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
