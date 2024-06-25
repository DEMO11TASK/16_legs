<?php
include 'db.php'; // Ensure db.php includes database connection

// Function to fetch all products from database
function getProducts() {
    global $conn;
    $sql = "SELECT id, name, price, description, image FROM products";
    $result = $conn->query($sql);
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

// Delete product if delete request is made
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $productId = $_POST['delete'];
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    if ($stmt->execute()) {
        header("Location: view_products.php");
        exit();
    } else {
        echo "Error deleting product: " . htmlspecialchars($stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="../../css/view_products_style.css">
</head>
<body>
    <div id="main">
        <h2>Product List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               <?php
$products = getProducts();
foreach ($products as $product) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($product['name']) . "</td>";
    echo "<td>" . htmlspecialchars($product['price']) . "</td>";
    echo "<td>" . htmlspecialchars($product['description']) . "</td>";
    echo "<td><img src='../../Image/" . htmlspecialchars($product['image']) . "' alt='Product Image' style='max-width: 100px;'></td>";
    echo "<td>
            <a href='edit_product.php?id=" . htmlspecialchars($product['id']) . "'>Edit</a> |
            <form method='post' style='display:inline-block;'>
                <input type='hidden' name='delete' value='" . htmlspecialchars($product['id']) . "'>
                <button type='submit' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</button>
            </form>
          </td>";
          
    echo "</tr>";
}
?>

            </tbody>
        </table>
        <a href="add_product.php">Add New Product</a>
    </div>
</body>
</html>
