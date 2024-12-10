<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planks - Ceylon Wood Works</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Available Planks</h2>
        <div class="row">
            <?php foreach ($planks as $plank): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="../uploads/<?php echo htmlspecialchars($plank['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($plank['name']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($plank['name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($plank['description']); ?></p>
                                        <p class="card-text"><strong>Price: $<?php echo number_format($plank['price'], 2); ?></strong></p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary btn-sm">Order Now</button>
                                    </div>
                                </div>
                            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
