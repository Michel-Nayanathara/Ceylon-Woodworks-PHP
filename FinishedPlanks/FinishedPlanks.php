<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ceylon Wood Works - Finished Planks</title>
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
            transition: transform 0.3s;
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
        <h1 class="text-center mb-5">Finished Planks</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <img src="lum.jpg" class="card-img-top" alt="Finished Plank 1">
                    <div class="card-body">
                        <h5 class="card-title">Lumber (Dimensional Lumber) <br>Rs.2000</h5>
                        <p class="card-text">Description: Pre-cut wood pieces in standardized sizes, typically used for framing walls, floors, and roofs. Examples include 2x4s and 4x6s.</p>
                        
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#purchesModal" data-plank-name="Lumber (Dimensional Lumber) Rs.2000">Purchase</button>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#rentModal" data-plank-name="Lumber (Dimensional Lumber)">Rent Item</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="fly.jpg" class="card-img-top" alt="Finished Plank 1">
                    <div class="card-body">
                        <h5 class="card-title">Plywood <br> Rs.1200</h5>
                        <p class="card-text">Description: Engineered wood made of thin layers (plies) of wood veneer glued together. It's used for subflooring, wall sheathing, and roofing.</p>
                        
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#purchesModal" data-plank-name="Plywood Rs.1200">Purchase</button>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#rentModal" data-plank-name="Plywood">Rent Item</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="3.jpg" class="card-img-top" alt="Finished Plank 1">
                    <div class="card-body">
                        <h5 class="card-title">Oriented Strand Board (OSB)<br>Rs.1400</h5>
                        <p class="card-text">Description: Compressed wood strands arranged in specific orientations, often used as an alternative to plywood for wall sheathing and roof decking.</p>
                        
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#purchesModal" data-plank-name="Oriented Strand Board Rs.1400">Purchase</button>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#rentModal" data-plank-name="Oriented Strand Board">Rent Item</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="pre.jpg" class="card-img-top" alt="Finished Plank 1">
                    <div class="card-body">
                        <h5 class="card-title">Pressure-Treated Lumber <br>Rs.2100</h5>
                        <p class="card-text">Description: Wood that has been chemically treated to resist rot, insects, and decay. Commonly used for outdoor projects like decks and fences.</p>
                        
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#purchesModal" data-plank-name="Pressure-Treated Lumber Rs.2100">Purchase</button>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#rentModal" data-plank-name="Pressure-Treated Lumber">Rent Item</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="en.jpg" class="card-img-top" alt="Finished Plank 1">
                    <div class="card-body">
                        <h5 class="card-title">Engineered Wood Products (e.g., LVL, Glulam)<br>Rs.2400</h5>
                        <p class="card-text">Description: Manufactured wood composites like Laminated Veneer Lumber (LVL) and Glued Laminated Timber (Glulam), which offer high strength for beams, headers, and trusses.</p>
                        
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#purchesModal" data-plank-name="Engineered Wood Rs.2400">Purchase</button>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#rentModal" data-plank-name="Engineered Wood">Rent Item</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="88.png" class="card-img-top" alt="Finished Plank 1">
                    <div class="card-body">
                        <h5 class="card-title">MDF (Medium-Density Fiberboard)<br>Rs.1700</h5>
                        <p class="card-text">Description: Engineered wood made from fine wood fibers and resin, used for interior applications like cabinetry, trim, and molding.</p>
                        
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#purchesModal" data-plank-name="MDF Rs.1700">Purchase</button>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#rentModal" data-plank-name="MDF">Rent Item</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="9.png" class="card-img-top" alt="Finished Plank 1">
                    <div class="card-body">
                        <h5 class="card-title">Particle Board<br>Rs.1150</h5>
                        <p class="card-text">Description: Made from wood chips, sawdust, and resin, it is typically used in furniture and cabinets. It's more affordable than solid wood but not as strong.</p>
                        
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#purchesModal" data-plank-name="Particle Board Rs.1150">Purchase</button>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#rentModal" data-plank-name="Particle Board">Rent Item</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="cc.png" class="card-img-top" alt="Finished Plank 1">
                    <div class="card-body">
                        <h5 class="card-title">Cedar Shingles and Siding <br>Rs.3150</h5>
                        <p class="card-text">Description: Cedar wood cut into thin pieces used for roofing and exterior siding. Cedar is naturally resistant to moisture, decay, and insects.</p>
                        
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#purchesModal" data-plank-name="Cedar Shingles and Siding Rs.3150">Purchase</button>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#rentModal" data-plank-name="Cedar Shingles and Siding">Rent Item</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="11.png" class="card-img-top" alt="Finished Plank 1">
                    <div class="card-body">
                        <h5 class="card-title">Wood Trusses <br>Rs.2200</h5>
                        <p class="card-text">Description: Pre-fabricated wooden frameworks used for supporting roofs. They provide strength and stability while being lighter than solid beams.</p>
                        
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#purchesModal" data-plank-name="Wood Trusses Rs.2200">Purchase</button>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#rentModal" data-plank-name="Wood Trusses">Rent Item</button>
                    </div>
                </div>
            </div>
            
            <!-- Repeat for other planks -->
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

    <div class="modal fade" id="rentModal" tabindex="-1" aria-labelledby="rentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rentModalLabel">Rent Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="rent_confirmation.php" method="POST">
                        <input type="hidden" id="plankName" name="plankName">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Rental Duration (in days)</label>
                            <input type="number" class="form-control" id="duration" name="duration" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="purchesModal" tabindex="-1" aria-labelledby="purchesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchesModalLabel">Purchase Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="purchase_confirmation.php" method="POST">
                        <input type="hidden" id="plankName" name="plankName">
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Delivery Address</label>
                            <textarea class="form-control" id="address" name="address" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script>
        var rentModal = document.getElementById('rentModal')
        rentModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var plankName = button.getAttribute('data-plank-name')
            var modalTitle = rentModal.querySelector('.modal-title')
            var plankNameInput = rentModal.querySelector('#plankName')
            
            modalTitle.textContent = 'Rent ' + plankName
            plankNameInput.value = plankName
        })

        var purchesModal = document.getElementById('purchesModal')
        purchesModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var plankName = button.getAttribute('data-plank-name')
            var modalTitle = purchesModal.querySelector('.modal-title')
            var plankNameInput = purchesModal.querySelector('#plankName')
            
            modalTitle.textContent = 'Purchase ' + plankName
            plankNameInput.value = plankName
        })
    </script>
</body>
</html>
