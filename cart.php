<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product details from POST data
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productImage = $_POST['product_image'];
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $message = isset($_POST['cake_message']) ? $_POST['cake_message'] : '';
    
    // Create cart item array
    $cartItem = [
        'id' => $productId,
        'name' => $productName,
        'image' => $productImage,
        'price' => $price,
        'weight' => $weight,
        'message' => $message,
        'quantity' => 1 // Default quantity
    ];
    
    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if product already in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId && $item['weight'] == $weight) {
            $item['quantity'] += 1;
            $found = true;
            break;
        }
    }
    
    // If not found, add new item
    if (!$found) {
        $_SESSION['cart'][] = $cartItem;
    }
    
    // Redirect to cart page
    header('Location: view_cart.php');
    exit();
}
?>