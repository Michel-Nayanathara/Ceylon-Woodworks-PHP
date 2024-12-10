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

// Fetch roof services for the logged-in user
$sql = "SELECT * FROM roof_services WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$services = $result->fetch_all(MYSQLI_ASSOC);

// Handle delete action
if (isset($_POST['delete'])) {
    $service_id = $_POST['service_id'];
    $delete_sql = "DELETE FROM roof_services WHERE id = ? AND user_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $service_id, $user_id);
    $delete_stmt->execute();
    header("Location: roof_service.php");
    exit();
}

// Handle update action
if (isset($_POST['update'])) {
    $service_id = $_POST['service_id'];
    $roof_size = $_POST['roof_size'];
    $roof_type = $_POST['roof_type'];
    $address = $_POST['address'];

    $update_sql = "UPDATE roof_services SET roof_size = ?, roof_type = ?, address = ? WHERE id = ? AND user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssii", $roof_size, $roof_type, $address, $service_id, $user_id);
    $update_stmt->execute();
    header("Location: roof_service.php");
    exit();
}

// Generate PDF report
if (isset($_GET['generate_pdf'])) {
    class PDF extends FPDF {
        function Header() {
            $this->SetFont('Arial', 'B', 16);
            $this->Cell(0, 10, 'Roof Services Report', 0, 1, 'C');
            $this->Ln(5);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(0, 10, 'Generated on: ' . date('Y-m-d H:i:s'), 0, 1, 'R');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(20, 7, 'ID', 1);
    $pdf->Cell(40, 7, 'Roof Size', 1);
    $pdf->Cell(40, 7, 'Roof Type', 1);
    $pdf->Cell(60, 7, 'Address', 1);
    $pdf->Cell(30, 7, 'Created At', 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 10);
    foreach ($services as $service) {
        $pdf->Cell(20, 6, $service['id'], 1);
        $pdf->Cell(40, 6, $service['roof_size'], 1);
        $pdf->Cell(40, 6, $service['roof_type'], 1);
        $pdf->Cell(60, 6, $service['address'], 1);
        $pdf->Cell(30, 6, date('Y-m-d', strtotime($service['created_at'])), 1);
        $pdf->Ln();
    }

    $pdf->Output('roof_services_report.pdf', 'D');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roof Services</title>
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
        <h1 class="mb-4">Your Roof Services</h1>
        <a href="?generate_pdf" class="btn btn-success mb-3"><i class="fas fa-file-pdf"></i> Get Order Details -></a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Roof Size</th>
                    <th>Roof Type</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                <tr>
                    <td><?php echo $service['id']; ?></td>
                    <td><?php echo $service['roof_size']; ?></td>
                    <td><?php echo $service['roof_type']; ?></td>
                    <td><?php echo $service['address']; ?></td>
                    <td><?php echo $service['created_at']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $service['id']; ?>">
                            <i class="fas fa-edit"></i> Update
                        </button>
                        <form method="post" style="display: inline;">
                            <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this service?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Update Modal -->
                <div class="modal fade" id="updateModal<?php echo $service['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel<?php echo $service['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel<?php echo $service['id']; ?>">Update Roof Service</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
                                    <div class="mb-3">
                                        <label for="roof_size" class="form-label">Roof Size</label>
                                        <input type="text" class="form-control" id="roof_size" name="roof_size" value="<?php echo $service['roof_size']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="roof_type" class="form-label">Roof Type</label>
                                        <input type="text" class="form-control" id="roof_type" name="roof_type" value="<?php echo $service['roof_type']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address" required><?php echo $service['address']; ?></textarea>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Update Service</button>
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
