<?php
// Include database connection file
include_once 'db_connect.php';

// Get product ID from URL parameter
$product_id = $_GET['id'];

// Fetch product details from database
$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

// Check if product exists
if (!$product) {
    // Redirect to 404 page or handle error
    header("Location: 404.php");
    exit();
}

// HTML starts here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?></title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

<div class="product">
    <h2><?php echo $product['name']; ?></h2>
    <p><?php echo $product['description']; ?></p>
    <p>Price: $<?php echo $product['price']; ?></p>
    <?php if ($product['image']): ?>
        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <?php endif; ?>
</div>

<!-- Add more HTML for product details as needed -->

</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
