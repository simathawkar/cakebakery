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
          <h1> Farewell Cakes</h1>
          <div class="row">
            <!-- Product 1 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/p1.png" alt="">
                <div class="card-body">
                  <h4>Smiley Farewell Cake </h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Smiley Farewell Cake&price=180&image=images/p1.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 2 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/p2.png" alt="">
                <div class="card-body">
                  <h4>Good Bye Farewell Red Velvet Chocolate</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Good Bye Farewell Red Velvet Chocolate&price=180&image=images/p2.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>
            
            <!-- Product 3 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/p3.png" alt="">
                <div class="card-body">
                  <h4>Travel Tales Farewell Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Travel Tales Farewell Cake&price=180&image=images/p3.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 4 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/p4.png" alt="">
                <div class="card-body">
                  <h4>Fruits N Blooms Farewell Cake </h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Fruits N Blooms Farewell Cake&price=180&image=images/p4.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>
  
            <!-- Product 5 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/p5.png" alt="">
                <div class="card-body">
                  <h4>Leader Farewell Cake
                  </h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Leader Farewell Cake
                                        &price=180&image=images/p5.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 6 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/p6.png" alt="">
                <div class="card-body">
                  <h4>Bon Voyage Farewell Cake </h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Bon Voyage Farewell Cake &price=180&image=images/p6.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 7 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/p7.png" alt="">
                <div class="card-body">
                  <h4>Quirky Farewell Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Quirky Farewell Cake&price=180&image=images/p7.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 8 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/p8.png" alt="">
                <div class="card-body">
                  <h4>Good Luck Farewell Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Good Luck Farewell Cake&price=180&image=images/p8.png">
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