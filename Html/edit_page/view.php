<?php
include 'db.php'; // Ensure db.php includes the database connection

// Fetch all products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="../../css/view_product.css">
    <?php include '../split/font_awesome.php'; ?>

     
    

</head>
<body>


    <div class="split">
        <div id="main">
            <div id="sub_main">
                <div class="container">
                    <h2>View Products</h2>

                    <!-- Display products in four columns -->
                    <div class="product-list">
                        <?php
                        if ($result->num_rows > 0) {
                            $count = 0;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="product-item">
                                    <div>
                                        <a href="../edit_page/product.php?id=<?php echo $row['id']; ?>">
                                            <img src="../../Image/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                                            <h3><?php echo $row['name']; ?></h3>
                                        </a>
                                        <p>Price: $<?php echo $row['price']; ?></p>
                                    </div>
                                   
                                    <a href="javascript:void(0);" onclick="addToCart(<?php echo $row['id']; ?>)" class="cart_button">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                        <p>ADD TO BAG</p>
                                        </a>
                                </div>


                                <?php
                                // Check if four items have been displayed
                                $count++;
                                if ($count % 4 == 0) {
                                                                    }
                            }
                        } else {
                            echo "No products found.";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php include 'popup_to_add_cart.php'; ?>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
