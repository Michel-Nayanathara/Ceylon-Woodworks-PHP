<?php
require_once 'Config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check for admin login
    if ($username === "admin" && $password === "admin1234") {
        $_SESSION['user_id'] = 'admin';
        $_SESSION['user_name'] = 'admin';
        $_SESSION['is_admin'] = true;
        header("Location: admin_profile.php");
        exit;
    }

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['username'];
            $_SESSION['user_email'] = $row['email'];
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #8B4513, #D2B48C);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }
        .login-header {
            background-color: #8B4513;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .login-body {
            padding: 30px;
        }
        .form-control {
            border-radius: 20px;
        }
        .btn-login {
            background-color: #8B4513;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #D2B48C;
            transform: translateY(-2px);
        }
        .input-group-text {
            background-color: #D2B48C;
            border: none;
            color: white;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2><i class="fas fa-tree"></i> Ceylon Wood Works</h2>
            <p>Login to Your Account</p>
        </div>
        <div class="login-body">
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-login">Login</button>
                </div>
            </form>
            <div class="mt-3 text-center">
                <p>Don't have an account? <a href="Register.php">Register here</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
