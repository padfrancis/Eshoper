<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="product.css">
    <title>Products</title>
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <div class="logo">
                <a href="../index.php">
                    <img src="/web/assets/images/logo.png" alt="GenGrahamz Logo">
                    <p>GenGrahamz</p>
                </a>
            </div>
            <button class="hamburger" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-links">
                <li><a href="../index.php">Home</a></li>
                <li class="dropdown">
                    <a href="product.php">Products</a>
                </li>
                <li><a href="../reviews.php">Customer Reviews</a></li>
                <li><a href="../about.php">About Us</a></li>
                <li><a href="../contact.php">Order Here</a></li>
            <?php if (!isset($_SESSION['user'])): ?>
            <li class="dropdown">
                <a href="#">Account <span class="arrow">▼</span></a>
                <ul class="dropdown-menu">
                <li><a href="../auth/login.php">Login</a></li>
                <li><a href="../auth/signup.php">Signup</a></li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_SESSION['user'])): ?>
            <li class="dropdown" id ="manage">
              <a href="">Manage <span class="arrow">▼</span></a>
                <ul class="dropdown-menu">
                  <li><a href="../controller/users.php">View Users</a></li>
                  <li><a href="view_products.php">View Products</a></li>
                </ul>
            </li>
          <?php endif; ?>
      </ul>
      <div class="user-info">
            <span class="username">
                <?php 
                if (isset($_SESSION['user'])) {
                    echo htmlspecialchars("Hello! " . $_SESSION['user']);
                } else {
                    echo "Guest";
                }
                ?>
            </span>
            <?php if (isset($_SESSION['user'])): ?>
            <form action="../controller/logout.php" method="post" class="logout-form" onsubmit="return confirm('<?php echo $_SESSION['user'];?>, are you sure you want to Logout?')">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
            <?php endif; ?>
        </div>
        </nav>    
    </div>
    <header class="header">
        <div class="header-content">
            <h1>Products</h1>
        </div>
    </div>
  </header>
    <section class="products-section">
    <div class="product-grid">
        <?php
        include '../assets/config/conn.php';

        $sql = "SELECT prod_name, description, price, image, stock_quantity FROM products";
        $stmt = $conn->query($sql);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $prod_name = htmlspecialchars($row['prod_name']);
            $description = htmlspecialchars($row['description']);
            $price = htmlspecialchars($row['price']);
            $stock_quantity = htmlspecialchars($row['stock_quantity']);
            $image = $row['image'];

            if (!empty($image)) {
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    $imageTag = "<img src=\"$image\" alt=\"$prod_name\">";
                } else {
                    $imageTag = '<img src="data:image/jpeg;base64,' . base64_encode($image) . '" alt="' . $prod_name . '">';
                }
            } else {
                $imageTag = '<img src="/path/to/default/image.jpg" alt="No Image">';
            }

            $productId = 'product-modal-' . md5($prod_name);

            echo "
            <div class=\"product-item\" onclick=\"openModal('$productId')\">
                $imageTag
                <h3>$prod_name</h3>
                <p>$description</p>
                <p>Price: ₱$price</p>
                <p>Stock: $stock_quantity</p>
            </div>";
        }

        $conn = null;
        ?>
    </div>
</section>
<script></script>

    <footer class="footer">
        <div class="container2"></div>
        <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
    </footer>
</body>
</html>