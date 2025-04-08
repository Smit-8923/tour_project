<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $d_name = trim($_POST['d_name']);
  if (!empty($d_name)) {
    $sql = "INSERT INTO destination_table (d_name, cdoj) VALUES (?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $d_name);

    if ($stmt->execute()) {
      header("Location: manage-destination.php?msg=Destination added successfully");
      exit;
    } else {
      echo "Error: " . $conn->error;
    }
  } else {
    echo "Destination name is required.";
  }
}
?>
