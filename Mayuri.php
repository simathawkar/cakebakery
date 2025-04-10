<?php 
include 'db_connection.php';
session_start();

// Initialize variables
$isLoggedIn = isset($_SESSION['user_id']); // Check if user is logged in
$cartCount = 0; // Initialize cart count

// If user is logged in, get cart count from database
if ($isLoggedIn) {
    $userId = $_SESSION['user_id'];
    $cartQuery = "SELECT COUNT(*) as count FROM cart WHERE user_id = '$userId'";
    $cartResult = mysqli_query($conn, $cartQuery);
    if ($cartResult) {
        $cartData = mysqli_fetch_assoc($cartResult);
        $cartCount = $cartData['count'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Bakery</title>
    <link rel="shortcut icon" type="image" href="logo.png">
    <link rel="stylesheet" href="Mayuri.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <!-- Fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Uchen&display=swap" rel="stylesheet">
    <!-- Icons link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="all-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand" href="#" id="logo"><img src="images/logo.png" alt="" width="50px">Cake Bakery</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span><img src="menu.png" alt="" width="30px"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#product-card">Cake</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                </ul>
            </div>
            <div class="icons">
                <!-- Right Side Icons -->
                <div class="d-flex align-items-center">
                    <?php if($isLoggedIn): ?>
                        <div class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle fa-lg"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>My Profile</a></li>
                                <li><a class="dropdown-item" href="orders.php"><i class="fas fa-box me-2"></i>My Orders</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="nav-link">
                            <i class="fas fa-user fa-lg"></i>
                        </a>
                    <?php endif; ?>
                    
                    <a href="cart.php" class="nav-link position-relative ms-3">
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
        </nav>

        <!-- Home Section -->
        <div class="home">
            <div class="content">
                <h3>Delicious<br>Cakes Bakery</h3>
                <h2>Category&nbsp;<span class="changecontent"></span></h2>
                <a href="#product-card" class="btn">Order Now</a>
            </div>
            <div class="img">
                <img src="images/background.png" alt="">
            </div>
        </div>

        <!-- Top Cards -->
        <div class="container" id="box">
            <div class="row">
                <div class="col-md-3 py-3 py-md-0">
                    <div class="card"><img src="images/box1.jpg" alt=""></div>
                </div>
                <div class="col-md-3 py-3 py-md-0">
                    <div class="card"><img src="images/box2.jpg" alt=""></div>
                </div>
                <div class="col-md-3 py-3 py-md-0">
                    <div class="card"><img src="images/box3.jpg" alt=""></div>
                </div>
            </div>
        </div>
     
        <section class="experience-flavour">
            <h1>Experience Flavours</h1>
            <a href="chocolate.php"><button class="ellipse-button">Chocolate</button></a>
            <a href="Fruit.php"><button class="ellipse-button">Fruit</button></a>
            <a href="Anniversary.html"><button class="ellipse-button">Anniversary</button></a>
            <a href="kit.kat.html"><button class="ellipse-button">Retirement</button></a>
            <a href="Butterscotch.html"><button class="ellipse-button">Farewell</button></a>
        </section>
        
        <!-- Product Cards -->
        <section id="product-card">
            <div class="container">
                <h1>CAKE</h1>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c1.png" alt="">
                            <div class="card-body">
                                <h3>Cream Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star"></i>
                                    <i class="bx bxs-star"></i>
                                </div>
                                
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c1.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c2.png" alt="">
                            <div class="card-body">
                                <h3>Chocolate Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c1.png">
                                    <button>Order Now</button>
                                </a></span>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c3.jpg" alt="">
                            <div class="card-body">
                                <h3>Slice Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c3.jpg">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c4.png" alt="">
                            <div class="card-body">
                                <h3>Fruit Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c4.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c5.png" alt="">
                            <div class="card-body">
                                <h3>Chees Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c5.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c6.png" alt="">
                            <div class="card-body">
                                <h3>Vanilla Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c6.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c7.png" alt="">
                            <div class="card-body">
                                <h3>Lemon Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c7.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c8.png" alt="">
                            <div class="card-body">
                                <h3>Black Forest Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c8.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c9.png" alt="">
                            <div class="card-body">
                                <h3>Red Velvet Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c9.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c10.png" alt="">
                            <div class="card-body">
                                <h3>Coffe Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c10.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c11.png" alt="">
                            <div class="card-body">
                                <h3>Truffle Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=images/c11.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <img src="images/c12.jpeg" alt="">
                            <div class="card-body">
                                <h3>Pineapple Cake</h3>
                                <div class="star">
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star checked"></i>
                                    <i class="bx bxs-star "></i>
                                    <i class="bx bxs-star "></i>
                                </div>
                                <span><a href="test.php?product=cream-cake&price=180&image=/images/c12.png">
                                    <button>Order Now</button>
                                </a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Occasion Special Cakes -->
        <section class="experience-flavour">
            <h1>Occasion Special Cakes</h1>
            <a href="Birthday.html"><button class="ellipse-button">Birthday</button></a>
            <a href="Fruit.html"><button class="ellipse-button">Baby Shower</button></a>
            <a href="Anniversary.html"><button class="ellipse-button">Anniversary</button></a>
            <a href="kit.kat.html"><button class="ellipse-button">Retirement</button></a>
            <a href="Butterscotch.html"><button class="ellipse-button">Farewell</button></a>
        </section>

        <!-- Gallery -->
        <section id="gallery">
            <div class="container">
                <h1>OUR GALLERY</h1>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Donuts</h3>
                            </div>
                            <img src="images/01.png" alt="Donuts">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Ice Cream</h3>
                            </div>
                            <img src="images/02.png" alt="Ice Cream">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Cup Cake</h3>
                            </div>
                            <img src="images/03.png" alt="Cup Cake">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Delicious Cake</h3>
                            </div>
                            <img src="images/04.png" alt="Delicious Cake">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Chocolate Cake</h3>
                            </div>
                            <img src="images/05.png" alt="Chocolate Cake">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Slice Cake</h3>
                            </div>
                            <img src="images/06.png" alt="Slice Cake">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Chocolate pastry</h3>
                            </div>
                            <img src="images/08.png" alt="cream cake">
                        </div>
                    </div>
                    <div class="col-md-3 py-3 py-md-0">
                        <div class="card">
                            <div class="overlay">
                                <h3 class="text-center">Cream Cake</h3>
                            </div>
                            <img src="images/07.png" alt="cream">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <style>
            #gallery .card img {
                width: 100%;
                height: auto;
                object-fit: cover;
                max-height: 40%;
            }
        </style>

        <!-- About Us -->
        <section id="about">
            <h1>About Us</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <img src="images/about.png" alt="About Us Image">
                    </div>
                </div>
                <div class="col-md-6">
                    <p>
                        Welcome to Cake Bakery, your go-to destination for delicious, freshly baked cakes delivered right to your doorstep. We specialize in creating mouthwatering cakes for all occasions—birthdays, anniversaries, weddings, and celebrations of all kinds. Our expert bakers use only the finest ingredients to craft cakes that not only look stunning but taste absolutely divine.
                    </p>
                    <div id="btn">
                        <button>Learn More</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-container">
                <div class="footer-section">
                    <h3>About Us</h3>
                    <p>We are a premium cake delivery service, offering a wide range of delicious cakes for all occasions.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category Cakes</a></li>
                        <li><a href="#">Order Now</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <ul>
                        <li>Email: info@cakeshop.com</li>
                        <li>Phone: +123 456 7890</li>
                        <li>Address: 123 Cake Street, Sweet City</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <ul class="social-links">
                        <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 Online Cake Order. All rights reserved.</p>
            </div>
            <div class="credite text-center">
                Designed By <a href="a"><span>Mayuri Wanjari</span></a>
            </div>
        </footer>
    </div>
</body>
</html> 