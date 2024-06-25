

<?php

include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../../css/edit_page_style.css">
</head>
<body>
    <div class="form-container">
        <h2>Add Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <button type="submit" name="submit">Add Product</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $productName = $_POST['product_name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);

        // Validate and move the uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Save product details to a database or file (example below)
            echo "<p>Product added successfully!</p>";

            // Database connection and insertion can be added here
        } else {
            echo "<p>Sorry, there was an error uploading your file.</p>";
        }
    }
    ?>
</body>
</html>