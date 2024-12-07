<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Document</title>
</head>
<body>
    <div class = "container">
        <nav class="navbar">
          <div class="logo">
            <a href="index.php">
              <img src="assets/images/logo.png" alt="GenGrahamz Logo">
              <p>GenGrahamz</p>
            </a>
          </div>
          <button class="hamburger" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
          </button>
          <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
              <a href="../web/products/product.php">Products</a>
            </li>
            <li><a href="reviews.php">Customer Reviews</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Order Here</a></li>
            <?php if (!isset($_SESSION['user'])): ?>
          <li class="dropdown">
            <a href="#">Account <span class="arrow">▼</span></a>
            <ul class="dropdown-menu">
              <li><a href="../web/auth/login.php">Login</a></li>
              <li><a href="../web/auth/signup.php">Signup</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_SESSION['user'])): ?>
            <li class="dropdown" id ="manage">
              <a href="">Manage <span class="arrow">▼</span></a>
                <ul class="dropdown-menu">
                  <li><a href="../web/controller/users.php">View Users</a></li>
                  <li><a href="../web/products/view_products.php">View Products</a></li>
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
            <form action="../web/controller/logout.php" method="post" class="logout-form" onsubmit="return confirm('<?php echo $_SESSION['user'];?>, are you sure you want to Logout?')">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
            <?php endif; ?>
        </div>
        </nav>
      </div>
      <header class="header">
        <div class="header-content">
          <h1>Order Here</h1>
          <div class="about">
            <a href="index.php"><p>Home</p></a> &gt; <a href="contact.php"><p>Order Here</p></a>
            </div>
          </div>
        </div>
      </header>
      <section class="contact">
        <div class="contact-box">
          <form action="contact.php" method="post">
            <label for="user_id"><span>* </span>User ID</label><br>
            <input type="number" id="user_id" name="user_id" readonly><br>
            <label for="product_id"><span>* </span>Product ID</label><br>
            <select id="product_id" name="product_id" required>
              <option value="">Select a product</option>
              <option value="1">Product 1</option>
              <option value="2">Product 2</option>
              <option value="3">Product 3</option>
            </select><br>
            <label for="quantity"><span>* </span>Quantity</label><br>
            <input type="number" id="quantity" name="quantity" required><br>
            <input type="submit" value="Submit">
          </form>
        </div>
      </section>
      <footer class="footer">
        <div class="container2"></div>
            <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
        </div>
      </footer>
</body>
</html>