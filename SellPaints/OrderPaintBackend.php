<?php
require_once 'Config.php';
session_start();

// Get the form data
$paintColor = $_POST['paint-color'];
$letters = $_POST['letters'];
$quantity = $_POST['quantity'];
$address = $_POST['address'];
$name = $_POST['name'];
$contact = $_POST['contact'];
$paintName = $_POST['paint-name'];
$paintId = $_POST['paint-id'];
$userId = $_SESSION['user_id']; // Get user_id from session

// create the SQL query
$sql = "INSERT INTO paint_orders (paint_color, letters, quantity, address, name, contact, paint_name, paint_id, user_id) 
        VALUES (:paint_color, :letters, :quantity, :address, :name, :contact, :paint_name, :paint_id, :user_id)";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':paint_color', $paintColor);
    $stmt->bindParam(':letters', $letters);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':paint_name', $paintName);
    $stmt->bindParam(':paint_id', $paintId);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    // Redirect the user to a success page or display a success message
    header("Location: success.php");
    exit;
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
