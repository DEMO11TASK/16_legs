<?php
include 'db.php'; // Ensure db.php includes database connection

$display_message = ""; // Initialize display message variable

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Sanitize and validate inputs
    $productName = htmlspecialchars($_POST['product_name']);
    $price = floatval($_POST['price']); // Convert price to float
    $description = htmlspecialchars($_POST['description']);
    $image = $_FILES['image']['name'];
    $target_dir = "../../Image/";
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $display_message = "File is not an image.";
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        $display_message = "Sorry, your file is too large.";
    }

    // Allow only certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $display_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // If no errors, upload file and insert into database
    if (empty($display_message)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // File uploaded successfully, now insert into database
            $imagePath = basename($image);

            // Prepare SQL statement with placeholders
            $sql = "INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Bind parameters to the statement
            $stmt->bind_param("sdss", $productName, $price, $description, $image);

            // Execute statement
            if ($stmt->execute()) {
                $display_message = "Product added successfully!";
            } else {
                $display_message = "Failed to add product to database: " . htmlspecialchars($stmt->error);
            }
        } else {
            $display_message = "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../../css/add_product.css">
</head>
<body>

    <!-----nav-bar--->
    <div class="split">
    <?php include '../split/nav_bar.php'; ?>
    </div>

    <div class="split">

    <div id="main">
        <div id="sub_main">
            <!-- Display Message Section -->
            <?php if (!empty($display_message)) { ?>
                <div class="display_message">
                    <span><?php echo $display_message; ?></span>
                    <i class='fas fa-times' onclick='this.parentElement.style.display=`none`'></i>
                </div>
            <?php } ?>

            <div class="container">
                <h2>Add Products</h2>
                <div  class="form-container">   
                <form action="add_product.php" method="post" enctype="multipart/form-data">
                    <input type="text" id="product_name" name="product_name" placeholder="Enter product name" required>
                    <input type="number" id="price" name="price" placeholder="Enter product price" required>
                    <textarea id="description" name="description" placeholder="Enter product description" required></textarea>
                    <input type="file" id="image" name="image" accept="image/*" required>
                    <button type="submit" name="submit">Add Product</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    
</body>
</html>


