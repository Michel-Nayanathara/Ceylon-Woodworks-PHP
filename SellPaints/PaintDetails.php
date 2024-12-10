<?php
require_once 'Items.php';
require_once 'Config.php';

// Get the id from the URL parameter
$id = $_GET['id'];

// Find the paint detail with the given id
$paintDetail = null;
foreach ($paintDetails as $detail) {
    if ($detail['id'] == $id) {
        $paintDetail = $detail;
        break;
    }
}

$paints = [];
foreach ($paintDetails as $detail) {
    $paints[] = $detail;
}


// If the paint detail is not found, you can handle the error or redirect the user
if ($paintDetail === null) {
    // Handle the error or redirect the user
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceylon Wood Works - Paint Details</title>
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
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $paintDetail['image']; ?>" alt="Paint Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h1><?php echo $paintDetail['name']; ?></h1>
                <p><?php echo $paintDetail['description']; ?></p>
                <p>Price: Rs. <?php echo $paintDetail['price']; ?></p>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <h2>Order Paint</h2>
        <form for="order" class="row g-3" method="post" action="OrderPaintBackend.php">
            <input type="hidden" name="paint-name" value="<?php echo $paintDetail['name']; ?>">
            <input type="hidden" name="paint-id" value="<?php echo $paintDetail['id']; ?>">
            <div class="col-md-6">
                <label for="paint-color" class="form-label">Paint Color</label>
                <select class="form-select" id="paint-color" name="paint-color" required>
                    <option selected disabled value="">Choose a color</option>
                    <option value="White">White</option>
                    <option value="Blue">Blue</option>
                    <option value="Gray">Gray</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="letters" class="form-label">Number of Letters</label>
                <select class="form-select" id="letters" name="letters" required>
                    <option selected disabled value="">Choose number of letters</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="tel" class="form-control" id="contact" name="contact" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Order Paint</button>
            </div>
        </form>
    </div>

    <div class="container my-5">
        <h2>Service Booking</h2>
        <form class="row g-3" method="post" for="service" action="ServiceBookingBackend.php">
            <div class="col-md-6">
                <label for="paint-object" class="form-label">Paint Object</label>
                <select class="form-select" id="paint-object" name="paint-object" required>
                    <option selected disabled value="">Choose an object</option>
                    <option value="roof">Roof</option>
                    <option value="wall">Wall</option>
                    <option value="both">Both</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="object-size" class="form-label">Object Size</label>
                <input type="text" class="form-control" id="object-size" name="object-size" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Book Service</button>
            </div>
        </form>
    </div>

    <footer class="footer py-4 mt-5" style="background-color: var(--primary-color); color: var(--light-bg);">
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
