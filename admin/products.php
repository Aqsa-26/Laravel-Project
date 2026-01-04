<?php
// /admin/products.php
require_once 'config/database.php';
session_start();

// Initialize message
$message = '';

// Get database connection


// Handle stock update request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_stock'])) {
        $product_id = intval($_POST['product_id']);
        $new_status = $_POST['new_status'];
        
        try {
            if ($new_status === 'in_stock') {
                $new_stock = 50;
                
                $stmt = $pdo->prepare("UPDATE products SET stock = :stock, status = :status WHERE id = :id");
                $stmt->execute([
                    ':stock' => $new_stock,
                    ':status' => $new_status,
                    ':id' => $product_id
                ]);
                
                // Get product name for message
                $stmt = $pdo->prepare("SELECT name FROM products WHERE id = :id");
                $stmt->execute([':id' => $product_id]);
                $product = $stmt->fetch();
                
                $message = "✅ Product '{$product['name']}' marked as IN STOCK with 50 units.";
            } else {
                $new_stock = 0;
                
                $stmt = $pdo->prepare("UPDATE products SET stock = :stock, status = :status WHERE id = :id");
                $stmt->execute([
                    ':stock' => $new_stock,
                    ':status' => $new_status,
                    ':id' => $product_id
                ]);
                
                // Get product name for message
                $stmt = $pdo->prepare("SELECT name FROM products WHERE id = :id");
                $stmt->execute([':id' => $product_id]);
                $product = $stmt->fetch();
                
                $message = "⚠️ Product '{$product['name']}' marked as OUT OF STOCK.";
            }
            
            $_SESSION['message'] = $message;
            header("Location: products.php");
            exit();
            
        } catch(PDOException $e) {
            $message = "❌ Error updating product: " . $e->getMessage();
            $_SESSION['message'] = $message;
            header("Location: products.php");
            exit();
        }
    }
}

// Check for stored message
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

// Fetch products with category information
try {
    $stmt = $pdo->query("
        SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        ORDER BY p.created_at DESC
    ");
    $products = $stmt->fetchAll();
    $total_products = count($products);
    
    // Get statistics
    $in_stock = array_filter($products, function($p) { return $p['status'] === 'in_stock'; });
    $out_stock = array_filter($products, function($p) { return $p['status'] === 'out_of_stock'; });
    
    // Get total value of inventory
    $total_value = 0;
    foreach ($products as $product) {
        $total_value += $product['price'] * $product['stock'];
    }
    
} catch(PDOException $e) {
    die("Error fetching products: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        
        header {
            padding: 25px 30px;
            border-bottom: 1px solid #eaeaea;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        h1 {
            font-size: 28px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .subtitle {
            opacity: 0.9;
            font-size: 16px;
        }
        
        .message {
            padding: 15px 30px;
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
            margin: 0 30px 20px;
            border-radius: 4px;
            display: <?php echo !empty($message) ? 'flex' : 'none'; ?>;
            align-items: center;
            gap: 10px;
        }
        
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border-left-color: #dc3545;
        }
        
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 25px 30px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eaeaea;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
        }
        
        .stat-content {
            flex: 1;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .products-table thead {
            background-color: #f8f9fa;
            position: sticky;
            top: 0;
        }
        
        .products-table th {
            text-align: left;
            padding: 18px 20px;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 2px solid #eaeaea;
            white-space: nowrap;
        }
        
        .products-table td {
            padding: 20px;
            border-bottom: 1px solid #eaeaea;
            vertical-align: middle;
        }
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .product-image {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }
        
        .product-details {
            flex: 1;
        }
        
        .product-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
            font-size: 16px;
        }
        
        .product-category {
            display: inline-block;
            background-color: #e8f4fc;
            color: #3498db;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .product-meta {
            display: flex;
            gap: 15px;
            margin-top: 8px;
            font-size: 13px;
            color: #7f8c8d;
        }
        
        .price {
            color: #27ae60;
            font-weight: 700;
            font-size: 16px;
        }
        
        .stock-info {
            text-align: center;
        }
        
        .stock-count {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .stock-label {
            font-size: 12px;
            color: #7f8c8d;
        }
        
        .stock-status {
            display: inline-block;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            min-width: 100px;
            text-align: center;
        }
        
        .in-stock {
            background-color: #d5f4e6;
            color: #27ae60;
        }
        
        .out-of-stock {
            background-color: #ffeaea;
            color: #e74c3c;
        }
        
        .rating {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #f39c12;
            font-weight: 600;
        }
        
        .reviews {
            color: #7f8c8d;
            font-size: 13px;
            margin-left: 5px;
        }
        
        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        
        .btn-view {
            background-color: #e8f4fc;
            color: #3498db;
        }
        
        .btn-view:hover {
            background-color: #d6eaf8;
        }
        
        .btn-edit {
            background-color: #f0f7ff;
            color: #2980b9;
            position: relative;
        }
        
        .btn-edit:hover {
            background-color: #e1ecf7;
        }
        
        .edit-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            min-width: 180px;
            z-index: 10;
            display: none;
        }
        
        .edit-dropdown.show {
            display: block;
        }
        
        .edit-dropdown button {
            width: 100%;
            padding: 12px 20px;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            font-size: 14px;
        }
        
        .edit-dropdown button:hover {
            background-color: #f5f7fa;
        }
        
        .footer {
            padding: 20px 30px;
            border-top: 1px solid #eaeaea;
            color: #7f8c8d;
            font-size: 14px;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .products-table {
                display: block;
                overflow-x: auto;
            }
            
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
            
            .product-info {
                min-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-boxes"></i> Product Management Dashboard</h1>
            <p class="subtitle">Manage inventory, stock status, and product information</p>
        </header>
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?php echo $total_products; ?></div>
                    <div class="stat-label">Total Products</div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #4CAF50 0%, #8BC34A 100%);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?php echo count($in_stock); ?></div>
                    <div class="stat-label">In Stock Products</div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f44336 0%, #FF9800 100%);">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?php echo count($out_stock); ?></div>
                    <div class="stat-label">Out of Stock</div>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #2196F3 0%, #03A9F4 100%);">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">Rs. <?php echo number_format($total_value, 2); ?></div>
                    <div class="stat-label">Total Inventory Value</div>
                </div>
            </div>
        </div>
        
        <?php if (!empty($message)): ?>
        <div class="message <?php echo strpos($message, '❌') !== false ? 'error' : ''; ?>" id="message">
            <i class="fas <?php echo strpos($message, '❌') !== false ? 'fa-exclamation-circle' : 'fa-check-circle'; ?>"></i> 
            <?php echo htmlspecialchars($message); ?>
        </div>
        <?php endif; ?>
        
        <table class="products-table">
            <thead>
                <tr>
                    <th>Product Details</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($total_products > 0): ?>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                                <div class="product-details">
                                    <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                                    <span class="product-category"><?php echo htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?></span>
                                    <div class="product-meta">
                                        <span>ID: #<?php echo str_pad($product['id'], 3, '0', STR_PAD_LEFT); ?></span>
                                        <span>Added: <?php echo date('M j, Y', strtotime($product['created_at'])); ?></span>
                                    </div>
                                    <?php if (!empty($product['description'])): ?>
                                    <p style="margin-top: 8px; font-size: 13px; color: #666; line-height: 1.4;">
                                        <?php echo substr(htmlspecialchars($product['description']), 0, 100); ?>...
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="price">Rs. <?php echo number_format($product['price'], 2); ?></td>
                        <td>
                            <div class="stock-info">
                                <div class="stock-count"><?php echo $product['stock']; ?></div>
                                <div class="stock-label">units</div>
                            </div>
                        </td>
                        <td>
                            <span class="stock-status <?php echo $product['status'] === 'in_stock' ? 'in-stock' : 'out-of-stock'; ?>">
                                <?php echo $product['status'] === 'in_stock' ? 'In Stock' : 'Out of Stock'; ?>
                            </span>
                        </td>
                        <td>
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <?php echo number_format($product['rating'], 1); ?>
                                <span class="reviews">(<?php echo $product['reviews']; ?> reviews)</span>
                            </div>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="btn btn-view">
                                    <i class="fas fa-eye"></i> View
                                </button>
                                <div class="edit-container">
                                    <button class="btn btn-edit" onclick="toggleDropdown(<?php echo $product['id']; ?>)">
                                        <i class="fas fa-edit"></i> Edit Stock
                                    </button>
                                    <div class="edit-dropdown" id="dropdown-<?php echo $product['id']; ?>">
                                        <form method="POST" action="products.php">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <input type="hidden" name="update_stock" value="1">
                                            <input type="hidden" name="new_status" value="in_stock">
                                            <button type="submit" class="form-btn">
                                                <i class="fas fa-check-circle" style="color: #27ae60;"></i> Mark In Stock
                                            </button>
                                        </form>
                                        <form method="POST" action="products.php">
                                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                            <input type="hidden" name="update_stock" value="1">
                                            <input type="hidden" name="new_status" value="out_of_stock">
                                            <button type="submit" class="form-btn">
                                                <i class="fas fa-times-circle" style="color: #e74c3c;"></i> Mark Out of Stock
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">
                            <i class="fas fa-box-open" style="font-size: 48px; color: #ddd; margin-bottom: 15px;"></i>
                            <p style="color: #7f8c8d;">No products found in database.</p>
                            <a href="#" style="color: #3498db; text-decoration: none; font-weight: 600;">
                                <i class="fas fa-plus"></i> Add Your First Product
                            </a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <div class="footer">
            <p><i class="fas fa-database"></i> Product Management System • <?php echo date('F j, Y'); ?> • Total Products: <?php echo $total_products; ?></p>
        </div>
    </div>

    <script>
        // Toggle dropdown menus
        function toggleDropdown(productId) {
            const dropdown = document.getElementById('dropdown-' + productId);
            const allDropdowns = document.querySelectorAll('.edit-dropdown');
            
            // Close all other dropdowns
            allDropdowns.forEach(d => {
                if (d !== dropdown) d.classList.remove('show');
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('show');
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.edit-container')) {
                document.querySelectorAll('.edit-dropdown').forEach(d => {
                    d.classList.remove('show');
                });
            }
        });
        
        // Auto-hide message after 5 seconds
        setTimeout(function() {
            const message = document.getElementById('message');
            if (message) {
                message.style.transition = 'opacity 0.5s';
                message.style.opacity = '0';
                setTimeout(() => {
                    message.style.display = 'none';
                }, 500);
            }
        }, 5000);
    </script>
</body>
</html>