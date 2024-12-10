<?php
require_once '../Config.php';
session_start();

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plankName = $_POST['plankName'];
    $customerName = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    try {
        $stmt = $conn->prepare("INSERT INTO plank_purchases (plank_name, customer_name, email, phone, quantity, address, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $plankName, $customerName, $email, $phone, $quantity, $address, $userId);
        $stmt->execute();

        $success = true;
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F5F5DC;
            color: #4A4A4A;
        }
        .confirmation-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="confirmation-card p-5">
                    <?php if (isset($success)): ?>
                        <h2 class="text-center mb-4">Purchase Confirmed!</h2>
                        <p>Thank you for your purchase, <?php echo htmlspecialchars($customerName); ?>. We have received your order for <?php echo htmlspecialchars($quantity); ?> <?php echo htmlspecialchars($plankName); ?>(s).</p>
                        <p>We will process your order and contact you at <?php echo htmlspecialchars($email); ?> or <?php echo htmlspecialchars($phone); ?> if we need any additional information.</p>
                        <p>Your order will be delivered to:</p>
                        <p><?php echo nl2br(htmlspecialchars($address)); ?></p>
                    <?php elseif (isset($error)): ?>
                        <h2 class="text-center mb-4">Oops! Something went wrong.</h2>
                        <p><?php echo $error; ?></p>
                    <?php else: ?>
                        <h2 class="text-center mb-4">Invalid Request</h2>
                        <p>Please submit the purchase form to see the confirmation.</p>
                    <?php endif; ?>
                    <div class="text-center mt-4">
                        <a href="FinishedPlanks.php" class="btn btn-primary">Return to Finished Planks</a><br><br>
                        <a href="http://localhost/Furniture/user_profile.php" class="btn btn-primary">Change Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
