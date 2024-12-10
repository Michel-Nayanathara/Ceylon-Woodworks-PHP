
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceylon Wood Works - Quality Furniture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .card {
            border-color: var(--secondary-color);
        }
        .card-header {
            background-color: var(--secondary-color);
            color: var(--primary-color);
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
                              <li><a class="dropdown-item" href="http://localhost/Furniture/SellPaints/SellPaints.php">Paints</a></li>
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
                          <a class="nav-link" href="http://localhost/Furniture/contact_us.php">Contact</a>
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
                          echo '<li><a class="dropdown-item" href="http://localhost/Furniture/user_profile.php">User Profile</a></li>';
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
<main class="container my-5">
        <h1 class="text-center mb-5">Our Products</h1>
        <!-- Wood Items Section -->
        <div class="row">
            <div class="col-md-6">
                <section class="mb-5">
                    <h2 class="text-center mb-4">Window Items</h2>
                    <div class="row row-cols-1 g-4">
                        <div class="col">
                            <div class="card h-100 shadow-sm w-100">
                                <img src="windowitem.jpg" class="card-img-top" alt="Wooden Table">
                                <div class="card-body">
                                    <h5 class="card-title">High-Quality Window Materials for Every Project </h5>
                                    <p class="card-text">We offer a range of top-quality materials for all your window construction and installation needs. Our products ensure durability, energy efficiency, and a stylish finish. Choose from our selection,</p>
                                    <a href="WoodItems.php" class="btn btn-primary">View and Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-6">
                <section>
                    <h2 class="text-center mb-4">Roof Items</h2>
                    <div class="row row-cols-1 g-4">
                        <div class="col">
                            <div class="card h-100 shadow-sm w-100">
                            <img src="roofitem.jpg" class="card-img-top" alt="Wooden Table">
                            <div class="card-body">
                                    <h5 class="card-title">Premium Roof Lumber for Sturdy Construction</h5>
                                    <p class="card-text">Looking for high-quality wood to build or repair your roof? Our premium roof lumber is the perfect choice for any roofing project. We offer a wide range of durable and treated lumber,</p>
                                    <a href="RoofItems.php" class="btn btn-primary">View and Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

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
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>


