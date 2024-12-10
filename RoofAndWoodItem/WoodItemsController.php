<?php
require_once '../Config.php';

class WoodItemsController {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function handleWoodItemOrder($userId, $windowType, $name, $email, $contactNumber, $address, $woodMeasurement, $referrerId) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO wood_item_orders (user_id, window_type, name, email, contact_number, address, wood_measurement, referrer_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$userId, $windowType, $name, $email, $contactNumber, $address, $woodMeasurement, $referrerId]);
            
            // Redirect to a success page or show a success message
            header("Location: successw.php");
            exit();
        } catch (PDOException $e) {
            // Handle the error (log it, show an error message, etc.)
            echo "Error: " . $e->getMessage();
        }
    }
}
