<?php
require_once 'Config1.php';
require_once 'UserController.php';

$userController = new UserController($pdo);

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $userId = $_POST['userId'];
    $userController->deleteUser($userId);
    header("Location: userAdmin.php");
    exit();
}

// Fetch all users
$users = $userController->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Admin Panel - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f0f0f0;
        }
        .user-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .navbar{
            background-color: #8B4513;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container">
            <a class="navbar-brand" href="#">Ceylon Wood Works - User Admin Panel</a>
            <a href="admin_profile.php" class="btn btn-light">Go to Dashboard</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Registered Users</h2>
        
        <div class="row">
            <?php foreach ($users as $user): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card user-card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">User #<?= $user['id'] ?></h5>
                            <p class="card-text">
                                <strong><i class="fas fa-user"></i> Username:</strong> <?= htmlspecialchars($user['username']) ?><br>
                                <strong><i class="fas fa-envelope"></i> Email:</strong> <?= htmlspecialchars($user['email']) ?><br>
                                <strong><i class="fas fa-calendar-alt"></i> Registered:</strong> <?= htmlspecialchars($user['created_at']) ?><br>
                            </p>
                            <form method="post" class="mt-3">
                                <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                <button type="submit" name="delete" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this user?')">Delete User</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
