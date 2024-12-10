<?php
// Include any necessary PHP logic here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #8B4513;
            --secondary-color: #D2B48C;
            --accent-color: #DEB887;
            --text-color: #4A4A4A;
            --light-bg: #F5F5DC;
        }
        body {
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            background-color: var(--light-bg);
        }
        .navbar {
            background-color: var(--primary-color);
        }
        .navbar-brand, .nav-link {
            color: var(--light-bg) !important;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--primary-color);
        }
        .about-section {
            background-color: var(--secondary-color);
            padding: 100px 0;
        }
        .team-member img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid var(--accent-color);
        }
        .footer {
              background-color: var(--primary-color);
              color: var(--light-bg);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
          <div class="container">
              <a class="navbar-brand" href="http://localhost/Furniture/index.php">Ceylon Wood Works</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto">
                      <li class="nav-item">
                          <a class="nav-link active" href="http://localhost/Furniture/index.php">Home</a>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Services
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                              <li><a class="dropdown-item" href="http://localhost/Furniture/RoofAndWoodItem/RoofAndWood.php">Roof and Wood</a></li>
                              <li><a class="dropdown-item" href="http://localhost/Furniture/Furnitures/Furnitures.php">Furnitures</a></li>
                              <li><a class="dropdown-item" href="http://localhost/Furniture/RoofAndWoodServices/RoofAndWoodServices.php">Window & Roof Services</a></li>
                              <li><a class="dropdown-item" href="http://localhost/Furniture/FinishedPlanks/FinishedPlanks.php">Finished Planks</a></li>
                              <li><a class="dropdown-item" href="http://localhost/furniture/BuyingTrees/Trees.php">Paints</a></li>
                              <li><a class="dropdown-item" href="http://localhost/Furniture/BuyingTrees/Trees.php">Sell Trees</a></li>
                              
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="http://localhost/Furniture/Furnitures/Furnitures.php">Furnitures</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="http://localhost/Furniture/about_us.php">About Us</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="contact_us.php">Contact</a>
                      </li>
                      <?php
                      // Check if the user is logged in
                      if (isset($_SESSION['user_name'])) {
                          // Display the user's name in the navbar
                          echo '<li class="nav-item dropdown">';
                          echo '<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
                          echo $_SESSION['user_name'];
                          echo '</a>';
                          echo '<ul class="dropdown-menu" aria-labelledby="userDropdown">';
                          echo '<li><a class="dropdown-item" href="user_profile.php">User Profile</a></li>';
                          echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
                          echo '</ul>';
                          echo '</li>';
                      } else {
                          // Display the Register button
                          echo '<li class="nav-item">';
                          echo '<a class="nav-link" href="Register.php">Register</a>';
                          echo '</li>';
                      }
                      ?>
                  </ul>
              </div>
          </div>
      </nav>

    <section class="about-section">
        <div class="container">
            <h1 class="text-center mb-5">About Ceylon Wood Works</h1>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="Assets/about.png" alt="About Ceylon Wood Works" class="img-fluid rounded shadow-lg">
                </div>
                <div class="col-lg-6">
                    <h2 class="mb-4">Our Story</h2>
                    <p>Ceylon Wood Works has been a cornerstone of quality furniture and woodworking in Sri Lanka since 2001 . Our passion for craftsmanship and dedication to sustainable practices have made us a trusted name in the industry.</p>
                    <p>We take pride in our rich heritage and commitment to delivering exceptional products that blend traditional techniques with modern design.</p>
                    <a href="#" class="btn btn-primary mt-3">Learn More About Our Process</a>
                </div>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2 class="text-center mb-5">Our Values</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <i class="fas fa-tree fa-3x mb-3 text-primary"></i>
                <h3>Sustainability</h3>
                <p>We are committed to using responsibly sourced materials and eco-friendly practices.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fas fa-hammer fa-3x mb-3 text-primary"></i>
                <h3>Craftsmanship</h3>
                <p>Our skilled artisans bring years of experience to create stunning, durable pieces.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fas fa-heart fa-3x mb-3 text-primary"></i>
                <h3>Customer Satisfaction</h3>
                <p>Your happiness is our priority. We strive to exceed expectations in every interaction.</p>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5">Meet Our Team</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="text-center team-member">
                        <img src="Assets/1.png" alt="Team Member 1" class="mb-3">
                        <h4>John Doe</h4>
                        <p class="text-muted">Founder & Master Craftsman</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center team-member">
                        <img src="Assets/2.png" alt="Team Member 2" class="mb-3">
                        <h4>Jane Smith</h4>
                        <p class="text-muted">Lead Designer</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center team-member">
                        <img src="Assets/4.png" alt="Team Member 3" class="mb-3">
                        <h4>Mike Johnson</h4>
                        <p class="text-muted">Customer Relations Manager</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer py-4 mt-5">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4 mb-3">
                      <h5>Ceylon Wood Works</h5>
                      <p>Crafting quality furniture since 1995</p>
                  </div>
                  <div class="col-lg-4 mb-3">
                      <h5>Quick Links</h5>
                      <ul class="list-unstyled">
                          <li><a href="#" class="text-light">Home</a></li>
                          <li><a href="#" class="text-light">Products</a></li>
                          <li><a href="#" class="text-light">About Us</a></li>
                          <li><a href="#" class="text-light">Contact</a></li>
                      </ul>
                  </div>
                  <div class="col-lg-4">
                      <h5>Connect With Us</h5>
                      <p>Follow us on social media for updates and inspiration</p>
                      <a href="#" class="text-light me-2"><i class="fab fa-facebook-f"></i></a>
                      <a href="#" class="text-light me-2"><i class="fab fa-instagram"></i></a>
                      <a href="#" class="text-light"><i class="fab fa-pinterest"></i></a>
                  </div>
              </div>
              <hr class="my-4 bg-light">
              <div class="text-center">
                  <small>© 2023 Ceylon Wood Works. All rights reserved.</small>
              </div>
          </div>
      </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
