<?php
$conn = new mysqli("localhost", "root", "", "itravel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

// Get current image
$sql = "SELECT image FROM hotel WHERE hotel_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$current = $result->fetch_assoc();
$currentImage = $current['image'] ?? '';
$stmt->close();

// Upload new image if provided
$imageName = $currentImage;
if ($_FILES['image']['error'] == 0) {
    $imageName = basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $imageName);
}

$sql = "UPDATE hotel SET name=?, address=?, city=?, state=?, country=?, contact_number=?, email=?, rating=?, description=?, image=?, status=? WHERE hotel_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssi", 
    $_POST['name'],
    $_POST['address'],
    $_POST['city'],
    $_POST['state'],
    $_POST['country'],
    $_POST['contact_number'],
    $_POST['email'],
    $_POST['rating'],
    $_POST['description'],
    $imageName,
    $_POST['status'],
    $id
);

if ($stmt->execute()) {
    header("Location: manage-hotel.php?msg=updated");
} else {
    echo "Update failed: " . $stmt->error;
}
$stmt->close();
$conn->close();
