<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contact Us | iTravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <!-- Header -->
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="packages.php">Packages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="contact.php">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="user/login.php" class="me-2"><button type="button" class="btn btn-info">Sign In</button></a>
                    <a href="user/register.php"><button type="button" class="btn btn-info">Sign Up</button></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contact Section -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h2 class="mb-4">Get in Touch</h2>
            <div class="row justify-content-center">
                <!-- Contact Form -->
                <div class="col-md-6">
                    <form action="submit_contact.php" method="post" class="text-start">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info">Send Message</button>
                        </div>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6 mt-5 mt-md-0 text-start">
                    <div class="mb-4">
                        <h5><i class="bi bi-geo-alt-fill me-2"></i> Address</h5>
                        <p>Ahmedabad, Gujarat, India</p>
                    </div>
                    <div class="mb-4">
                        <h5><i class="bi bi-envelope-fill me-2"></i> Email</h5>
                        <p>support@itravel.com</p>
                    </div>
                    <div class="mb-4">
                        <h5><i class="bi bi-phone-fill me-2"></i> Phone</h5>
                        <p>+91 9876543210</p>
                    </div>
                    <div class="mb-4">
                        <h5><i class="bi bi-clock-fill me-2"></i> Working Hours</h5>
                        <p>Mon - Sat: 9 AM to 6 PM</p>
                    </div>
                </div>
            </div>

            <!-- Map Embed -->
            <div class="mt-5">
                <h4 class="mb-3">Find Us on Map</h4>
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235014.29918790577!2d72.41493012913726!3d23.020158084541748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1743949308648!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background-color: #e3f2fd;" class="text-dark pt-5 pb-4 text-center text-md-start">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="text-uppercase fw-bold mb-4">iTravel</h5>
                    <p>Explore the India with us. We offer the best tour and travel packages tailored for unforgettable experiences.</p>
                </div>
                <div class="col-md-2">
                    <h6 class="text-uppercase fw-bold mb-4">Quick Links</h6>
                    <p><a href="index.php" class="text-dark text-decoration-none">Home</a></p>
                    <p><a href="packages.php" class="text-dark text-decoration-none">Packages</a></p>
                    <p><a href="about.php" class="text-dark text-decoration-none">About</a></p>
                    <p><a href="contact.php" class="text-dark text-decoration-none">Contact</a></p>
                </div>
                <div class="col-md-3">
                    <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                    <p><i class="bi bi-geo-alt-fill me-2"></i> Ahmedabad, Gujarat, India</p>
                    <p><i class="bi bi-envelope-fill me-2"></i> support@itravel.com</p>
                    <p><i class="bi bi-phone-fill me-2"></i> +91 9876543210</p>
                </div>
                <div class="col-md-4">
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

    <!-- Scripts -->
    <script>
        document.getElementById("copyrightYear").textContent = new Date().getFullYear();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
