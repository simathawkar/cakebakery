<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = isset($_POST['key']) ? intval($_POST['key']) : null;
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    
    if ($key !== null && isset($_SESSION['cart'][$key])) {
        if ($action === 'increase') {
            $_SESSION['cart'][$key]['quantity'] += 1;
        } elseif ($action === 'decrease' && $_SESSION['cart'][$key]['quantity'] > 1) {
            $_SESSION['cart'][$key]['quantity'] -= 1;
        }
        
        // Update cart count
        $totalItems = 0;
        foreach ($_SESSION['cart'] as $item) {
            $totalItems += $item['quantity'];
        }
        $_SESSION['cart_count'] = $totalItems;
    }
}

header("Location: cart.php");
exit();
?>