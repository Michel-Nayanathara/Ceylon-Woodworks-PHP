<?php
require_once 'Config1.php';
require_once 'BuyingTrees/TreeSellController.php';

$treeSellController = new TreeSellController($pdo);

// Handle accept action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept'])) {
    $orderId = $_POST['orderId'];
    $treeSellController->updateOrderStatus($orderId, 'Accepted');
    header("Location: treeAdmin.php");
    exit();
}

// Handle reject action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reject'])) {
    $orderId = $_POST['orderId'];
    $treeSellController->deleteOrder($orderId);
    header("Location: treeAdmin.php");
    exit();
}

// Fetch all tree sales
$treeSales = $treeSellController->getAllTreeSales();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Admin Panel - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .order-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .navbar{
            background-color: #8B4513;
        }
        .status-accepted {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container">
            <a class="navbar-brand" href="#">Ceylon Wood Works - Tree Admin Panel</a>
            <a href="admin_profile.php" class="btn btn-light">Go to Dashboard</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Tree Sale Requests</h2>
        
        <div class="row">
            <?php if (!empty($treeSales)): ?>
                <?php foreach ($treeSales as $sale): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card order-card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Request #<?= $sale['id'] ?></h5>
                                <p class="card-text">
                                    <strong><i class="fas fa-tree"></i> Tree:</strong> <?= htmlspecialchars($sale['tree_name']) ?><br>
                                    <strong><i class="fas fa-dollar-sign"></i> Expected Price:</strong> <?= htmlspecialchars($sale['expected_price']) ?><br>
                                    <strong><i class="fas fa-user"></i> Owner:</strong> <?= htmlspecialchars($sale['owner_name']) ?><br>
                                    <strong><i class="fas fa-phone"></i> Contact:</strong> <?= htmlspecialchars($sale['contact_number']) ?><br>
                                    <strong><i class="fas fa-envelope"></i> Email:</strong> <?= htmlspecialchars($sale['email']) ?><br>
                                    <strong><i class="fas fa-map-marker-alt"></i> Address:</strong> <?= htmlspecialchars($sale['address']) ?><br>
                                    <?php if ($sale['status'] === 'Accepted'): ?>
                                        <strong><i class="fas fa-check-circle"></i> Status:</strong> <span class="status-accepted">Accepted</span><br>
                                    <?php endif; ?>
                                </p>
                                <?php if ($sale['status'] !== 'Accepted'): ?>
                                    <form method="post" class="mt-3">
                                        <input type="hidden" name="orderId" value="<?= $sale['id'] ?>">
                                        <div class="d-flex justify-content-between">
                                            <button type="submit" name="accept" class="btn btn-success">Accept</button>
                                            <button type="submit" name="reject" class="btn btn-danger" onclick="return confirm('Are you sure you want to reject this request?')">Reject</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12"><p class="text-center">No tree sale requests found.</p></div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
