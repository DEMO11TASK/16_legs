



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../../css/edit_page_style.css">
</head>

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $productName = htmlspecialchars($_POST['product_name']);
    $price = floatval($_POST['price']); // Assuming price is a float
    $description = htmlspecialchars($_POST['description']);
    $image = $_FILES['image']['name'];
    $target_dir = "../../Image/";
    $target_file = $target_dir . basename($image);

    // Validate and move the uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // File uploaded successfully, now insert into database

        // Prepare SQL statement with placeholders
        $sql = "INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters to the statement
        // "s" denotes the type for each parameter (string, integer, etc.)
        $stmt->bind_param("sdsb", $productName, $price, $description, $image);

        // Execute statement
        if ($stmt->execute()) {
            echo "<p>Product added successfully!</p>";
        } else {
            echo "<p>Failed to add product to database: " . htmlspecialchars($stmt->error) . "</p>";
        }
    } else {
        echo "<p>Sorry, there was an error uploading your file.</p>";
    }
}
?>

<body>
    <div class="form-container">
        <h2>Add Product</h2>
        <form action="add_product.php" method="post" enctype="multipart/form-data">
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


</body>

</html>

<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $productName = htmlspecialchars($_POST['product_name']);
    $price = floatval($_POST['price']); // Assuming price is a float
    $description = htmlspecialchars($_POST['description']);
    $image = $_FILES['image']['name'];
    $target_dir = "../../Image/";
    $target_file = $target_dir . basename($image);

    // Validate and move the uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        // File uploaded successfully, now insert into database

        // Prepare SQL statement with placeholders
        $sql = "INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters to the statement
        // "s" denotes the type for each parameter (string, integer, etc.)
        $stmt->bind_param("sdsb", $productName, $price, $description, $image);

        // Execute statement
        if ($stmt->execute()) {
            echo "<p>Product added successfully!</p>";
        } else {
            echo "<p>Failed to add product to database: " . htmlspecialchars($stmt->error) . "</p>";
        }
    } else {
        echo "<p>Sorry, there was an error uploading your file.</p>";
    }
}
?>
