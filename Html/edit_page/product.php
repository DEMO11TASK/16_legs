<?php
include 'db.php'; // Ensure db.php includes the database connection

// Check if product ID is set in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product details from the database
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['name'];
        $product_image = $row['image'];
        $product_price = $row['price'];
        $product_description = $row['description'];
        // Other product details you want to display
    } else {
        echo "Product not found.";
    }
} else {
    echo "Product ID not specified.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product_name; ?></title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="../../css/product.css">


</head>
<body>



    <div class="nav-bar">
        <?php include '../split/nav_bar.php'; ?>
        <?php include 'popup_to_add_cart.php'; ?>
    </div>

    <!-- Product details section -->
    <div class="product-details">
        
        <img src="../../Image/<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">

        <div class="product-info">
            <h2><?php echo $product_name; ?></h2>
            <p><b>Price:</b> Rs <?php echo $product_price; ?></p>
            <!-- Other product details to display -->
             <a href="javascript:void(0);" onclick="addToCart(<?php echo $row['id']; ?>)" class="product_cart_button">
                                        <span class="material-symbols-outlined">shopping_cart</span>
                                        <p>ADD TO BAG</p>
                                    </a>
                <p><b>Description:</b> <?php echo $product_description; ?></p>
        </div>
    </div>


</body>
</html>

<?php
$conn->close();
?>