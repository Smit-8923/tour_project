<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Check if the destination exists
    $query = "SELECT d_name FROM destination_table WHERE d_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();

        // Now delete the destination
        $deleteQuery = "DELETE FROM destination_table WHERE d_id = ?";
        $deleteStmt = $conn->prepare($deleteQuery);

        if (!$deleteStmt) {
            die("Delete prepare failed: " . $conn->error);
        }

        $deleteStmt->bind_param("i", $id);
        if ($deleteStmt->execute()) {
            echo "<script>alert('Destination deleted successfully.'); window.location.href='manage-destination.php';</script>";
        } else {
            echo "<script>alert('Error deleting destination.'); window.location.href='manage-destination.php';</script>";
        }

        $deleteStmt->close();
    } else {
        echo "<script>alert('Destination not found.'); window.location.href='manage-destination.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='manage-destination.php';</script>";
}

$conn->close();
?>
