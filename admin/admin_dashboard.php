<?php
include 'db_connection.php';
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

// Get counts for dashboard
$product_count = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];
$order_count = $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0];
$pending_orders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cake Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 10px 15px;
            margin-bottom: 5px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .dashboard-card {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .card-icon {
            font-size: 2rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3">
                    <h4 class="text-center">Cake Bakery Admin</h4>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="admin_dashboard.php">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_products.php">
                                <i class="fas fa-birthday-cake"></i> Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_orders.php">
                                <i class="fas fa-shopping-cart"></i> Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Dashboard</h2>
                    <div class="text-right">
                        <span class="mr-3">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card dashboard-card bg-primary text-white p-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Products</h5>
                                    <h2><?php echo $product_count; ?></h2>
                                </div>
                                <div class="card-icon">
                                    <i class="fas fa-birthday-cake"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card dashboard-card bg-success text-white p-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Total Orders</h5>
                                    <h2><?php echo $order_count; ?></h2>
                                </div>
                                <div class="card-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card dashboard-card bg-warning text-white p-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Pending Orders</h5>
                                    <h2><?php echo $pending_orders; ?></h2>
                                </div>
                                <div class="card-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card dashboard-card bg-info text-white p-3">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5>Admin</h5>
                                    <h2>1</h2>
                                </div>
                                <div class="card-icon">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Orders</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $recent_orders = $conn->query("
                            SELECT o.id, o.customer_name, o.total_amount, o.order_date, o.status 
                            FROM orders o 
                            ORDER BY o.order_date DESC 
                            LIMIT 5
                        ");
                        
                        if ($recent_orders->num_rows > 0) {
                            echo '<table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            
                            while ($order = $recent_orders->fetch_assoc()) {
                                $status_class = '';
                                switch ($order['status']) {
                                    case 'pending': $status_class = 'badge-warning'; break;
                                    case 'processing': $status_class = 'badge-primary'; break;
                                    case 'completed': $status_class = 'badge-success'; break;
                                    case 'cancelled': $status_class = 'badge-danger'; break;
                                }
                                
                                echo '<tr>
                                        <td>#' . $order['id'] . '</td>
                                        <td>' . htmlspecialchars($order['customer_name']) . '</td>
                                        <td>Rs.' . number_format($order['total_amount'], 2) . '</td>
                                        <td>' . date('M d, Y', strtotime($order['order_date'])) . '</td>
                                        <td><span class="badge ' . $status_class . '">' . ucfirst($order['status']) . '</span></td>
                                        <td><a href="admin_order_view.php?id=' . $order['id'] . '" class="btn btn-sm btn-info">View</a></td>
                                    </tr>';
                            }
                            
                            echo '</tbody></table>';
                        } else {
                            echo '<p>No recent orders found.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>