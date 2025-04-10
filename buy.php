<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connection.php';

// Get form data
$productName = isset($_POST['product_name']) ? htmlspecialchars($_POST['product_name']) : 'Product';
$productImage = isset($_POST['product_image']) ? htmlspecialchars($_POST['product_image']) : 'default.png';
$weight = isset($_POST['weight']) ? htmlspecialchars($_POST['weight']) : '1 Kg';
$price = isset($_POST['price']) ? intval($_POST['price']) : 0;
$cakeMessage = isset($_POST['cake_message']) ? htmlspecialchars($_POST['cake_message']) : '';

// Address data from session or default
$addressType = isset($_SESSION['address_type']) ? $_SESSION['address_type'] : '';
$customerName = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : '';
$address = isset($_SESSION['address']) ? $_SESSION['address'] : '';
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : '';

// Calculate discount and final price with 5% discount
$discount = $price * 0.05; // 5% discount
$platformFee = 3;
$deliveryCharge = 40;
$totalAmount = $price - $discount + $platformFee + $deliveryCharge;

// Store all necessary data in session
$_SESSION['product_name'] = $productName;
$_SESSION['product_image'] = $productImage;
$_SESSION['weight'] = $weight;
$_SESSION['price'] = $price;
$_SESSION['cake_message'] = $cakeMessage;
$_SESSION['total_amount'] = $totalAmount;
$_SESSION['discount'] = $discount;
$_SESSION['platform_fee'] = $platformFee;
$_SESSION['delivery_charge'] = $deliveryCharge;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Cake Bakery</title>
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

        .order-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
        }

        .order-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 768px) {
            .order-card {
                flex-direction: row;
            }
        }

        .order-image-container {
            padding: 20px;
            flex: 1;
        }

        .order-image {
            width: 100%;
            border-radius: 8px;
            height: 400px;
            object-fit: cover;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .order-details {
            padding: 25px;
            flex: 1;
            border-left: 1px solid #eee;
        }

        .order-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .delivery-section {
            background: #f9f9f9;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .delivery-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .change-address {
            font-size: 0.9rem;
            color: var(--primary-color);
            cursor: pointer;
            text-decoration: underline;
        }

        .customer-info {
            margin-bottom: 1rem;
        }

        .customer-name {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .address {
            color: #666;
            margin: 0.5rem 0;
        }

        .phone {
            color: #666;
        }

        .price-section {
            margin: 1.5rem 0;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px dashed #ddd;
        }

        .price-label {
            color: #666;
        }

        .price-value {
            font-weight: 500;
        }

        .discount {
            color: green;
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

        .savings {
            background: #fff8e1;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
            font-weight: 500;
        }

        .terms {
            font-size: 0.8rem;
            color: #666;
            text-align: center;
            margin-top: 1.5rem;
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

        .btn-continue {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-continue:hover {
            background-color: #b30000;
        }

        .price-display {
            text-align: right;
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 1rem;
        }

        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 1rem;
        }

        .final-price {
            color: var(--primary-color);
        }

        /* Add styles for address modal */
        .modal-content {
            border-radius: 10px;
        }
        .address-type-badge {
            cursor: pointer;
        }
        .address-type-badge.active {
            background-color: var(--primary-color) !important;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <!-- Address Change Modal -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Change Delivery Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addressForm">
                        <div class="mb-3">
                            <label class="form-label">Address Type</label>
                            <div class="d-flex gap-2">
                                <span class="badge address-type-badge <?php echo $addressType === 'HOME' ? 'active bg-primary' : 'bg-secondary'; ?>" data-type="HOME">HOME</span>
                                <span class="badge address-type-badge <?php echo $addressType === 'WORK' ? 'active bg-primary' : 'bg-secondary'; ?>" data-type="WORK">WORK</span>
                                <span class="badge address-type-badge <?php echo $addressType === 'OTHER' ? 'active bg-primary' : 'bg-secondary'; ?>" data-type="OTHER">OTHER</span>
                            </div>
                            <input type="hidden" id="address_type" name="address_type" value="<?php echo $addressType; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $customerName; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Complete Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required><?php echo $address; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="saveAddress()">Save Address</button>
                </div>
            </div>
        </div>
    </div>

    <div class="order-container">
        <div class="order-card">
            <!-- Product Image Container (Remains Constant) -->
            <div class="order-image-container">
                <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="order-image">
                <?php if (!empty($cakeMessage)): ?>
                    <div class="text-center mt-3">
                        <p><strong>Cake Message:</strong> "<?php echo $cakeMessage; ?>"</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Order Details (Form Section) -->
            <div class="order-details">
                <h2 class="order-title">Order Summary</h2>
                
                <div class="delivery-section">
                    <h3 class="delivery-title">
                        Deliver to:
                        <span class="change-address" data-bs-toggle="modal" data-bs-target="#addressModal">Change Address</span>
                    </h3>
                    <div class="customer-info">
                        <div class="customer-name"><?php echo $customerName; ?> <span class="badge bg-secondary"><?php echo $addressType; ?></span></div>
                        <div class="address"><?php echo $address; ?></div>
                        <div class="phone"><?php echo $phone; ?></div>
                    </div>
                </div>

                <div class="price-section">
                    <h4>Price Details</h4>
                    <div class="price-row">
                        <span class="price-label">Price (1 item)</span>
                        <span class="price-value">₹<?php echo number_format($price, 2); ?></span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Discount (5%)</span>
                        <span class="price-value discount">-₹<?php echo number_format($discount, 2); ?></span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Platform Fee</span>
                        <span class="price-value">₹<?php echo number_format($platformFee, 2); ?></span>
                    </div>
                    <div class="price-row">
                        <span class="price-label">Delivery Charges</span>
                        <span class="price-value">₹<?php echo number_format($deliveryCharge, 2); ?> <span class="text-success">FREE Delivery</span></span>
                    </div>
                </div>

                <div class="total-section">
                    <div class="total-row">
                        <span>Total Amount</span>
                        <span>₹<?php echo number_format($totalAmount, 2); ?></span>
                    </div>
                </div>

                <div class="savings">
                    You'll save ₹<?php echo number_format($discount, 2); ?> on this order!
                </div>

                <div class="price-display">
                    <span class="original-price">₹<?php echo number_format($price, 2); ?></span>
                    <span class="final-price">₹<?php echo number_format($totalAmount, 2); ?></span>
                </div>

                <p class="terms">
                    By continuing with the order, you confirm that you are above 18 years of age, and you agree to the  Terms of Use and Privacy Policy
                </p>

                <div class="action-buttons">
                    <button class="btn btn-back" onclick="window.history.back()">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </button>
                    <button class="btn btn-continue" onclick="continueOrder()">
                        <i class="fas fa-arrow-right me-1"></i> Continue
                    </button>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
    // Set up address type selection
    document.querySelectorAll('.address-type-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            document.querySelectorAll('.address-type-badge').forEach(b => {
                b.classList.remove('active', 'bg-primary');
                b.classList.add('bg-secondary');
            });
            this.classList.add('active', 'bg-primary');
            document.getElementById('address_type').value = this.getAttribute('data-type');
        });
    });

    async function saveAddress() {
        // Get form elements
        const form = document.getElementById('addressForm');
        const saveBtn = document.querySelector('#addressModal .btn-primary');
        
        // Show loading state
        saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
        saveBtn.disabled = true;
        
        try {
            // Send data to server
            const response = await fetch('save_address.php', {
                method: 'POST',
                body: new FormData(form)
            });
            
            const data = await response.json();
            
            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Failed to save address');
            }
            
            // Update the UI with new address data
            updateAddressDisplay(data.data);
            
            // Close the modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addressModal'));
            modal.hide();
            
            // Show success message
            showToast('Address updated successfully!', 'success');
            
        } catch (error) {
            console.error('Error:', error);
            showToast(error.message || 'Error saving address', 'danger');
        } finally {
            // Reset button state
            saveBtn.innerHTML = 'Save Address';
            saveBtn.disabled = false;
        }
    }

    function updateAddressDisplay(addressData) {
        // Update the displayed address
        document.querySelector('.customer-name').innerHTML = 
            `${addressData.customer_name} <span class="badge bg-secondary">${addressData.address_type}</span>`;
        document.querySelector('.address').textContent = addressData.address;
        document.querySelector('.phone').textContent = addressData.phone;
        
        // Update session data in case page reloads
        if (typeof updateSessionData === 'function') {
            updateSessionData(addressData);
        }
    }

    function showToast(message, type = 'success') {
        // Create or reuse toast element
        let toastEl = document.getElementById('addressToast');
        if (!toastEl) {
            toastEl = document.createElement('div');
            toastEl.id = 'addressToast';
            toastEl.className = 'position-fixed bottom-0 end-0 p-3';
            toastEl.style.zIndex = '11';
            document.body.appendChild(toastEl);
        }
        
        toastEl.innerHTML = `
            <div class="toast show align-items-center text-white bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        
        // Auto-hide after 3 seconds
        setTimeout(() => {
            const toast = new bootstrap.Toast(toastEl.querySelector('.toast'));
            toast.hide();
        }, 3000);
    }

    function continueOrder() {
        // Show loading state
        const continueBtn = document.querySelector('.btn-continue');
        continueBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Processing...';
        continueBtn.disabled = true;
        
        // Submit the form data to payment.php
        window.location.href = 'payment.php';
    }
    </script>
</body>
</html>