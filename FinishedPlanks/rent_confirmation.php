<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Furniture";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plankName = $_POST['plankName'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $duration = $_POST['duration'];

    $sql = "INSERT INTO plank_rentals (plank_name, customer_name, email, phone, duration) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $plankName, $name, $email, $phone, $duration);

    if ($stmt->execute()) {
        $success = true;
    } else {
        $success = false;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Confirmation - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <?php if (isset($success) && $success): ?>
                    <i class="fas fa-check-circle text-success fa-5x mb-4"></i>
                    <h1 class="mb-4">Thank You for Your Request!</h1>
                    <p class="lead">We have received your wooden material request and will process it shortly. Our team will contact you within 24-48 hours to discuss the details and availability.</p>
                <?php else: ?>
                    <i class="fas fa-times-circle text-danger fa-5x mb-4"></i>
                    <h1 class="mb-4">Oops! Something Went Wrong</h1>
                    <p class="lead">We're sorry, but there was an error processing your request. Please try again later or contact our support team.</p>
                <?php endif; ?>
                <a href="FinishedPlanks.php" class="btn btn-primary mt-4">Return to Finished Planks</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
