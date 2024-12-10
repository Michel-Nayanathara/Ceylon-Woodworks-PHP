<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: ../login.php");
    exit();
}

require_once '../Config.php';




$furniture_id = $_GET['id'];

// Fetch furniture details
$stmt = $conn->prepare("SELECT * FROM furniture WHERE id = ?");
$stmt->bind_param("i", $furniture_id);
$stmt->execute();
$result = $stmt->get_result();
$furniture = $result->fetch_assoc();

if (!$furniture) {
    header("Location: index.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    $customer_name = $_POST['customer_name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal_code'];

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO furniture_orders (furniture_id, customer_name, contact_number, email, address, postal_code) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $furniture_id, $customer_name, $contact_number, $email, $address, $postal_code);
    
    if ($stmt->execute()) {
        $success_message = "Order placed successfully!";
    } else {
        $error_message = "Error placing order. Please try again.";
    }
}

// Fetch reviews
$stmt = $conn->prepare("SELECT * FROM furniture_reviews WHERE furniture_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $furniture_id);
$stmt->execute();
$reviews_result = $stmt->get_result();
$reviews = $reviews_result->fetch_all(MYSQLI_ASSOC);

// Handle review submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $reviewer_name = $_POST['reviewer_name'];
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO furniture_reviews (furniture_id, reviewer_name, review_text, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $furniture_id, $reviewer_name, $review_text, $rating);
    
    if ($stmt->execute()) {
        $success_message = "Review submitted successfully!";
        header("Location: ".$_SERVER['PHP_SELF']."?id=".$furniture_id);
        exit();
    } else {
        $error_message = "Error submitting review. Please try again.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($furniture['name']); ?> - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-header {
            background-color: var(--secondary-color);
            color: var(--primary-color);
        }
        .footer {
            background-color: var(--primary-color);
            color: var(--light-bg);
        }
        .star-rating {
            color: #FFD700;
        }
        #furnitureGallery .carousel-item img {
            height: 400px;
            object-fit: cover;
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

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6" data-aos="fade-right">
                <div id="furnitureGallery" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo htmlspecialchars($furniture['image_url']); ?>" class="d-block w-100" alt="<?php echo htmlspecialchars($furniture['name']); ?>">
                        </div>
                        <!-- Add more carousel items for additional images -->
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#furnitureGallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#furnitureGallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6" data-aos="fade-left">
                <h2><?php echo htmlspecialchars($furniture['name']); ?></h2>
                <p><?php echo htmlspecialchars($furniture['description']); ?></p>
                <div class="price h4 text-success mb-4">RS.<?php echo number_format($furniture['price'], 2); ?></div>
                <p class="text-muted">In stock: <span id="stock-count"><?php echo $furniture['stock']; ?></span></p>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#orderModal">Place Order</button>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8" data-aos="fade-up">
                <h3>Customer Reviews</h3>
                <?php foreach ($reviews as $review): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($review['reviewer_name']); ?></h5>
                            <div class="star-rating" data-rating="<?php echo $review['rating']; ?>">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fas fa-star" data-rating="<?php echo $i; ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="card-text"><?php echo htmlspecialchars($review['review_text']); ?></p>
                            <small class="text-muted"><?php echo date('F j, Y', strtotime($review['created_at'])); ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4" data-aos="fade-up">
                <div class="card">
                    <div class="card-header">
                        <h4>Write a Review</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="reviewer-name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="reviewer-name" name="reviewer_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="review-text" class="form-label">Your Review</label>
                                <textarea class="form-control" id="review-text" name="review_text" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <select class="form-select" id="rating" name="rating" required>
                                    <option value="">Select rating</option>
                                    <option value="5">5 stars</option>
                                    <option value="4">4 stars</option>
                                    <option value="3">3 stars</option>
                                    <option value="2">2 stars</option>
                                    <option value="1">1 star</option>
                                </select>
                            </div>
                            <button type="submit" name="submit_review" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Place an Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="customer_name" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" class="form-control" name="contact_number" placeholder="Contact Number" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="address" rows="3" placeholder="Delivery Address" required></textarea>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="postal_code" placeholder="Postal Code" required>
                        </div>
                        <button type="submit" name="place_order" class="btn btn-primary">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-5 py-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h5>Ceylon Wood Works</h5>
                    <p>Quality furniture for your home</p>
                </div>
                <div class="col-lg-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
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
                    <a href="#" class="text-light"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        function updateStock() {
            fetch('get_stock.php?id=<?php echo $furniture_id; ?>')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('stock-count').textContent = data.stock;
                });
        }
        setInterval(updateStock, 30000); // Update every 30 seconds

        // Dynamic star rating
        document.querySelectorAll('.star-rating').forEach(function(ratingElement) {
            const rating = parseInt(ratingElement.dataset.rating);
            ratingElement.querySelectorAll('.fa-star').forEach(function(star, index) {
                if (index < rating) {
                    star.classList.add('text-warning');
                }
            });
        });
    </script>
</body>
</html>

