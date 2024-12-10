<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: Login.php");
    exit;
}

require_once 'Config.php';

// Fetch furniture orders
$furniture_orders_query = "SELECT * FROM furniture_orders ORDER BY order_date DESC LIMIT 5";
$furniture_orders_result = $conn->query($furniture_orders_query);

// Fetch roof orders
$roof_orders_query = "SELECT * FROM roof_orders ORDER BY id DESC LIMIT 5";
$roof_orders_result = $conn->query($roof_orders_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-sidebar {
            background-color: #8B4513;
            min-height: 100vh;
        }
        .admin-content {
            padding: 20px;
        }
        .nav-link {
            color: #fff;
        }
        .nav-link:hover {
            background-color: #D2B48C;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #8B4513;
            color: white;
            font-weight: bold;
        }
        .table thead th {
            background-color: #D2B48C;
            color: #4A4A4A;
            font-weight: bold;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(210, 180, 140, 0.1);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(139, 69, 19, 0.1);
            transition: background-color 0.3s ease;
        }
        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block admin-sidebar sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="userAdmin.php">
                                <i class="fas fa-users me-2"></i>Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Furnitures/a.php">
                                <i class="fas fa-box me-2"></i>Furniture
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="SellPaints/paintAdmin.php">
                                <i class="fas fa-box me-2"></i>Paint Items
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="FinishedPlanks/planksAdmin.php">
                                <i class="fas fa-box me-2"></i>Finish Planks
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="roofAdmin.php">
                                <i class="fas fa-box me-2"></i>Roof and window Items
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_orders.php">
                                <i class="fas fa-box me-2"></i>Roof and window service
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="treeAdmin.php">
                                <i class="fas fa-box me-2"></i>Manage Buying trees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-bar me-2"></i>Analytics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 admin-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Admin Dashboard</h1>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-users me-2"></i>Total Users</h5>
                                <p class="card-text display-4">150</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-box me-2"></i>Total Products</h5>
                                <p class="card-text display-4">75</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-chart-line me-2"></i>Total Sales</h5>
                                <p class="card-text display-4">$12,500</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                Recent Furniture Orders
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Order Date</th>
                                            <th>Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $furniture_orders_result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['customer_name']; ?></td>
                                            <td><?php echo $row['order_date']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <!-- <td><?php echo number_format($row['total_amount'], 2); ?></td> -->
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                Recent Roof Orders
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Order Date</th>
                                            <th>Address</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = $roof_orders_result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['customer_name']; ?></td>
                                            <td><?php echo $row['created_at']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo number_format($row['total_price'], 2); ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
