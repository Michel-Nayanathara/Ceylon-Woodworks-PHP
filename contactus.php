
<?php
session_start();
require_once 'Config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message_body = $_POST['message'];

    $to = "your-email@example.com";
    $headers = "From: $email";

    if (mail($to, $subject, $message_body, $headers)) {
        $message = "Your message has been sent successfully!";
    } else {
        $message = "Oops! Something went wrong. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #3a5a40;
            --secondary-color: #a3b18a;
            --light-bg: #dad7cd;
        }
        body {
            background-color: var(--light-bg);
        }
        .navbar {
            background-color: var(--primary-color);
        }
        .contact-form {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .tree-bg {
            background-image: url('path/to/tree-image.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Ceylon Wood Works</a>
            <!-- Add your navigation items here -->
        </div>
    </nav>

    <div class="container-fluid tree-bg">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6">
                <div class="contact-form p-5 animate__animated animate__fadeInUp">
                    <h2 class="text-center mb-4">Contact Us</h2>
                    <?php if ($message): ?>
                        <div class="alert alert-success"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
