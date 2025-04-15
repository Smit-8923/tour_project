<?php
include('../admin/config.php');

if (!isset($_GET['id'])) {
    echo "Invalid request!";
    exit;
}

$package_id = $_GET['id'];

// Fetch full package details with joins
$sql = "SELECT p.*, 
            c.c_name, 
            d.d_name, 
            h.name, h.description AS hotel_desc, h.image AS hotel_image
        FROM packages p
        LEFT JOIN category_table c ON p.category_id = c.C_id
        LEFT JOIN destination_table d ON p.destination_id = d.d_id
        LEFT JOIN hotel h ON p.hotel_id = h.hotel_id
        WHERE p.id = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $package_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Package not found!";
    exit;
}

$row = $result->fetch_assoc();
$stmt->close();

// Fetch trip dates from separate table
$trip_dates = [];
$date_stmt = $conn->prepare("SELECT trip_date FROM package_trip_dates WHERE package_id = ?");
$date_stmt->bind_param("i", $package_id);
$date_stmt->execute();
$date_result = $date_stmt->get_result();

while ($date_row = $date_result->fetch_assoc()) {
    $trip_dates[] = $date_row['trip_date'];
}

$date_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($row['package_name']); ?> | iTravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sticky-book {
            position: sticky;
            top: 20px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .cover-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
        }
        .gallery-img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        .badge {
            font-size: 0.9rem;
            padding: 0.5em 0.75em;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <!-- Cover Image -->
    <img src="../upload/<?php echo $row['cover_image']; ?>" class="cover-img mb-4" alt="Package Banner">

    <div class="row">
        <!-- Sticky Booking Info -->
        <div class="col-md-4">
            <div class="sticky-book">
                <h4><?php echo htmlspecialchars($row['package_name']); ?></h4>
                <p><strong>Destination:</strong> <?php echo htmlspecialchars($row['d_name']); ?></p>
                <p><strong>Departure City:</strong> <?php echo htmlspecialchars($row['departure_cities']); ?></p>
                <p><strong>Available Dates:</strong><br>
                    <?php
                    if (!empty($trip_dates)) {
                        foreach ($trip_dates as $date) {
                            echo '<span class="badge bg-info text-dark me-1 mb-1">' . date('d M Y', strtotime($date)) . '</span>';
                        }
                    } else {
                        echo "Not Available";
                    }
                    ?>
                </p>
                <p><strong>Price:</strong> ₹<?php echo $row['base_price']; ?> 
                <?php if ($row['discount']) {
                    echo "<small class='text-success'>(-" . $row['discount'] . "% off)</small>";
                } ?></p>
                <a href="book.php?id=<?php echo $row['id']; ?>" class="btn btn-success w-100">Book Now</a>
            </div>
        </div>

        <!-- Full Package Info -->
        <div class="col-md-8">
            <h2><?php echo htmlspecialchars($row['package_name']); ?></h2>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($row['c_name']); ?></p>
            <p><strong>Days/Nights:</strong> <?php echo $row['days'] . "D / " . $row['nights'] . "N"; ?></p>
            <p><strong>Tags:</strong> <?php echo $row['tags']; ?></p>
            <hr>
            <h5>Itinerary</h5>
            <p><?php echo nl2br($row['itinerary']); ?></p>

            <h5>Included</h5>
            <p><?php echo nl2br($row['included']); ?></p>

            <h5>Not Included</h5>
            <p><?php echo nl2br($row['not_included']); ?></p>

            <h5>Cancellation Policy</h5>
            <p><?php echo nl2br($row['cancellation_policy']); ?></p>

            <h5>Terms & Conditions</h5>
            <p><?php echo nl2br($row['terms_conditions']); ?></p>

            <!-- Hotel Details -->
            <hr>
            <h5>Hotel Details</h5>
            <img src="../uploads/<?php echo $row['hotel_image']; ?>" class="gallery-img" alt="Hotel">
            <p><strong><?php echo htmlspecialchars($row['name']); ?></strong></p>
            <p><?php echo nl2br($row['hotel_desc']); ?></p>

            <!-- Gallery Images -->
            <?php
            $gallery = explode(',', $row['gallery_images']);
            if (!empty($gallery[0])) {
                echo "<hr><h5>Gallery</h5><div class='row'>";
                foreach ($gallery as $img) {
                    echo '<div class="col-6 col-md-4"><img src="../upload/' . trim($img) . '" class="gallery-img" alt="Gallery Image"></div>';
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
