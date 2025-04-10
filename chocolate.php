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
    <title>Document</title>
    <style>
    #product-card h1 {
        text-align: center;
        margin-bottom: 30px;
        color:rgb(29, 26, 26);  /* Adjust color as needed */
    }
    #product-card h4 {
        text-align: center;
        margin-bottom: 30px;
        color:rgb(17, 3, 3);
    }

    #product-card .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px; /* Negative margin to counteract column padding */
    }

    #product-card .col-md-3 {
        width: 25%;
        padding: 0 15px;
        box-sizing: border-box;
        margin-bottom: 30px;
    }

    #product-card .card {
        position: relative;
        overflow: hidden;
        border: none;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        height: 100%;
    }

    #product-card .card img {
        width: 100%;  /* Ensure image takes full width */
        height: auto; /* Maintain aspect ratio */
        max-height: 250px; /* Limit the max height of images */
        object-fit: cover; /* Ensure image is properly cropped */
    }

    #product-card .card-body {
        padding: 15px;
        text-align: center;
    }

    #product-card .star {
        color: #FFD700;  /* Gold color for stars */
    }

    #product-card .star .bx.bxs-star.checked {
        color: #FFD700;
    }

    #product-card button {
        background-color: #007bff;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #product-card button:hover {
        background-color: #0056b3;
    }

    #product-card .overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    #product-card .card:hover .overlay {
        opacity: 1; /* Show overlay on hover */
    }

    #product-card .overlay button {
        background: transparent;
        border: none;
        color: white;
        cursor: pointer;
    }

    #product-card .overlay button img {
        width: 25px;
        height: 25px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
        #product-card .col-md-3 {
            width: 50%;
        }
    }
    
    @media (max-width: 576px) {
        #product-card .col-md-3 {
            width: 100%;
        }
    }
    </style>
</head>
<body>
    <section id="product-card">
        <div class="container">
          <h1> CHOCOLATE CAKES</h1>
          <div class="row">
            <!-- Product 1 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/e1.png" alt="">
                <div class="card-body">
                  <h4>Rich Chocolate Truffle Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Rich Chocolate Truffle Cake&price=180&image=images/e1.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 2 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/e2.png" alt="">
                <div class="card-body">
                  <h4>Chocolate Vanilla Half & Half Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Chocolate Vanilla Half & Half Cake&price=180&image=images/e2.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>
            
            <!-- Product 3 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/e3.png" alt="">
                <div class="card-body">
                  <h4>Choco Ferrero Rocher Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Choco Ferrero Rocher Cake&price=180&image=images/e3.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 4 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/e4.png" alt="">
                <div class="card-body">
                  <h4> Chocolate Loaded Glazed Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Chocolate Loaded Glazed Cake&price=180&image=images/e4.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>
  
            <!-- Product 5 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/e5.png" alt="">
                <div class="card-body">
                  <h4>Chocolate Cake With Love More Toppe</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Chocolate Cake With Love More Toppe&price=180&image=images/e5.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 6 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/e6.png" alt="">
                <div class="card-body">
                  <h4>Ferrero Infused Celebration Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Ferrero Infused Celebration Cake&price=180&image=images/e6.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 7 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/e7.png" alt="">
                <div class="card-body">
                  <h4>Pineapple Vanilla Caramel Crunch Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Pineapple Vanilla Caramel Crunch Cake&price=180&image=images/e7.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 8 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/e8.png" alt="">
                <div class="card-body">
                  <h4>Fresh Fruits Topped Almonds Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Fresh Fruits Topped Almonds Cake&price=180&image=images/e8.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</body>
</html>