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

// Fetch plank purchases for the logged-in user
$sql = "SELECT * FROM plank_purchases WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$purchases = $result->fetch_all(MYSQLI_ASSOC);

// Handle delete action
if (isset($_POST['delete'])) {
    $purchase_id = $_POST['purchase_id'];
    $delete_sql = "DELETE FROM plank_purchases WHERE id = ? AND user_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $purchase_id, $user_id);
    $delete_stmt->execute();
    header("Location: finished_planks.php");
    exit();
}

// Handle update action
if (isset($_POST['update'])) {
    $purchase_id = $_POST['purchase_id'];
    $plank_name = $_POST['plank_name'];
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];

    $update_sql = "UPDATE plank_purchases SET plank_name = ?, customer_name = ?, email = ?, phone = ?, quantity = ?, address = ? WHERE id = ? AND user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssisii", $plank_name, $customer_name, $email, $phone, $quantity, $address, $purchase_id, $user_id);
    $update_stmt->execute();
    header("Location: finished_planks.php");
    exit();
}

// Generate PDF report
if (isset($_GET['generate_pdf'])) {
    class PDF extends FPDF {
        private $purchases;

        function __construct($purchases) {
            parent::__construct();
            $this->purchases = $purchases;
        }

        function Header() {
            $this->SetFont('Arial', 'B', 16);
            $this->Cell(0, 10, 'Finished Plank Purchases Report', 0, 1, 'C');
            $this->Ln(5);
            
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 10, 'Generated on: ' . date('Y-m-d H:i:s'), 0, 1, 'R');
            $this->Ln(10);
            
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 10, 'Total number of purchases: ' . count($this->purchases), 0, 1, 'L');
            $this->Ln(10);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF($purchases);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);

    // Table header
    $pdf->SetFillColor(200, 220, 255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 7, 'ID', 0, 0, 'L', true);
    $pdf->Cell(40, 7, 'Plank Name', 0, 0, 'L', true);
    $pdf->Cell(40, 7, 'Customer Name', 0, 0, 'L', true);
    $pdf->Cell(50, 7, 'Email', 0, 0, 'L', true);
    $pdf->Cell(30, 7, 'Phone', 0, 0, 'L', true);
    $pdf->Cell(20, 7, 'Quantity', 0, 1, 'L', true);

    $pdf->SetFont('Arial', '', 9);
    foreach ($purchases as $purchase) {
        $pdf->Cell(20, 6, $purchase['id'], 0, 0, 'L');
        $pdf->Cell(40, 6, $purchase['plank_name'], 0, 0, 'L');
        $pdf->Cell(40, 6, $purchase['customer_name'], 0, 0, 'L');
        $pdf->Cell(50, 6, $purchase['email'], 0, 0, 'L');
        $pdf->Cell(30, 6, $purchase['phone'], 0, 0, 'L');
        $pdf->Cell(20, 6, $purchase['quantity'], 0, 1, 'L');
    }

    $pdf->Output('finished_plank_purchases_report.pdf', 'D');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finished Plank Purchases</title>
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
        <h1 class="mb-4">Your Finished Plank Purchases</h1>
        <a href="?generate_pdf" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Get Order Details -></a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Plank Name</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Quantity</th>
                    <th>Address</th>
                    <th>Purchase Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $purchase): ?>
                <tr>
                    <td><?php echo $purchase['id']; ?></td>
                    <td><?php echo $purchase['plank_name']; ?></td>
                    <td><?php echo $purchase['customer_name']; ?></td>
                    <td><?php echo $purchase['email']; ?></td>
                    <td><?php echo $purchase['phone']; ?></td>
                    <td><?php echo $purchase['quantity']; ?></td>
                    <td><?php echo $purchase['address']; ?></td>
                    <td><?php echo $purchase['purchase_date']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $purchase['id']; ?>">
                            <i class="fas fa-edit"></i> Update
                        </button>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="purchase_id" value="<?php echo $purchase['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this purchase?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Update Modal -->
                <div class="modal fade" id="updateModal<?php echo $purchase['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel<?php echo $purchase['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel<?php echo $purchase['id']; ?>">Update Purchase</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <input type="hidden" name="purchase_id" value="<?php echo $purchase['id']; ?>">
                                    <div class="mb-3">
                                        <label for="plank_name" class="form-label">Plank Name</label>
                                        <input type="text" class="form-control" id="plank_name" name="plank_name" value="<?php echo $purchase['plank_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="customer_name" class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $purchase['customer_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $purchase['email']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $purchase['phone']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $purchase['quantity']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" required><?php echo $purchase['address']; ?></textarea>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Update Purchase</button>
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
