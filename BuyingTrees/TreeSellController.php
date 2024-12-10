<?php
require_once 'Config.php'; // Include the database connection file

class TreeSellController {
    private $conn;

    public function __construct($conn = null) {
        if ($conn === null) {
            global $conn;
        }
        $this->conn = $conn;
    }

    public function handleTreeSell($treeName, $expectedPrice, $address, $ownerName, $contactNumber, $email) {
        return $this->createOrder($treeName, $expectedPrice, $address, $ownerName, $contactNumber, $email);
    }

    public function createOrder($treeName, $expectedPrice, $address, $ownerName, $contactNumber, $email) {
        // Validate required fields
        if (empty($treeName) || empty($address) || empty($ownerName) || empty($contactNumber) || empty($email)) {
            throw new Exception("All fields are required.");
        }

        // Prepare the SQL query
        $sql = "INSERT INTO tree_sales (tree_name, expected_price, address, owner_name, contact_number, email, user_id)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            // Prepare the statement
            $stmt = $this->conn->prepare($sql);

            // Bind the parameters
            $stmt->bind_param("sdsssss", $treeName, $expectedPrice, $address, $ownerName, $contactNumber, $email, $_SESSION['user_id']);

            // Execute the query
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateOrder($id, $treeName, $expectedPrice, $address, $ownerName, $contactNumber, $email) {
        $sql = "UPDATE tree_sales SET tree_name = ?, expected_price = ?, address = ?, owner_name = ?, contact_number = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdssisi", $treeName, $expectedPrice, $address, $ownerName, $contactNumber, $email, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function updateOrderStatus($id, $status) {
        $sql = "UPDATE tree_sales SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        return $result;
    }
    
    public function deleteOrder($id) {
        $sql = "DELETE FROM tree_sales WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        return $result;
    }
    
    public function getAllTreeSales() {
        $sql = "SELECT * FROM tree_sales ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    }
    
}
?>
