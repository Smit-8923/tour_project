<?php
include('config.php');

// ------------------ Banner Packages ------------------
$bannerSql = "SELECT package_name, short_description, cover_image FROM packages WHERE show_in_banner = 1 AND status = 'active'";
$bannerResult = $conn->query($bannerSql);

$slides = '';
$indicators = '';
$index = 0;

if ($bannerResult->num_rows > 0) {
    while ($row = $bannerResult->fetch_assoc()) {
        $activeClass = ($index == 0) ? 'active' : '';
        $indicators .= '
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $index . '" 
                class="' . $activeClass . '" aria-current="' . ($index == 0 ? 'true' : 'false') . '" 
                aria-label="Slide ' . ($index + 1) . '"></button>';

        $slides .= '
            <div class="carousel-item ' . $activeClass . '">
                <img src="uploads/' . $row['cover_image'] . '" class="d-block w-100" alt="' . htmlspecialchars($row['package_name']) . '" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>' . htmlspecialchars($row['package_name']) . '</h5>
                    <p>' . htmlspecialchars($row['short_description']) . '</p>
                </div>
            </div>';
        $index++;
    }
}

// ------------------ Popular Packages ------------------
$popularSql = "SELECT id, package_name, short_description, cover_image FROM packages WHERE is_popular = 1 AND status = 'active' LIMIT 6";
$popularResult = $conn->query($popularSql);

$popularPackages = '';
if ($popularResult->num_rows > 0) {
    while ($row = $popularResult->fetch_assoc()) {
        $popularPackages .= '
        <div class="col-md-4">
            <div class="card h-100 shadow">
                <img src="uploads/' . $row['cover_image'] . '" class="card-img-top" alt="' . htmlspecialchars($row['package_name']) . '" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">' . htmlspecialchars($row['package_name']) . '</h5>
                    <p class="card-text">' . htmlspecialchars($row['short_description']) . '</p>
                    <a href="package-details.php?id=' . $row['id'] . '" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </div>';
    }
}

$conn->close();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>itravel | Home Page</title>

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- ICONS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <!-- header start -->
    <nav class="navbar navbar-expand-lg bg-dark-body-tertiary sticky-top" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">iTravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="packages.php">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="contact.php">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="user/login.php" class="me-2"><button type="button" class="btn btn-info">Sign
                            In</button></a>
                    <a href="user/register.php"><button type="button" class="btn btn-info">Sign Up</button></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- header end -->


    <!-- main section start -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?= $indicators ?>
        </div>
        <div class="carousel-inner">
            <?= $slides ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <!-- search section start -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">Find Your Perfect Destination</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2 p-3" type="search" placeholder="Search packages or destinations"
                            aria-label="Search">
                        <button class="btn btn-primary px-4" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- search section end -->

    <!-- start package section -->

    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Popular Packages</h2>
            <div class="row g-4">
                <?= $popularPackages ?>
            </div>

            <!-- View More Button -->
            <div class="text-center mt-4">
                <a href="user/login.php" onclick="alert('Please sign in or sign up first.');"
                    class="btn btn-outline-primary px-4">View More Packages</a>
            </div>
        </div>
    </section>

    <!-- packages section end -->

    <!-- customer review section start -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-4">What Our Customers Say</h2>
            <div class="row g-4 justify-content-center">

                <!-- Review 1 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="images/reviews/customer1.jpg" class="card-img-top" alt="Customer 1"
                            style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Amit Patel</h5>
                            <p class="card-text">"iTravel made my honeymoon unforgettable. The beach resort and the
                                services were top-notch. Highly recommended!"</p>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="images/reviews/customer2.jpg" class="card-img-top" alt="Customer 2"
                            style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">Nikita Sharma</h5>
                            <p class="card-text">"A smooth and beautiful trip to the mountains. Booking was easy and the
                                guides were very friendly."</p>
                        </div>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <img src="images/reviews/customer3.jpg" class="card-img-top" alt="Customer 3"
                            style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">John Doe</h5>
                            <p class="card-text">"Amazing experience with the city package. Everything was well planned
                                and super fun. Will book again!"</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- customer review section end -->





    <!-- main section end -->
    <!-- footer start -->
    <footer style="background-color: #e3f2fd;" class="text-dark pt-5 pb-4">
        <div class="container text-md-left">
            <div class="row text-md-left">

                <!-- Company Info -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">iTravel</h5>
                    <p>
                        Explore the India with us. We offer the best tour and travel packages tailored for unforgettable
                        experiences.
                    </p>
                </div>

                <!-- Useful Links -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Quick Links</h6>
                    <p><a href="#" class="text-dark text-decoration-none">Home</a></p>
                    <p><a href="#packages" class="text-dark text-decoration-none">Packages</a></p>
                    <p><a href="#" class="text-dark text-decoration-none">About</a></p>
                    <p><a href="#" class="text-dark text-decoration-none">Contact</a></p>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    <p><i class="bi bi-geo-alt-fill me-2"></i> Ahmedabad, Gujarat, India</p>
                    <p><i class="bi bi-envelope-fill me-2"></i> support@itravel.com</p>
                    <p><i class="bi bi-phone-fill me-2"></i> +91 9876543210</p>
                </div>

                <!-- Social Media -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Follow Us</h6>
                    <a href="#" class="text-dark me-3 fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-dark me-3 fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-dark me-3 fs-5"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-dark me-3 fs-5"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="text-center py-3 border-top border-secondary mt-4">
            <p class="mb-0">&copy; <span id="copyrightYear"></span> iTravel. All Rights Reserved.</p>
        </div>
    </footer>
    <!-- footer end -->

    <!-- Year Script -->
    <script>
        document.getElementById("copyrightYear").textContent = new Date().getFullYear();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        // Get the current year
        const currentYear = new Date().getFullYear();

        // Set the current year in the span with id 'copyrightYear'
        document.getElementById('copyrightYear').textContent = currentYear;
    </script>
</body>

</html>