<?php
require_once 'Config.php';

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    
    // Fetch order details
    $stmt = $pdo->prepare("SELECT * FROM furniture_orders WHERE id = ?");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch order items
    $stmt = $pdo->prepare("SELECT * FROM furniture_order_items WHERE order_id = ?");
    $stmt->execute([$orderId]);
    $orderItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: Furnitures.php");
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Add your navigation menu items here -->
    </nav>

    <div class="container my-5">
        <h2 class="text-center mb-4">Order Details</h2>
        <div class="card">
            <div class="card-header">
                <h5>Order #<?php echo $order['id']; ?></h5>
            </div>
            <div class="card-body">
                <h6>Customer Information</h6>
                <p>Name: <?php echo htmlspecialchars($order['customer_name']); ?></p>
                <p>Email: <?php echo htmlspecialchars($order['email']); ?></p>
                <p>Contact Number: <?php echo htmlspecialchars($order['contact_number']); ?></p>
                <p>Address: <?php echo htmlspecialchars($order['address']); ?></p>

                <h6 class="mt-4">Order Items</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderItems as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['item_name']); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td>$<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total:</th>
                            <th>$<?php echo number_format($order['total_price'], 2); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <footer class="footer py-4 mt-5 bg-dark text-light">
        <!-- Add your footer content here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
