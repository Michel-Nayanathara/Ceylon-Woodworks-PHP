<?php
require_once 'Config.php';

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    
    // Fetch order details
    $stmt = $pdo->prepare("SELECT * FROM roof_orders WHERE id = ?");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch order items
    $stmt = $pdo->prepare("SELECT * FROM roof_order_items WHERE order_id = ?");
    $stmt->execute([$orderId]);
    $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Redirect to an error page if no ID is provided
    header("Location: error.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
        <!-- Add your navigation bar content here -->
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">Order Details</h2>
        <?php if ($order): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Order #<?= $order['id'] ?></h5>
                </div>
                <div class="card-body">
                    <p><strong>Wood Type:</strong> <?= htmlspecialchars($order['wood_type']) ?></p>
                    <p><strong>Customer Name:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
                    <p><strong>Contact Number:</strong> <?= htmlspecialchars($order['contact_number']) ?></p>
                    <p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
                    <p><strong>Total Price:</strong> $<?= number_format($order['total_price'], 2) ?></p>
                </div>
            </div>

            <h3 class="mb-3">Order Items</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Measurement</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderItems as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['measurement']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td>$<?= number_format($item['quantity'] * $item['price'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-danger">Order not found.</div>
        <?php endif; ?>
    </div>

    <footer class="footer py-4 mt-5">
        <!-- Add your footer content here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
