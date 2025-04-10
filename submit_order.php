<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product details from form
    $productName = $_POST['product_name'] ?? '';
    $productImage = $_POST['product_image'] ?? '';
    $weight = $_POST['weight'] ?? '1 Kg';
    $price = $_POST['price'] ?? 0;
    $cakeMessage = $_POST['cake_message'] ?? '';
    
    // Validate data
    if (empty($productName) || empty($productImage) || $price <= 0) {
        die("Invalid product data");
    }
    
    // Create cart item array
    $cartItem = [
        'name' => $productName,
        'image' => $productImage,
        'weight' => $weight,
        'price' => (float)$price,
        'message' => $cakeMessage,
        'quantity' => 1
    ];
    
    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // Check if product already exists in cart
    $itemExists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $productName && $item['weight'] === $weight) {
            $item['quantity'] += 1;
            $itemExists = true;
            break;
        }
    }
    
    // If not exists, add to cart
    if (!$itemExists) {
        $_SESSION['cart'][] = $cartItem;
    }
    
    // Update cart count in session
    $_SESSION['cart_count'] = count($_SESSION['cart']);
    
    // Redirect to cart page or back to product
    header('Location: cart.php');
    exit();
} else {
    // If not POST request, redirect to home
    header('Location: index.php');
    exit();
}
?>