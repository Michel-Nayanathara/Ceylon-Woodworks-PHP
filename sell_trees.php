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

// Fetch tree sales for the logged-in user
$sql = "SELECT * FROM tree_sales WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$tree_sales = $result->fetch_all(MYSQLI_ASSOC);

// Handle delete action
if (isset($_POST['delete'])) {
    $sale_id = $_POST['sale_id'];
    $delete_sql = "DELETE FROM tree_sales WHERE id = ? AND user_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $sale_id, $user_id);
    $delete_stmt->execute();
    header("Location: sell_trees.php");
    exit();
}

// Handle update action
if (isset($_POST['update'])) {
    $sale_id = $_POST['sale_id'];
    $tree_name = $_POST['tree_name'];
    $expected_price = $_POST['expected_price'];
    $address = $_POST['address'];
    $owner_name = $_POST['owner_name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    $update_sql = "UPDATE tree_sales SET tree_name = ?, expected_price = ?, address = ?, owner_name = ?, contact_number = ?, email = ?, status = ? WHERE id = ? AND user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sdsssssii", $tree_name, $expected_price, $address, $owner_name, $contact_number, $email, $status, $sale_id, $user_id);
    $update_stmt->execute();
    header("Location: sell_trees.php");
    exit();
}

// Generate PDF report
if (isset($_GET['generate_pdf'])) {
    class PDF extends FPDF {
        private $tree_sales;

        function __construct($tree_sales) {
            parent::__construct();
            $this->tree_sales = $tree_sales;
        }

        function Header() {
            $this->SetFont('Arial', 'B', 16);
            $this->Cell(0, 10, 'Tree Sales Report', 0, 1, 'C');
            $this->Ln(5);
            
            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 10, 'Generated on: ' . date('Y-m-d H:i:s'), 0, 1, 'R');
            $this->Ln(10);
            
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(0, 10, 'Total number of tree sales: ' . count($this->tree_sales), 0, 1, 'L');
            $this->Ln(10);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF($tree_sales);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);

    // Table header
    $pdf->SetFillColor(200, 220, 255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 7, 'Sale ID', 0, 0, 'L', true);
    $pdf->Cell(40, 7, 'Tree Name', 0, 0, 'L', true);
    $pdf->Cell(30, 7, 'Expected Price', 0, 0, 'L', true);
    $pdf->Cell(50, 7, 'Owner Name', 0, 0, 'L', true);
    $pdf->Cell(30, 7, 'Status', 0, 1, 'L', true);

    $pdf->SetFont('Arial', '', 9);
    foreach ($tree_sales as $sale) {
        $pdf->Cell(20, 6, $sale['id'], 0, 0, 'L');
        $pdf->Cell(40, 6, $sale['tree_name'], 0, 0, 'L');
        $pdf->Cell(30, 6, '$' . number_format($sale['expected_price'], 2), 0, 0, 'L');
        $pdf->Cell(50, 6, $sale['owner_name'], 0, 0, 'L');
        $pdf->Cell(30, 6, $sale['status'], 0, 1, 'L');
    }

    $pdf->Output('tree_sales_report.pdf', 'D');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Trees</title>
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
        <h1 class="mb-4">Your Tree Sales</h1>
        <a href="?generate_pdf" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Get Order Details -></a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Tree Name</th>
                    <th>Expected Price</th>
                    <th>Address</th>
                    <th>Owner Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tree_sales as $sale): ?>
                <tr>
                    <td><?php echo $sale['id']; ?></td>
                    <td><?php echo $sale['tree_name']; ?></td>
                    <td>LKR: <?php echo number_format($sale['expected_price'], 2); ?></td>
                    <td><?php echo $sale['address']; ?></td>
                    <td><?php echo $sale['owner_name']; ?></td>
                    <td><?php echo $sale['contact_number']; ?></td>
                    <td><?php echo $sale['email']; ?></td>
                    <td><?php echo $sale['created_at']; ?></td>
                                    <td>
                                        <?php
                                        $status_color = '';
                                        switch ($sale['status']) {
                                            case 'Available':
                                                $status_color = 'green';
                                                break;
                                            case 'Sold':
                                                $status_color = 'red';
                                                break;
                                            case 'Pending':
                                                $status_color = 'yellow';
                                                break;
                                        }
                                        ?>
                                        <span style="color: <?php echo $status_color; ?>">
                                            <?php echo $sale['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $sale['id']; ?>">
                            <i class="fas fa-edit"></i> Update
                        </button>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="sale_id" value="<?php echo $sale['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tree sale?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Update Modal -->
                <div class="modal fade" id="updateModal<?php echo $sale['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel<?php echo $sale['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel<?php echo $sale['id']; ?>">Update Tree Sale</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <input type="hidden" name="sale_id" value="<?php echo $sale['id']; ?>">
                                    <div class="mb-3">
                                        <label for="tree_name" class="form-label">Tree Name</label>
                                        <input type="text" class="form-control" id="tree_name" name="tree_name" value="<?php echo $sale['tree_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="expected_price" class="form-label">Expected Price</label>
                                        <input type="number" step="0.01" class="form-control" id="expected_price" name="expected_price" value="<?php echo $sale['expected_price']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" required><?php echo $sale['address']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="owner_name" class="form-label">Owner Name</label>
                                        <input type="text" class="form-control" id="owner_name" name="owner_name" value="<?php echo $sale['owner_name']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contact_number" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $sale['contact_number']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $sale['email']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control" id="status" name="status" required disabled>
                                            <option value="Available" <?php echo $sale['status'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                                            <option value="Pending" <?php echo $sale['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="Sold" <?php echo $sale['status'] == 'Sold' ? 'selected' : ''; ?>>Sold</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Update Tree Sale</button>
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
