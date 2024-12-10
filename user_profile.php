<?php
session_start();
require_once 'Config.php';
global $conn;

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

// Fetch user data
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);

// Function to fetch orders based on type
function fetchOrders($conn, $user_id, $table) {
    $stmt = $conn->prepare("SELECT * FROM $table WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Ceylon Wood Works</title>
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
        .sidebar {
            height: 100vh;
            background-color: #3a3f44;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        .sidebar h3 {
            color: #ffffff;
        }
        .sidebar-item {
            padding: 10px 15px;
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 5px;
            margin-bottom: 5px;
            color: #ffffff;
        }
        .sidebar-item:hover, .sidebar-item.active {
            background-color: #5cb85c;
            transform: translateX(5px);
        }
        .sidebar-item i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        .content {
            padding: 20px;
        }
        .animate-fade {
            animation: fadeIn 0.5s;
        }
        
        .footer {
              background-color: var(--primary-color);
              color: var(--light-bg);
          }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
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
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <h3 class="mb-4 text-center">User Profile</h3>
                <div class="sidebar-item active" data-target="profile_settings.php">
                    <i class="fas fa-user me-2"></i> Profile
                </div>
                <div class="sidebar-item" data-target="window_orders.php">
                    <i class="fas fa-window-maximize me-2"></i> Window Item Orders
                </div>
                <div class="sidebar-item" data-target="roof_orders.php">
                    <i class="fas fa-home me-2"></i> Roof Item Orders
                </div>
                <div class="sidebar-item" data-target="sell_trees.php">
                    <i class="fas fa-tree me-2"></i> Sell Trees
                </div>
                <div class="sidebar-item" data-target="window_service.php">
                    <i class="fas fa-tools me-2"></i> Window Service 
                </div>
                <div class="sidebar-item" data-target="roof_service.php">
                    <i class="fas fa-hammer me-2"></i> Roof Service 
                </div>
                <div class="sidebar-item" data-target="finished_planks.php">
                    <i class="fas fa-tree me-2"></i> Finished Planks
                </div>
                <div class="sidebar-item" data-target="furniture_orders.php">
                    <i class="fas fa-couch me-2"></i> Furniture Orders
                </div>
                <div class="sidebar-item" data-target="paint_orders.php">
                    <i class="fas fa-paint-roller me-2"></i> Paint Item Orders
                </div>
            </div>

            <!-- Content -->
            <div class="col-md-9 col-lg-10 content">
                <iframe id="content-frame" src="profile_settings.php" width="100%" height="100%" frameborder="0"></iframe>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.sidebar-item').click(function() {
                $('.sidebar-item').removeClass('active');
                $(this).addClass('active');
                
                var target = $(this).data('target');
                $('#content-frame').attr('src', target);
            });
        });
    </script>
</body>
</html>
