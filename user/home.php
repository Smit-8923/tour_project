<?php
    include("config.php");
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>itravel | Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- header start -->
    <nav class="navbar  navbar-expand-lg bg-dark-body-tertiary sticky-top " style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">itravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">about</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#packages" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Packages
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Advantare</a></li>
                            <li><a class="dropdown-item" href="#">Mountain</a></li>
                            <li><a class="dropdown-item" href="#">Ocean</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div class="username ms-4">
                <?php 
                            
                            if(isset($_SESSION['username'])) {
                                echo '<div class="dropdown">
                                        <button class="btn btn-outline-success dropdown-toggle px-4 py-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['username'] . '</button>
                                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                        </ul>
                                      </div>';
                            } else {
                                echo '<a href="user/login.php" class="btn btn-danger px-4 py-2">Login</a>';
                            }
                        ?>
                </div>
            </div>
        </div>
    </nav>
    <!-- header end -->


    <!-- main section start -->

    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/banner/image.png" class="d-block w-100" alt="..."
                    style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/banner/image.png" class="d-block w-100" alt="..."
                    style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/banner/image.png" class="d-block w-100" alt="..."
                    style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
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

    <!-- about start -->

    
    <div class="container my-5" id="about">
        <h4 class="display-4 text-center">About</h4>
    </div>

    <div class="container mt-5">
        <div class="row">
          <!-- First part: Photos -->
          <div class="col-md-6">
            <div class="card">
              <img src="images/banner/image.png" style="height: 300px; object-fit: cover;" class="card-img-top" alt="Company Image">
              <!-- <img src="https://via.placeholder.com/500" class="card-img-top mt-2" alt="Company Image 2"> -->
            </div>
          </div>
      
          <!-- Second part: Paragraph (About our company) -->
          <div class="col-md-6">
            <h2>About Our Company</h2>
            <p>
              Our company is a leader in providing innovative solutions to help businesses succeed in a competitive environment. We specialize in delivering high-quality services, ensuring that every project is handled with the utmost professionalism and dedication. Our team is composed of experts in various fields who work together to achieve excellence and customer satisfaction. We are committed to continuous improvement and strive to stay ahead of industry trends to offer the best solutions to our clients.
            </p>
          </div>
        </div>
      </div>
     <!-- about end  -->

    <div class="container my-5" id="Packages">
        <h4 class="display-4 text-center">Packages</h4>
    </div>


    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/logoo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-danger">Book now</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/logoo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-danger">Book now</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/logoo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-danger">Book now</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/logoo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-danger">Book now</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/logoo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-danger">Book now</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/logoo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-danger">Book now</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/logoo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-danger">Book now</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="images/logoo.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the card's content.</p>
                            <a href="#" class="btn btn-danger">Book now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- main section end -->

    <!-- footer start -->
    <!-- Footer start -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <!-- Column 1: Links -->
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">About</a></li>
                        <li><a href="#" class="text-white">Services</a></li>
                        <li><a href="#" class="text-white">Packages</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>

                <!-- Column 2: Contact Info -->
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p><i class="bi bi-geo-alt"></i> S.G Highway, Ahmedabad</p>
                    <p><i class="bi bi-telephone"></i> +91 9510246043</p>
                    <p><i class="bi bi-envelope"></i> contact@itravel.com</p>
                </div>

                <!-- Column 3: Social Media Links -->
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            <!-- Copyright -->
            <div class="text-center mt-4">
                <p>&copy; <span id="copyrightYear"></span> itravel. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <!-- Footer end -->


    <!-- footer end  -->
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