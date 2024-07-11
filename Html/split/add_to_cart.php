<?php
session_start();
include '../edit_page/db.php';

if (isset($_POST['id'])) {
    $product_id = $_POST['id'];
    
    // Check if the cart session is already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add product to the cart
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }

    echo "Product added to cart.";
}
?>