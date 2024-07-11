<?php
include 'db.php'; // Ensure db.php includes database connection

// Function to fetch all products from the database
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

// Function to fetch a single product by ID
function getProductById($id) {
    global $conn;
    $sql = "SELECT id, name, price, description, image FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Update product if edit request is made
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $productId = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_POST['image']; // Assuming the image path is provided directly

    // Handle file upload if a new file is uploaded
    if ($_FILES['image']['name']) {
        $targetDir = "../../Image/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = $_FILES["image"]["name"];
        } else {
            echo "Error uploading image.";
        }
    }

    $sql = "UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssi", $name, $price, $description, $image, $productId);
    if ($stmt->execute()) {
        header("Location: edit_product.php");
        exit();
    } else {
        echo "Error updating product: " . htmlspecialchars($stmt->error);
    }
}

// Delete product if delete request is made
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $productId = $_POST['delete'];
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    if ($stmt->execute()) {
        header("Location: edit_product.php");
        exit();
    } else {
        echo "Error deleting product: " . htmlspecialchars($stmt->error);
    }
}

// If edit link is clicked, fetch the product details
$productToEdit = null;
if (isset($_GET['edit_id'])) {
    $productToEdit = getProductById($_GET['edit_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="../../css/edit_product.css">
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
            <a href='edit_product.php?edit_id=" . htmlspecialchars($product['id']) . "'>Edit</a> |
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

        <?php if ($productToEdit): ?>
        <h2>Edit Product</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($productToEdit['id']); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($productToEdit['name']); ?>" required><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($productToEdit['price']); ?>" required><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($productToEdit['description']); ?></textarea><br>
            <label for="image">Image:</label>
             <input type="file" id="image" name="image" value="<?php echo htmlspecialchars($productToEdit['image']); ?>" required><br>
            
        
            <button type="submit" name="edit">Save Changes</button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>
