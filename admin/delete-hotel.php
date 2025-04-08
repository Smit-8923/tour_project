<?php
$conn = new mysqli("localhost", "root", "", "itravel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Get image name to delete
$sql = "SELECT image FROM hotel WHERE hotel_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$image = $row['image'] ?? '';
$stmt->close();

// Delete record
$stmt = $conn->prepare("DELETE FROM hotel WHERE hotel_id = ?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    // Delete image file
    if ($image && file_exists("../uploads/" . $image)) {
        unlink("../uploads/" . $image);
    }
    header("Location: manage-hotel.php?msg=deleted");
} else {
    echo "Failed to delete hotel.";
}
$stmt->close();
$conn->close();
