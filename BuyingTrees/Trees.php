<?php
require 'TreeSellController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $treeName = $_POST["treeName"];
    $expectedPrice = $_POST["expectedPrice"];
    $address = $_POST["address"];
    $ownerName = $_POST["ownerName"];
    $contactNumber = $_POST["contactNumber"];
    $email = $_POST["email"];

    // Pass the form data to the TreeSellController.php file
    $controller = new TreeSellController();
    $controller->handleTreeSell($treeName, $expectedPrice, $address, $ownerName, $contactNumber, $email);
}
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Ceylon Wood Works - Sell Your Trees</title>
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
          .form-control:focus {
              border-color: var(--primary-color);
              box-shadow: 0 0 0 0.25rem rgba(139, 69, 19, 0.25);
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

      <div class="container my-5">
          <h1 class="text-center mb-4">Sell Your Trees</h1>
          <div class="row justify-content-center">
              <div class="col-lg-8">
                  <div class="card">
                      <div class="card-header bg-primary text-light">
                          Tree Selling Form
                      </div>
                      <div class="card-body">
                          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                              <div class="mb-3">
                                  <label for="treeName" class="form-label">Tree Name</label>
                                  <input type="text" class="form-control" id="treeName" name="treeName" placeholder="Enter tree name" required>
                              </div>
                              <div class="mb-3">
                                  <label for="expectedPrice" class="form-label">Expected Price</label>
                                  <input type="number" class="form-control" id="expectedPrice" name="expectedPrice" placeholder="Enter expected price" required>
                              </div>
                              <div class="mb-3">
                                  <label for="address" class="form-label">Address</label>
                                  <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address" required></textarea>
                              </div>
                              <div class="mb-3">
                                  <label for="ownerName" class="form-label">Owner Name</label>
                                  <input type="text" class="form-control" id="ownerName" name="ownerName" placeholder="Enter owner name" required>
                              </div>
                              <div class="mb-3">
                                  <label for="contactNumber" class="form-label">Contact Number</label>
                                  <input type="tel" class="form-control" id="contactNumber" name="contactNumber" placeholder="Enter contact number" required>
                              </div>
                              <div class="mb-3">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                              </div>
                              <div class="d-grid gap-2">
                                  <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>

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
