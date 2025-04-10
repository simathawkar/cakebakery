<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connection.php';

// Get order data from session or POST
$productName = isset($_SESSION['product_name']) ? htmlspecialchars($_SESSION['product_name']) : 'Product';
$productImage = isset($_SESSION['product_image']) ? htmlspecialchars($_SESSION['product_image']) : 'default.png';
$weight = isset($_SESSION['weight']) ? htmlspecialchars($_SESSION['weight']) : '1 Kg';
$price = isset($_SESSION['price']) ? intval($_SESSION['price']) : 0;
$cakeMessage = isset($_SESSION['cake_message']) ? htmlspecialchars($_SESSION['cake_message']) : '';
$totalAmount = isset($_SESSION['total_amount']) ? $_SESSION['total_amount'] : 0;

// Address data from session
// Address data from session
$addressType = isset($_SESSION['address_type']) ? $_SESSION['address_type'] : '';
$customerName = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : '';
$address = isset($_SESSION['address']) ? $_SESSION['address'] : '';
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment - Cake Bakery</title>
    <link rel="shortcut icon" type="image" href="logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #d50000;
            --secondary-color: #ffcc00;
            --dark-color: #333;
            --light-bg: #f8f8f8;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--light-bg);
            color: var(--dark-color);
        }

        .payment-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
        }

        .payment-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 768px) {
            .payment-card {
                flex-direction: row;
            }
        }

        .payment-image-container {
            padding: 20px;
            flex: 1;
        }

        .payment-image {
            width: 100%;
            border-radius: 8px;
            height: 400px;
            object-fit: cover;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .payment-details {
            padding: 25px;
            flex: 1;
            border-left: 1px solid #eee;
        }

        .payment-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .secure-badge {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            margin-left: 10px;
        }

        .secure-badge i {
            margin-right: 5px;
        }

        .payment-methods {
            margin-top: 2rem;
        }

        .payment-method {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-method:hover {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 1px var(--primary-color);
        }

        .payment-method.active {
            border-color: var(--primary-color);
            background-color: #fff5f5;
        }

        .payment-method-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .payment-method-title {
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .payment-method-icon {
            width: 30px;
            margin-right: 10px;
        }

        .payment-method-details {
            font-size: 0.9rem;
            color: #666;
            margin-top: 10px;
        }

        .savings-badge {
            background-color: #fff8e1;
            color: #ff9800;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-left: 10px;
        }

        .total-section {
            margin: 1.5rem 0;
            padding-top: 1rem;
            border-top: 2px solid #ddd;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .price-display {
            text-align: right;
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 1rem;
        }

        .final-price {
            color: var(--primary-color);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            flex: 1;
        }

        .btn-back {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn-back:hover {
            background-color: #e0e0e0;
        }

        .btn-pay {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-pay:hover {
            background-color: #b30000;
        }

        /* Card form styles */
        .card-form {
            display: none;
            margin-top: 15px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 6px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .card-icons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .card-icon {
            width: 40px;
            height: 25px;
            object-fit: contain;
        }

        .row {
            display: flex;
            gap: 15px;
        }

        .col {
            flex: 1;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="payment-container">
        <div class="payment-card">
            <!-- Product Image Container (Constant) -->
            <div class="payment-image-container">
                <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="payment-image">
                <?php if (!empty($cakeMessage)): ?>
                    <div class="text-center mt-3">
                        <p><strong>Cake Message:</strong> "<?php echo $cakeMessage; ?>"</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Payment Details Section -->
            <div class="payment-details">
                <h2 class="payment-title">
                    Payment Options
                    <span class="secure-badge">
                        <i class="fas fa-lock"></i> 100% Secure
                    </span>
                </h2>
                
                <div class="total-section">
                    <div class="total-row">
                        <span>Total Amount</span>
                        <span class="text-danger">▼ Rs.<?php echo number_format($totalAmount, 2); ?></span>
                    </div>
                </div>

                <div class="payment-methods">
                    <!-- Credit/Debit Card Option -->
                    <div class="payment-method active" id="cardMethod">
                        <div class="payment-method-header">
                            <div class="payment-method-title">
                                <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Cards" class="payment-method-icon">
                                Credit / Debit / ATM Card
                            </div>
                            <span class="savings-badge">Save up to Rs.15 • 230 offers available</span>
                        </div>
                        <div class="payment-method-details">
                            Add and secure cards as per RBI guidelines
                        </div>
                        
                        <!-- Card Form (shown when this method is active) -->
                        <div class="card-form" id="cardForm" style="display: block;">
                            <div class="form-group">
                                <label class="form-label">Card Number</label>
                                <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Name on Card</label>
                                <input type="text" class="form-control" placeholder="Name as on card">
                            </div>
                            
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control" placeholder="MM/YY">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="form-label">CVV</label>
                                        <input type="text" class="form-control" placeholder="123" maxlength="3">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-icons">
                                <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Visa" class="card-icon">
                                <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Mastercard" class="card-icon">
                                <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Amex" class="card-icon">
                                <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="RuPay" class="card-icon">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Net Banking Option -->
                    <div class="payment-method" id="netBankingMethod">
                        <div class="payment-method-header">
                            <div class="payment-method-title">
                                <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Net Banking" class="payment-method-icon">
                                Net Banking
                            </div>
                        </div>
                        <div class="payment-method-details">
                            Select your bank from 50+ options
                        </div>
                    </div>
                    
                    <!-- UPI Option -->
                    <div class="payment-method" id="upiMethod">
                        <div class="payment-method-header">
                            <div class="payment-method-title">
                                <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="UPI" class="payment-method-icon">
                                UPI
                            </div>
                            <span class="savings-badge">Up to Rs.15 instant saving on UPI</span>
                        </div>
                        <div class="payment-method-details">
                            Pay by any UPI app
                        </div>
                    </div>
                    
                    <!-- Cash on Delivery Option -->
                    <div class="payment-method" id="codMethod">
                        <div class="payment-method-header">
                            <div class="payment-method-title">
                                <img src="https://cdn-icons-png.flaticon.com/512/196/196578.png" alt="Cash on Delivery" class="payment-method-icon">
                                Cash on Delivery
                            </div>
                        </div>
                        <div class="payment-method-details">
                            Pay when you receive your order
                        </div>
                    </div>
                </div>

                <div class="price-display">
                    <span class="final-price">Pay Rs.<?php echo number_format($totalAmount, 2); ?></span>
                </div>

                <div class="action-buttons">
                <button class="btn btn-back" onclick="window.history.back()">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </button>
                    <button class="btn btn-pay" id="payButton">
                        <i class="fas fa-lock me-1"></i> Pay Securely
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Payment method selection
        document.querySelectorAll('.payment-method').forEach(method => {
            method.addEventListener('click', function() {
                // Remove active class from all methods
                document.querySelectorAll('.payment-method').forEach(m => {
                    m.classList.remove('active');
                    const formId = m.id.replace('Method', 'Form');
                    const form = document.getElementById(formId);
                    if(form) form.style.display = 'none';
                });
                
                // Add active class to clicked method
                this.classList.add('active');
                
                // Show corresponding form if exists
                const formId = this.id.replace('Method', 'Form');
                const form = document.getElementById(formId);
                if(form) form.style.display = 'block';
                
                // Update pay button text based on selected method
                const methodName = this.querySelector('.payment-method-title').textContent.trim();
                updatePayButton(methodName);
            });
        });

        function updatePayButton(methodName) {
            const payButton = document.getElementById('payButton');
            if(methodName.includes('Cash on Delivery')) {
                payButton.innerHTML = '<i class="fas fa-shopping-bag me-1"></i> Place Order (COD)';
            } else if(methodName.includes('UPI')) {
                payButton.innerHTML = '<i class="fas fa-mobile-alt me-1"></i> Pay via UPI';
            } else if(methodName.includes('Net Banking')) {
                payButton.innerHTML = '<i class="fas fa-university me-1"></i> Pay via Net Banking';
            } else {
                payButton.innerHTML = '<i class="fas fa-lock me-1"></i> Pay Securely';
            }
        }

        // Format card number input
        document.querySelector('input[placeholder="1234 5678 9012 3456"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s+/g, '');
            if(value.length > 0) {
                value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
            }
            e.target.value = value;
        });

        // Format expiry date input
        document.querySelector('input[placeholder="MM/YY"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if(value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });

        // Handle pay button click
        document.getElementById('payButton').addEventListener('click', function() {
            // Here you would typically validate the form and process payment
            // For demo, we'll just show an alert
            const activeMethod = document.querySelector('.payment-method.active .payment-method-title').textContent.trim();
            alert(Processing payment via ${activeMethod});
            
            // In a real application, you would submit the form to your payment processor
            // window.location.href = 'order_confirmation.php';
        });
    </script>
</body>
</html>



