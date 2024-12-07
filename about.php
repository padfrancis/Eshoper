<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/styles.css">
  <title>GenGrahamz</title>
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
      <h1>About Us</h1>
      <div class="about">
        <a href="index.php"><p>Home</p></a> &gt; <a href="about.php"><p>About Us</p></a>
        </div>
      </div>
    </div>
  </header>
  <section class="content">
    <div class="content-box">
      <p>
        GenGrahamz was founded with a passion for creating delightful graham bars that satisfy your sweet cravings. We offer three delicious flavors—Ube Cookies and Cream, Mango Choco, and Ube—with two convenient sizes: Small and Medium. Whether you're looking for a quick snack or something to share with friends, our graham bars provide a perfect balance of flavor and texture. Over the years, we’ve built a brand that focuses on quality, variety, and affordability, becoming a trusted name in the snack industry.
      </p>

      <p>
        Our mission is simple: to offer high-quality graham bars that bring joy with every bite. We ensure every bar is made with the finest ingredients, creating a product that’s both indulgent and satisfying. GenGrahamz has quickly become a go-to snack for anyone looking for a tasty treat, offering something for everyone with our unique flavors and sizes.
      </p>

      <p>
        Choose from our flavors: Ube, Cookies and Cream for a rich and creamy indulgence, or Mango, Choco for a tropical treat with a chocolate twist. Whether you prefer a quick bite or a larger portion, our Small and Medium sizes cater to all your snacking needs. At GenGrahamz, we’re excited to continue innovating and bringing new flavors to delight our customers.
      </p>
    </div>
  </section>

  <footer class="footer">
    <div class="container2"></div>
        <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
    </div>
  </footer>
  <script src="../web/assets/js/hamburger.js"></script>
</body>
</html>
