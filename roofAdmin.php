<?php
require_once 'Config1.php';

// Fetch roof orders
$stmt = $pdo->query("SELECT * FROM roof_orders ORDER BY id DESC");
$roofOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch wood orders
$stmt = $pdo->query("SELECT * FROM wood_orders ORDER BY id DESC");
$woodOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $orderId = $_POST['orderId'];
    $orderType = $_POST['orderType'];
    
    if ($orderType === 'roof') {
        $pdo->beginTransaction();
        try {
            // First, delete related items from customer_referrals
            $stmt = $pdo->prepare("DELETE FROM customer_referrals WHERE order_id = ?");
            $stmt->execute([$orderId]);
            
            // Then, delete related items from roof_order_items
            $stmt = $pdo->prepare("DELETE FROM roof_order_items WHERE order_id = ?");
            $stmt->execute([$orderId]);
            
            // Finally, delete the order from roof_orders
            $stmt = $pdo->prepare("DELETE FROM roof_orders WHERE id = ?");
            $stmt->execute([$orderId]);
            
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollBack();
            throw $e;
        }
    } else {
        $stmt = $pdo->prepare("DELETE FROM wood_orders WHERE id = ?");
        $stmt->execute([$orderId]);
    }
    
    header("Location: roofAdmin.php");
    exit();
}// Handle update action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $orderId = $_POST['orderId'];
    $orderType = $_POST['orderType'];
    $newStatus = $_POST['status'];
    
    try {
        if ($orderType === 'roof') {
            $stmt = $pdo->prepare("UPDATE roof_orders SET status = :newStatus WHERE id = :id");
        } else {
            $stmt = $pdo->prepare("UPDATE wood_orders SET status = :newStatus WHERE id = :id");
        }
        
        $stmt->bindParam(':newStatus', $newStatus);
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        
        header("Location: roofAdmin.php");
        exit();
    } catch (PDOException $e) {
        echo "Update failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .order-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .navbar{
            background-color: #8B4513;
        }
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container">
            <a class="navbar-brand" href="#">Ceylon Wood Works - Admin Panel</a>
            <a href="admin_profile.php" class="btn btn-light">Go to Dashboard</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Order Management</h2>
        
        <ul class="nav nav-pills mb-4" id="orderTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="roof-tab" data-bs-toggle="pill" data-bs-target="#roof" type="button" role="tab" aria-controls="roof" aria-selected="true">Roof Orders</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="wood-tab" data-bs-toggle="pill" data-bs-target="#wood" type="button" role="tab" aria-controls="wood" aria-selected="false">Window Orders</button>
            </li>
        </ul>
        
        <div class="tab-content" id="orderTabsContent">
            <div class="tab-pane fade show active" id="roof" role="tabpanel" aria-labelledby="roof-tab">
                <div class="row">
                    <?php foreach ($roofOrders as $order): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card order-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Order #<?= $order['id'] ?></h5>
                                    <p class="card-text">
                                        <strong><i class="fas fa-user"></i> Customer:</strong> <?= htmlspecialchars($order['customer_name']) ?><br>
                                        <strong><i class="fas fa-envelope"></i> Email:</strong> <?= htmlspecialchars($order['email']) ?><br>
                                        <strong><i class="fas fa-phone"></i> Phone:</strong> <?= htmlspecialchars($order['contact_number']) ?><br>
                                        <strong><i class="fas fa-map-marker-alt"></i> Address:</strong> <?= htmlspecialchars($order['address']) ?><br>
                                        <strong><i class="fas fa-tree"></i> Wood Type:</strong> <?= htmlspecialchars($order['wood_type']) ?><br>
                                        <strong><i class="fas fa-dollar-sign"></i> Total Price:</strong> <?= htmlspecialchars($order['total_price']) ?><br>
                  
                                    </p>
                                    <form method="post" class="mt-3">
                                        <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
                                        <input type="hidden" name="orderType" value="roof">
                                        <div class="input-group mb-3">
                                           
                                            <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
                                        </div>
                                        <button type="submit" name="delete" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="wood" role="tabpanel" aria-labelledby="wood-tab">
                <div class="row">
                    <?php foreach ($woodOrders as $order): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card order-card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Order #<?= $order['id'] ?></h5>
                                    <p class="card-text">
                                        <strong><i class="fas fa-user"></i> Customer:</strong> <?= htmlspecialchars($order['name']) ?><br>
                                        <strong><i class="fas fa-envelope"></i> Email:</strong> <?= htmlspecialchars($order['email']) ?><br>
                                        <strong><i class="fas fa-phone"></i> Phone:</strong> <?= htmlspecialchars($order['contact_number']) ?><br>
                                        <strong><i class="fas fa-map-marker-alt"></i> Address:</strong> <?= htmlspecialchars($order['address']) ?><br>
                                      
                                    </p>
                                    <form method="post" class="mt-3">
                                        <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
                                        <input type="hidden" name="orderType" value="wood">
                                        <div class="input-group mb-3">
                                           
                                            <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
                                        </div>
                                        <button type="submit" name="delete" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
