<?php
// Start session with secure settings
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'cookie_secure' => true,
        'cookie_httponly' => true,
        'use_strict_mode' => true
    ]);
}

// Set response header
header('Content-Type: application/json');

try {
    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // Get and sanitize input data
    $addressType = isset($_POST['address_type']) ? htmlspecialchars(trim($_POST['address_type']), ENT_QUOTES, 'UTF-8') : 'WORK';
    $customerName = isset($_POST['customer_name']) ? htmlspecialchars(trim($_POST['customer_name']), ENT_QUOTES, 'UTF-8') : '';
    $address = isset($_POST['address']) ? htmlspecialchars(trim($_POST['address']), ENT_QUOTES, 'UTF-8') : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone']), ENT_QUOTES, 'UTF-8') : '';

    // Validate required fields
    if (empty($customerName)) {
        throw new Exception('Customer name is required');
    }
    if (empty($address)) {
        throw new Exception('Address is required');
    }
    if (empty($phone)) {
        throw new Exception('Phone number is required');
    }
    if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        throw new Exception('Invalid phone number format (10-15 digits only)');
    }

    // Save to session
    $_SESSION['address_type'] = $addressType;
    $_SESSION['customer_name'] = $customerName;
    $_SESSION['address'] = $address;
    $_SESSION['phone'] = $phone;

    // Verify session was updated
    if ($_SESSION['address'] !== $address) {
        throw new Exception('Session update failed');
    }

    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Address updated successfully',
        'data' => [
            'address_type' => $addressType,
            'customer_name' => $customerName,
            'address' => $address,
            'phone' => $phone
        ]
    ]);

} catch (Exception $e) {
    // Return error response
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}