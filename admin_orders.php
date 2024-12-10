<?php
session_start();
require_once 'config.php';

// Check if the user is logged in and is an admin
// if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
//     header("Location: ../Login.php");
//     exit();
// }

// Fetch all orders
$sql = "SELECT *, 'window' AS service_type FROM window_services 
        UNION ALL 
        SELECT *, 'roof' AS service_type FROM roof_services 
        ORDER BY created_at DESC";
$result = $conn->query($sql);
$orders = $result->fetch_all(MYSQLI_ASSOC);

// Handle delete action
if (isset($_POST['delete'])) {
    $orderId = $_POST['order_id'];
    $orderType = $_POST['order_type'];
    $table = $orderType . '_services';
    $sql = "DELETE FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    header("Location: admin_orders.php");
    exit();
}

// Handle update action
if (isset($_POST['update'])) {
    $orderId = $_POST['order_id'];
    $orderType = $_POST['order_type'];
    $status = $_POST['status'];
    $table = $orderType . '_services';
    $sql = "UPDATE $table SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $orderId);
    $stmt->execute();
    header("Location: admin_orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-header {
            background-color: rgb(211, 121, 56) !important;
            color: white;
            padding: 20px 0;
        }
        .navbar{
            background-color: #8B4513;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Ceylon Wood Works - Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    <a href="admin_profile.php" class="btn btn-light">Go to Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="mb-4">Manage Orders</h1>
        <div class="row">
            <?php foreach ($orders as $order): ?>
                <div class="col-md-6 mb-4">
                    <div class="card order-card">
                        <div class="card-body">
                            <h5 class="card-title"><?= ucfirst($order['service_type']) ?> Service</h5>
                            <p class="card-text">
                                <strong>Size:</strong> <?= isset($order['window_size']) ? $order['window_size'] : $order['roof_size'] ?><br>
                                <strong>Type:</strong> <?= isset($order['window_type']) ? $order['window_type'] : $order['roof_type'] ?><br>
                                <strong>Address:</strong> <?= isset($order['address']) ? $order['address'] : $order['address'] ?><br>
                                
                            </p>
                            <form action="" method="POST" class="d-inline">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <input type="hidden" name="order_type" value="<?= $order['service_type'] ?>">
                               
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                                <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
