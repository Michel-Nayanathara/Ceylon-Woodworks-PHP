<?php
session_start();
require_once 'config.php';
require('fpdf/fpdf.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch orders for the logged-in user
$sql = "SELECT * FROM wood_item_orders WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);

// Handle delete action
if (isset($_POST['delete'])) {
    $order_id = $_POST['order_id'];
    $delete_sql = "DELETE FROM wood_item_orders WHERE id = ? AND user_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $order_id, $user_id);
    $delete_stmt->execute();
    header("Location: window_orders.php");
    exit();
}

// Handle update action
if (isset($_POST['update'])) {
    $order_id = $_POST['order_id'];
    $window_type = $_POST['window_type'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $wood_measurement = $_POST['wood_measurement'];

    $update_sql = "UPDATE wood_item_orders SET window_type = ?, name = ?, email = ?, contact_number = ?, address = ?, wood_measurement = ? WHERE id = ? AND user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssssii", $window_type, $name, $email, $contact_number, $address, $wood_measurement, $order_id, $user_id);
    $update_stmt->execute();
    header("Location: window_orders.php");
    exit();
}

// Generate PDF report
if (isset($_GET['generate_pdf'])) {
    class PDF extends FPDF {
        private $orders;

        function __construct($orders) {
            parent::__construct();
            $this->orders = $orders;
        }

        function Header() {
            $this->SetFont('Arial', 'B', 16);
            $this->Cell(0, 10, 'Window Orders Report', 0, 1, 'C');
            $this->Ln(5);
            
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 10, 'Generated on: ' . date('Y-m-d H:i:s'), 0, 1, 'R');
            $this->Ln(10);
            
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 10, 'Total number of orders: ' . count($this->orders), 0, 1, 'L');
            $this->Ln(10);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF($orders);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);

    // Table header
    $pdf->SetFillColor(200, 220, 255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 7, 'Order ID', 0, 0, 'L', true);
    $pdf->Cell(30, 7, 'Window Type', 0, 0, 'L', true);
    $pdf->Cell(40, 7, 'Name', 0, 0, 'L', true);
    $pdf->Cell(50, 7, 'Email', 0, 0, 'L', true);
    $pdf->Cell(30, 7, 'Contact', 0, 0, 'L', true);
    $pdf->Cell(20, 7, 'Date', 0, 1, 'L', true);

    $pdf->SetFont('Arial', '', 9);
    foreach ($orders as $order) {
        $pdf->Cell(20, 6, $order['id'], 0, 0, 'L');
        $pdf->Cell(30, 6, $order['window_type'], 0, 0, 'L');
        $pdf->Cell(40, 6, $order['name'], 0, 0, 'L');
        $pdf->Cell(50, 6, $order['email'], 0, 0, 'L');
        $pdf->Cell(30, 6, $order['contact_number'], 0, 0, 'L');
        $pdf->Cell(20, 6, date('Y-m-d', strtotime($order['order_date'])), 0, 1, 'L');
    }

    $pdf->Output('window_orders_report.pdf', 'D');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Window Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #007bff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .modal-content {
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Your Window Orders</h1>
        <a href="?generate_pdf" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Get Order Details -></a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Window Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Wood Measurement</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['window_type']; ?></td>
                    <td><?php echo $order['name']; ?></td>
                    <td><?php echo $order['email']; ?></td>
                    <td><?php echo $order['contact_number']; ?></td>
                    <td><?php echo $order['address']; ?></td>
                    <td><?php echo $order['wood_measurement']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $order['id']; ?>">
                            <i class="fas fa-edit"></i> Update
                        </button>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Update Modal -->
                <div class="modal fade" id="updateModal<?php echo $order['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel<?php echo $order['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel<?php echo $order['id']; ?>">Update Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <div class="mb-3">
                                        <label for="window_type" class="form-label">Window Type</label>
                                        <input type="text" class="form-control" id="window_type" name="window_type" value="<?php echo $order['window_type']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $order['name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $order['email']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contact_number" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $order['contact_number']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" required><?php echo $order['address']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="wood_measurement" class="form-label">Wood Measurement</label>
                                        <input type="text" class="form-control" id="wood_measurement" name="wood_measurement" value="<?php echo $order['wood_measurement']; ?>" required>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Update Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
