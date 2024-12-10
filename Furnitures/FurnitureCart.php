<?php
// Assuming you have a FurnitureItem class that represents a furniture item
class FurnitureItem {
    public $name;
    public $price;
    public $image;
    // Add other relevant properties
}

// Assuming you have a FurnitureCart class that manages the cart
class FurnitureCart {
    private $items = [];

    public function addItem(FurnitureItem $item) {
        $this->items[] = $item;
    }

    public function removeItem($index) {
        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindex the array
    }

    public function getItems() {
        return $this->items;
    }
}

// Assuming you have a FurnitureCart instance
$cart = new FurnitureCart();

// Add some items to the cart
$item1 = new FurnitureItem();
$item1->name = 'Sofa';
$item1->price = 500;
$item1->image = 'sofa.jpg';
$cart->addItem($item1);

$item2 = new FurnitureItem();
$item2->name = 'Dining Table';
$item2->price = 300;
$item2->image = 'dining-table.jpg';
$cart->addItem($item2);

// Display the cart page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Furniture Cart</h1>
        <div class="row">
            <?php foreach ($cart->getItems() as $index => $item) { ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card">
                    <img src="<?php echo $item->image; ?>" class="card-img-top" alt="<?php echo $item->name; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item->name; ?></h5>
                        <p class="card-text">Price: $<?php echo $item->price; ?></p>
                        <a href="?remove=<?php echo $index; ?>" class="btn btn-danger">Remove</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
