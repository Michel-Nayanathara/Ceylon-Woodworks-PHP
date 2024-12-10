<?php
session_start();
require_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serviceType = $_POST['service-type'];
    
    if ($serviceType == 'window') {
        $windowSize = $_POST['window-size'];
        $windowType = $_POST['window-type'];
        $address = $_POST['window-address'];
        
        $sql = "INSERT INTO window_services (window_size, window_type, address, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $windowSize, $windowType, $address, $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            $message = "Service request submitted successfully!";
            echo '<div class="alert alert-success" role="alert">';
            echo $message;
            echo '<br><a href="http://localhost/Furniture/user_profile.php" class="btn btn-primary mt-3">Change Your Order</a>';
            echo '</div>';
        } else {
            $message = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } elseif ($serviceType == 'roof') {
        $roofSize = $_POST['roof-size'];
        $roofType = $_POST['roof-type'];
        $address = $_POST['roof-address'];
        
        $sql = "INSERT INTO roof_services (roof_size, roof_type, address, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $roofSize, $roofType, $address, $_SESSION['user_id']);
        
        if ($stmt->execute()) {
            $message = "Roof service request submitted successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceylon Wood Works - Roof and Wood Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-brand, .nav-link {
            color: var(--light-bg) !important;
            transition: color 0.3s ease;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: var(--accent-color) !important;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        .card {
            border-color: var(--secondary-color);
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            font-weight: bold;
        }
        .footer {
            background-color: var(--primary-color);
            color: var(--light-bg);
        }
        .service-icon {
            font-size: 3rem;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }
        .service-icon:hover {
            transform: scale(1.1);
            color: var(--accent-color);
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid var(--secondary-color);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 69, 19, 0.25);
        }
        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50%;
            height: 2px;
            background-color: var(--primary-color);
        }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('path/to/your/hero-image.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .testimonial {
            font-style: italic;
            margin-bottom: 20px;
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

    <div class="hero-section">
        <div class="container">
            <h1 class="display-4" data-aos="fade-up">Expert Roof and Wood Services</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">Quality craftsmanship for your home</p>
            <a href="#service-form" class="btn btn-primary btn-lg mt-3" data-aos="fade-up" data-aos-delay="200">Get Started</a>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-5 section-title" data-aos="fade-up">Our Services</h2>
        
        <?php
        if (!empty($message)) {
            echo "<div class='alert alert-success' role='alert'>$message</div>";
        }
        ?>

        <form id="service-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" data-aos="fade-up">
            <div class="form-group mb-4">
                <label for="service-type" class="form-label">Select Service Type:</label>
                <select class="form-select" id="service-type" name="service-type" required>
                    <option value="" selected disabled>Select service type</option>
                    <option value="window">Window</option>
                    <option value="roof">Roof</option>
                </select>
            </div>

            <div id="window-form" class="d-none">
                <div class="form-group">
                    <label for="window-size">Window Size:</label>
                    <input type="number" placeholder='Enter window size' class="form-control" id="window-size" name="window-size">
                </div>
                <div class="form-group">
                    <label for="window-type">Window Type:</label>
                    <select class="form-control" id="window-type" name="window-type">
                        <option value="Wooden">Wooden</option>
                        <option value="Board">Board</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="window-address">Address:</label>
                    <input type="text" placeholder='Enter address' class="form-control" id="window-address" name="window-address">
                </div>
            </div>

            <div id="roof-form" class="d-none">
                <div class="form-group">
                    <label for="roof-size">Roof Size:</label>
                    <input type="number" placeholder='Enter roof size' class="form-control" id="roof-size" name="roof-size">
                </div>
                <div class="form-group">
                    <label for="roof-type">Roof Type:</label>
                    <select class="form-control" id="roof-type" name="roof-type">
                        <option value="Asbestos">Asbestos</option>
                        <option value="Amano">Amano</option>
                        <option value="Clay tile">Clay tile</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="roof-address">Address:</label>
                    <input type="text" placeholder='Enter address' class="form-control" id="roof-address" name="roof-address">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mt-4">Submit Request</button>
        </form>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-4 section-title" data-aos="fade-up">Why Choose Us?</h2>
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-tools service-icon mb-3"></i>
                        <h5 class="card-title">Expert Craftsmanship</h5>
                        <p class="card-text">Our team of skilled professionals ensures top-quality work on every project.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-clock service-icon mb-3"></i>
                        <h5 class="card-title">Timely Completion</h5>
                        <p class="card-text">We value your time and strive to complete all projects within the agreed timeframe.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-dollar-sign service-icon mb-3"></i>
                        <h5 class="card-title">Competitive Pricing</h5>
                        <p class="card-text">Get the best value for your money with our competitive and transparent pricing.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <h2 class="text-center mb-4 section-title" data-aos="fade-up">What Our Customers Say</h2>
        <div class="row">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial">
                    "Excellent service! The team was professional and completed the job on time."
                </div>
                <p class="font-weight-bold">- John D.</p>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial">
                    "I'm very satisfied with the quality of work. My new roof looks amazing!"
                </div>
                <p class="font-weight-bold">- Sarah M.</p>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial">
                    "Prompt, courteous, and skilled. I highly recommend their services."
                </div>
                <p class="font-weight-bold">- Michael R.</p>
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
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        const serviceTypeSelect = document.getElementById('service-type');
        const windowForm = document.getElementById('window-form');
        const roofForm = document.getElementById('roof-form');

        serviceTypeSelect.addEventListener('change', function() {
            if (this.value === 'window') {
                windowForm.classList.remove('d-none');
                roofForm.classList.add('d-none');
            }
            else if (this.value === 'roof') {
                windowForm.classList.add('d-none');
                roofForm.classList.remove('d-none');
            }
            else {
                windowForm.classList.add('d-none');
                roofForm.classList.add('d-none');
            }
        });
    </script>
</body>
</html>

