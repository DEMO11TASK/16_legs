<?php
session_start();
include '../edit_page/db.php';

$cart_products = array();

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $productId = $_POST['delete'];
    if (($key = array_search($productId, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
        unset($_SESSION['quantities'][$productId]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    }
}

// Handle quantity update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quantity'])) {
    $productId = $_POST['update_quantity'];
    $quantity = $_POST['quantity'];
    if (in_array($productId, $_SESSION['cart'])) {
        $_SESSION['quantities'][$productId] = $quantity;
    }
}

if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $cart_ids = implode(',', $_SESSION['cart']);
    $sql = "SELECT * FROM products WHERE id IN ($cart_ids)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cart_products[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../../css/cart.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.quantity').on('change', function() {
                var $form = $(this).closest('form');
                $form.submit();
            });

            // Calculate totals dynamically
            $('.quantity').on('change', function() {
                var $row = $(this).closest('.cart-item');
                var price = parseFloat($row.find('.price').text().replace('Rs ', ''));
                var quantity = $(this).val();
                var total = price * quantity;
                $row.find('.total').text('Rs ' + total.toFixed(2));

                var subtotal = 0;
                $('.total').each(function() {
                    subtotal += parseFloat($(this).text().replace('Rs ', ''));
                });
                $('#subtotal').text('Rs ' + subtotal.toFixed(2));
                $('#total').text('Rs ' + subtotal.toFixed(2));
            });
        });
    </script>

    <style type="text/css">
        /* Add your custom styles here */
    </style>
</head>
<body>
    <div class="nav-bar">
       <?php include '../split/nav_bar.php'; ?>
    </div>

    <div class="cart-details">
        <div>
        <?php if (!empty($cart_products)): ?>
            <?php foreach ($cart_products as $product): ?>
                <div class="cart-item">
                    <img src="../../Image/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <div class="cart-info">
                        <div>
                            <h3><?php echo $product['name']; ?></h3>
                            <p><b>Price:</b> Rs <span class="price"><?php echo $product['price']; ?></span></p>
                        </div>
                        <form method="POST" action="" class="quantity-form">
                            <section>
                                <label for="quantity">Quantity</label>
                                <input type="number" class="quantity" name="quantity" value="<?php echo $_SESSION['quantities'][$product['id']] ?? 1; ?>" min="1">
                                <input type="hidden" name="update_quantity" value="<?php echo $product['id']; ?>">
                            </section>
                        </form>
                        <p><b>Total:</b> Rs <span class="total"><?php echo $product['price'] * ($_SESSION['quantities'][$product['id']] ?? 1); ?></span></p>
                    </div>
                    <form method="POST" action="">
                        <input type="hidden" name="delete" value="<?php echo $product['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="cart-totals">
                <p><b>Subtotal:</b> Rs <span id="subtotal"><?php echo array_sum(array_map(function($product) {
                    return $product['price'] * ($_SESSION['quantities'][$product['id']] ?? 1);
                }, $cart_products)); ?></span></p>
                <p><b>Total:</b> Rs <span id="total"><?php echo array_sum(array_map(function($product) {
                    return $product['price'] * ($_SESSION['quantities'][$product['id']] ?? 1);
                }, $cart_products)); ?></span></p>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
$conn->close();
?>