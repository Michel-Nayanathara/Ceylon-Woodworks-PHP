<?php
require_once 'Config.php';

// Get the form data
$paintObject = $_POST['paint-object'];
$objectSize = $_POST['object-size'];
$paintName = $_POST['paint-name'];
$paintId = $_POST['paint-id'];

// Prepare the SQL query
$sql = "INSERT INTO service_bookings (paint_object, object_size) 
        VALUES (:paint_object, :object_size)";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':paint_object', $paintObject);
    $stmt->bindParam(':object_size', $objectSize);
    $stmt->execute();

    // Redirect the user to a success page or display a success message
    header("Location: successServiceBooking.php");
    exit;
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
