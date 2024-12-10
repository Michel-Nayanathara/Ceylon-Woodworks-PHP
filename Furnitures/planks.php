<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'Furniture');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin section
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    
    if ($action === 'insert') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        
        $sql = "INSERT INTO planks (name, description, price, image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $name, $description, $price, $image);
        $stmt->execute();
    } elseif ($action === 'update') {
        // Update code here
    } elseif ($action === 'delete') {
        // Delete code here
    }
}

// Show Page Section
else {
    // Fetch planks data
    $sql = "SELECT * FROM planks";
    $result = $conn->query($sql);
    $planks = $result->fetch_all(MYSQLI_ASSOC);

    // Pass $planks to the show_page.php
    include 'show_page.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planks - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #8B4513;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Ceylon Wood Works</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#planks">Planks</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Admin Section -->
    <div id="admin" class="container mt-5">
        <h2 class="mb-4">Admin - Manage Planks</h2>
        <div class="card">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="insert">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Plank</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Show Page Section -->
    <div id="planks" class="container mt-5">
        <h2 class="mb-4">Available Planks</h2>
        <div class="row">
            <?php foreach ($planks as $plank): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="../uploads/<?php echo $plank['image']; ?>" class="card-img-top" alt="<?php echo $plank['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $plank['name']; ?></h5>
                            <p class="card-text"><?php echo $plank['description']; ?></p>
                            <p class="card-text"><strong>Price: $<?php echo number_format($plank['price'], 2); ?></strong></p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary btn-sm">Order Now</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

