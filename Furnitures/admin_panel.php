<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Planks Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Panel - Manage Planks</h2>
        
        <!-- Insert Form -->
        <div class="card mb-4">
            <div class="card-header">Add New Plank</div>
            <div class="card-body">
                <form action="planks.php?section=admin" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="insert">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Plank</button>
                </form>
            </div>
        </div>

        <!-- Update Form -->
        <div class="card mb-4">
            <div class="card-header">Update Plank</div>
            <div class="card-body">
                <form action="planks.php?section=admin" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="update">
                    <div class="mb-3">
                        <label for="update_id" class="form-label">Plank ID</label>
                        <input type="number" class="form-control" id="update_id" name="id" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="update_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_description" class="form-label">Description</label>
                        <textarea class="form-control" id="update_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="update_price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="update_price" name="price" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="update_image" class="form-label">Image (leave blank to keep current image)</label>
                        <input type="file" class="form-control" id="update_image" name="image">
                    </div>
                    <button type="submit" class="btn btn-warning">Update Plank</button>
                </form>
            </div>
        </div>

        <!-- Delete Form -->
        <div class="card mb-4">
            <div class="card-header">Delete Plank</div>
            <div class="card-body">
                <form action="planks.php?section=admin" method="POST">
                    <input type="hidden" name="action" value="delete">
                    <div class="mb-3">
                        <label for="delete_id" class="form-label">Plank ID</label>
                        <input type="number" class="form-control" id="delete_id" name="id" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Plank</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>