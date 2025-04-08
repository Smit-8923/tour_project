<?php
$conn = new mysqli("localhost", "root", "", "itravel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// File upload
$imageName = "";
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $imageName = basename($_FILES["image"]["name"]);
    $targetPath = "../uploads/" . $imageName;
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath);
}

$stmt = $conn->prepare("INSERT INTO hotel (name, address, city, state, country, contact_number, email, rating, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssss", 
    $_POST['name'],
    $_POST['address'],
    $_POST['city'],
    $_POST['state'],
    $_POST['country'],
    $_POST['contact_number'],
    $_POST['email'],
    $_POST['rating'],
    $_POST['description'],
    $imageName
);

if ($stmt->execute()) {
    echo "Hotel added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
