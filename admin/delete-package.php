<?php
include('config.php');

if (isset($_GET['id'])) {
    $package_id = $_GET['id'];

    // Optional: Delete related trip dates (if your DB has ON DELETE CASCADE, skip this)
    $conn->query("DELETE FROM package_trip_dates WHERE package_id = $package_id");

    // Delete the package
    $delete_sql = "DELETE FROM packages WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $package_id);

    if ($stmt->execute()) {
        // Redirect back to manage page
        header("Location: manage-package.php?msg=deleted");
        exit();
    } else {
        echo "❌ Error deleting package: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request!";
}

$conn->close();
?>
