<?php 
// Start session at the very beginning
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connection.php';

// Get product details from URL parameters
$productName = isset($_GET['product']) ? htmlspecialchars($_GET['product']) : 'Product';
$productPrice = isset($_GET['price']) ? intval($_GET['price']) : 0;
$productImage = isset($_GET['image']) ? htmlspecialchars($_GET['image']) : 'default.png';
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0; // Added product ID

// Convert URL parameter to display name
$displayName = str_replace('-', ' ', ucwords($productName));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $displayName; ?> - Cake Bakery</title>
    <link rel="shortcut icon" type="image" href="logo.png">
    <link rel="stylesheet" href="Index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
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

        .product-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .product-image-container {
            padding: 20px;
        }

        .product-image {
            width: 100%;
            border-radius: 8px;
            height: 400px;
            object-fit: cover;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .product-details {
            padding: 25px;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        .product-rating {
            color: #ff9900;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .price-card {
            background: #fff9f9;
            border: 1px solid #ffdddd;
            padding: 1.25rem;
            border-radius: 8px;
            margin: 1.5rem 0;
        }

        .price-label {
            font-size: 1rem;
            color: #666;
        }

        .current-price {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0.5rem 0;
        }

        .weight-option {
            padding: 0.5rem 1.25rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
            border: 1px solid #ddd;
            background: #f5f5f5;
            color: #333;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .weight-option:hover {
            background: #e0e0e0;
            color: #333;
        }

        .weight-option.active {
            background: var(--primary-color);
            color: white !important;
            border-color: var(--primary-color);
        }

        .weight-option.active:hover {
            background: #b30000;
            color: white !important;
        }

        .form-section {
            margin: 1.5rem 0;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(213, 0, 0, 0.1);
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

        .btn-cart {
            background-color: var(--secondary-color);
            color: #333;
            border: none;
        }

        .btn-cart:hover {
            background-color: #e6b800;
            transform: translateY(-2px);
        }

        .btn-buy {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-buy:hover {
            background-color: #b30000;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .product-card {
                flex-direction: column;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="product-container">
        <div class="product-card d-flex flex-column flex-md-row">
            <div class="product-image-container col-md-6">
                <img src="<?php echo $productImage; ?>" alt="<?php echo $displayName; ?>" class="product-image">
            </div>

            <div class="product-details col-md-6">
                <h1 class="product-title"><?php echo $displayName; ?></h1>
                <div class="product-rating">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="ms-2">4.9 (5251 reviews)</span>
                </div>
                
                <div class="price-card">
                    <span class="price-label">Price:</span>
                    <div class="current-price">₹ <span id="display-price"><?php echo $productPrice; ?></span></div>
                    <small class="text-muted">(Inclusive of all taxes)</small>
                </div>

                <form action="buy.php" method="POST" id="order-form">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $displayName; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $productImage; ?>">
                    
                    <div class="form-section">
                        <label class="form-label">Select Weight:</label>
                        <div class="weight-options">
                            <button type="button" class="weight-option" data-price="<?php echo $productPrice * 0.5; ?>" onclick="updatePrice(this)">0.5 Kg</button>
                            <button type="button" class="weight-option active" data-price="<?php echo $productPrice; ?>" onclick="updatePrice(this)">1 Kg</button>
                            <button type="button" class="weight-option" data-price="<?php echo $productPrice * 1.5; ?>" onclick="updatePrice(this)">1.5 Kg</button>
                            <button type="button" class="weight-option" data-price="<?php echo $productPrice * 2; ?>" onclick="updatePrice(this)">2 Kg</button>
                        </div>
                        <input type="hidden" name="weight" id="selected-weight" value="1 Kg">
                        <input type="hidden" name="price" id="selected-price" value="<?php echo $productPrice; ?>">
                    </div>

                    <div class="form-section">
                        <label for="cake-message" class="form-label">Cake Message (Optional):</label>
                        <input type="text" class="form-control" id="cake-message" name="cake_message" placeholder="Enter message to be written on cake" maxlength="30">
                    </div>

                    <div class="action-buttons">
                       
                        
                        <button type="submit" form="cart-form" class="btn btn-cart">
                            <i class="fas fa-shopping-cart me-1"></i> Add To Cart
                        </button>
                        <button type="submit" class="btn btn-buy" name="buy_now">
                            <i class="fas fa-bolt me-1"></i> Buy Now | ₹ <span id="buy-now-price"><?php echo $productPrice; ?></span>
                        </button>
                    </div>
                </form>

                <form action="cart.php" method="POST" id="cart-form" class="d-none">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $displayName; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $productImage; ?>">
                    <input type="hidden" name="price" id="cart-price" value="<?php echo $productPrice; ?>">
                    <input type="hidden" name="weight" id="cart-weight" value="1 Kg">
                    <input type="hidden" name="cake_message" id="cart-message" value="">
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updatePrice(button) {
            // Get the price and weight
            const price = button.getAttribute('data-price');
            const weight = button.textContent;
            
            // Update displayed prices
            document.getElementById('display-price').textContent = price;
            document.getElementById('buy-now-price').textContent = price;
            
            // Update hidden inputs for both forms
            document.getElementById('selected-weight').value = weight;
            document.getElementById('selected-price').value = price;
            document.getElementById('cart-weight').value = weight;
            document.getElementById('cart-price').value = price;
            
            // Update active button
            document.querySelectorAll('.weight-option').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');
        }

        // Update cake message for cart when changed
        document.getElementById('cake-message').addEventListener('input', function() {
            document.getElementById('cart-message').value = this.value;
        });
    </script>
</body>
</html>