<?php
// Start session if not already started (only if included before main file)
$skip_session_start = true;
if (session_status() === PHP_SESSION_NONE && !isset($skip_session_start)) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$cartCount = $_SESSION['cart_count'] ?? 0;
?>

<nav class="navbar navbar-expand-lg navbar-dark" id="main-navbar">
    <div class="container">
        <!-- Brand Logo with Animation -->
        <a class="navbar-brand" href="Index.php" id="logo">
            <img src="images/logo.png" alt="Cake Bakery Logo" width="50" class="d-inline-block align-top me-2 logo-img">
            <span class="brand-text">Cake Bakery</span>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Main Navigation -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item mx-1">
                    <a class="nav-link" href="Index.php#home">
                        <i class="fas fa-home d-lg-none me-2"></i>Home
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="Index.php#cake">
                        <i class="fas fa-birthday-cake d-lg-none me-2"></i>Cakes
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="Index.php#gallery">
                        <i class="fas fa-images d-lg-none me-2"></i>Gallery
                    </a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link" href="Index.php#about">
                        <i class="fas fa-info-circle d-lg-none me-2"></i>About Us
                    </a>
                </li>
                <li class="nav-item mx-1 d-lg-none">
                    <?php if($isLoggedIn): ?>
                        <a class="nav-link" href="profile.php">
                            <i class="fas fa-user me-2"></i>My Profile
                        </a>
                    <?php else: ?>
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    <?php endif; ?>
                </li>
                <li class="nav-item mx-1 d-lg-none">
                    <a class="nav-link" href="cart.php">
                        <i class="fas fa-shopping-cart me-2"></i>Cart
                        <?php if($cartCount > 0): ?>
                            <span class="badge bg-danger ms-1"><?= $cartCount ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
            
            <!-- Right Side Icons - Desktop View -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <div class="d-flex align-items-center d-none d-lg-flex">
                <?php if($isLoggedIn): ?>

<html>
                    <body>
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle user-avatar" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg"></i>
                            <span class="ms-1"><?= $_SESSION['user_name'] ?? 'Account' ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>My Profile</a></li>
                            <li><a class="dropdown-item" href="orders.php"><i class="fas fa-box me-2"></i>My Orders</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="nav-link login-btn">
                        <i class="fas fa-user me-1"></i>
                        <span>Login</span>
                    </a>
                <?php endif; ?>
                
                <a href="cart.php" class="nav-link position-relative ms-3 cart-icon">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    <?php if($cartCount > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= $cartCount ?>
                            <span class="visually-hidden">items in cart</span>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
#main-navbar {
    background: linear-gradient(135deg, #573818 0%, #8B5A2B 100%);
    padding: 0.5rem 0;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 1030;
    transition: all 0.3s ease;
}

#main-navbar.scrolled {
    padding: 0.3rem 0;
    background: rgba(87, 56, 24, 0.98);
    backdrop-filter: blur(5px);
}

.container {
    max-width: 1200px;
}

.navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    transition: all 0.3s;
}

.logo-img {
    transition: transform 0.3s;
}

.navbar-brand:hover .logo-img {
    transform: rotate(15deg);
}

.brand-text {
    background: linear-gradient(to right, #FFD700, #FFA500);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.nav-link {
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: all 0.3s;
    position: relative;
    color: white !important;
    border-radius: 4px;
    margin: 0 0.2rem;
}

.nav-link:hover, 
.nav-link:focus {
    color: #fff !important;
    background-color: rgba(255, 215, 0, 0.2);
    transform: translateY(-2px);
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(to right, #FFD700, #FFA500);
    transition: all 0.3s;
    transform: translateX(-50%);
}

.nav-link:hover::after {
    width: 70%;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    background: rgba(87, 56, 24, 0.95);
    backdrop-filter: blur(5px);
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.1);
    margin-top: 8px;
}

.dropdown-item {
    color: white !important;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s;
}

.dropdown-item:hover {
    background-color: rgba(255, 215, 0, 0.2) !important;
    padding-left: 1.8rem;
}

.dropdown-divider {
    border-color: rgba(255,255,255,0.1);
}

.user-avatar {
    display: flex;
    align-items: center;
}

.login-btn {
    display: flex;
    align-items: center;
}

.cart-icon {
    transition: transform 0.3s;
}

.cart-icon:hover {
    transform: scale(1.1);
}

.badge {
    font-size: 0.7rem;
    padding: 0.35em 0.5em;
}

/* Mobile View Styles */
@media (max-width: 991.98px) {
    .navbar-collapse {
        background: rgba(87, 56, 24, 0.98);
        backdrop-filter: blur(5px);
        padding: 1rem;
        border-radius: 0 0 10px 10px;
        margin-top: 8px;
    }
    
    .nav-link {
        padding: 0.75rem 0.5rem;
        margin: 0.25rem 0;
    }
    
    .nav-link::after {
        display: none;
    }
    
    .dropdown-menu {
        background: transparent;
        box-shadow: none;
        border: none;
        margin: 0;
        padding: 0 0 0 1.5rem;
    }
    
    .dropdown-item {
        padding: 0.5rem 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.getElementById('main-navbar');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
});
</script>
</body>
</html>