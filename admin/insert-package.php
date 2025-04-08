<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Fetch all inputs
    $package_name = $_POST['package_name'];
    $short_description = $_POST['short_description'];
    $detailed_description = $_POST['detailed_description'];
    $category_id = $_POST['category_id'];
    $destination_id = $_POST['destination_id'];
    $departure_cities = $_POST['departure_cities'];
    $trip_dates = $_POST['trip_dates']; // This is an array
    $days = $_POST['days'];
    $nights = $_POST['nights'];
    $itinerary = $_POST['itinerary'];
    $base_price = $_POST['base_price'];
    $discount = $_POST['discount'];
    $child_price = $_POST['child_price'];
    $included = $_POST['included'];
    $not_included = $_POST['not_included'];
    $tags = $_POST['tags'];
    $status = $_POST['status'];
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $cutoff_date = $_POST['cutoff_date'];
    $cancellation_policy = $_POST['cancellation_policy'];
    $terms_conditions = $_POST['terms_conditions'];

    // Handle file upload for cover image
    $cover_image = '';
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
        $upload_dir = '../uploads/';
        $cover_image = $upload_dir . basename($_FILES['cover_image']['name']);
        move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image);
    }

    // Handle gallery images
    $gallery_images = '';
    if (!empty($_FILES['gallery_images']['name'][0])) {
        $gallery_paths = [];
        $upload_dir = '../uploads/';
        foreach ($_FILES['gallery_images']['tmp_name'] as $key => $tmp_name) {
            $filename = basename($_FILES['gallery_images']['name'][$key]);
            $path = $upload_dir . $filename;
            move_uploaded_file($tmp_name, $path);
            $gallery_paths[] = $path;
        }
        $gallery_images = implode(',', $gallery_paths);
    }

    // Insert into packages table
    $sql = "INSERT INTO packages (
        package_name, short_description, detailed_description, category_id, destination_id,
        departure_cities, days, nights, itinerary, base_price, discount, child_price,
        included, not_included, cover_image, gallery_images, tags, status, is_featured,
        cutoff_date, cancellation_policy, terms_conditions
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssiiisiidddsssssssiss",
        $package_name, $short_description, $detailed_description, $category_id, $destination_id,
        $departure_cities, $days, $nights, $itinerary, $base_price, $discount, $child_price,
        $included, $not_included, $cover_image, $gallery_images, $tags, $status, $is_featured,
        $cutoff_date, $cancellation_policy, $terms_conditions
    );

    if ($stmt->execute()) {
        $package_id = $stmt->insert_id;

        // Now insert trip dates into a separate table
        if (!empty($trip_dates)) {
            $date_stmt = $conn->prepare("INSERT INTO package_trip_dates (package_id, trip_date) VALUES (?, ?)");
            foreach ($trip_dates as $date) {
                $date_stmt->bind_param("is", $package_id, $date);
                $date_stmt->execute();
            }
            $date_stmt->close();
        }

        echo "✅ Package and trip dates inserted successfully!";
    } else {
        echo "❌ Error inserting package: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
