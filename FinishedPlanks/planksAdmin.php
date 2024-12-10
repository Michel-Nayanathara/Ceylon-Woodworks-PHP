<?php
session_start();
require_once '../Config.php';

// Function to check if user is logged in and is an admin
function isAdmin() {
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] === 'admin';
}

// Redirect non-admin users
if (!isAdmin()) {
    header("Location: FinishedPlanks.php");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $name = $_POST['name'];
                $description = $_POST['description'];
                $image = $_POST['image'];
                $price = $_POST['price'];
                $sql = "INSERT INTO finished_planks (name, description, image, price) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssd", $name, $description, $image, $price);
                $stmt->execute();
                break;
            case 'update':
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $image = $_POST['image'];
                $price = $_POST['price'];
                $sql = "UPDATE finished_planks SET name = ?, description = ?, image = ?, price = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssdi", $name, $description, $image, $price, $id);
                $stmt->execute();
                break;
            case 'delete':
                $id = $_POST['id'];
                $sql = "DELETE FROM finished_planks WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                break;
        }
        // Refresh the page to show updated data
        header("Location: planksAdmin.php");
        exit();
    }
}

// Fetch plank items from the database
$sql = "SELECT * FROM finished_planks";
$result = $conn->query($sql);
$plankItems = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finished Planks Admin - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-header {
            background-color: #8B4513;
            color: white;
            padding: 20px 0;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header class="admin-header mb-4">
        <div class="container">
            <h1 class="text-center"><i class="fas fa-wood"></i> Finished Planks Admin Panel</h1>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Add New Plank Item</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="add">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image URL</label>
                                <input type="url" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Item</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Manage Plank Items</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($plankItems as $plank): ?>
                                    <tr>
                                        <td><?php echo $plank['id']; ?></td>
                                        <td><?php echo $plank['name']; ?></td>
                                        <td><?php echo substr($plank['description'], 0, 50) . '...'; ?></td>
                                        <td><img src="<?php echo $plank['image']; ?>" alt="<?php echo $plank['name']; ?>" width="50"></td>
                                        <td>Rs.<?php echo number_format($plank['price'], 2); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $plank['id']; ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="" method="POST" class="d-inline">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="id" value="<?php echo $plank['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal<?php echo $plank['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $plank['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel<?php echo $plank['id']; ?>">Edit Plank Item</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="action" value="update">
                                                        <input type="hidden" name="id" value="<?php echo $plank['id']; ?>">
                                                        <div class="mb-3">
                                                            <label for="edit_name<?php echo $plank['id']; ?>" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="edit_name<?php echo $plank['id']; ?>" name="name" value="<?php echo $plank['name']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_description<?php echo $plank['id']; ?>" class="form-label">Description</label>
                                                            <textarea class="form-control" id="edit_description<?php echo $plank['id']; ?>" name="description" required><?php echo $plank['description']; ?></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_image<?php echo $plank['id']; ?>" class="form-label">Image URL</label>
                                                            <input type="url" class="form-control" id="edit_image<?php echo $plank['id']; ?>" name="image" value="<?php echo $plank['image']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_price<?php echo $plank['id']; ?>" class="form-label">Price</label>
                                                            <input type="number" class="form-control" id="edit_price<?php echo $plank['id']; ?>" name="price" step="0.01" value="<?php echo $plank['price']; ?>" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
