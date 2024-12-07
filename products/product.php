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
    <section class="products-section">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for products...">
            <button id="searchButton">Search</button>
        </div>
        <button class = "addprod" id="addProductButton">Add Product</button>
        <div class="product-grid">
            <!--
            <?php foreach ($_SESSION['products'] as $product): ?>
                <div class="product-item" data-product="<?php echo $product['title']; ?>">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['title']; ?>">
                    <h3><?php echo $product['title']; ?></h3>
                    <p><?php echo $product['price']; ?></p>
                    <a href="#" class="btn">Buy Now</a>
                </div>
            <?php endforeach; ?>
            -->
            <div class="product-item" data-product="Sample Product">
                <img src="/web/assets/images/graham.jpg" alt="Sample Product">
                <h3>Sample Product</h3>
                <p>$19.99</p>
                <a href="#" class="btn">Buy Now</a>
            </div>
            <div class="product-item" data-product="Sample Product">
                <img src="/web/assets/images/graham.jpg" alt="Sample Product">
                <h3>Sample Product</h3>
                <p>$19.99</p>
                <a href="#" class="btn">Buy Now</a>
            </div>
            <div class="product-item" data-product="Sample Product">
                <img src="/web/assets/images/graham.jpg" alt="Sample Product">
                <h3>Sample Product</h3>
                <p>$19.99</p>
                <a href="#" class="btn">Buy Now</a>
            </div>
            <div class="product-item" data-product="Sample Product">
                <img src="/web/assets/images/graham.jpg" alt="Sample Product">
                <h3>Sample Product</h3>
                <p>$19.99</p>
                <a href="#" class="btn">Buy Now</a>
            </div>
        </div>
    </section>

    <!-- Add Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Add a Product</h2>
            <form action="product.php" method="post">
                <label for="title">Product Title</label>
                <input type="text" id="title" name="title" required><br>

                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea><br>

                <label for="price">Price</label>
                <input type="text" id="price" name="price" required><br>

                <label for="image">Image URL</label>
                <input type="file" accept ="image" id="image" name="image" required width = "40" height = "40"><br>

                <label for="stock_quantity">Stock Quantity</label>
                <input type="number" id="stock_quantity" name="stock_quantity" required><br>

                <label for="category_id">Category ID</label>
                <input type="number" id="category_id" name="category_id" required><br>

                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <div class="container2"></div>
        <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
    </footer>

    <script src = "../products/product.js"></script>
</body>
</html>