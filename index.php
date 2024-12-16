<?php
session_start();
if(!empty($_SESSION['user'])) {
  $username = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/styles.css">
  <title>Home Page</title>
</head>
<body>
  <div class = "container">
    <nav class="navbar">
      <div class="logo">
        <a href="index.php">
          <img src="assets/images/logo2.png" alt="GenGrahamz Logo">
          <p>GenGrahamz</p>
        </a>
      </div>
      <button class="hamburger">
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
                  <li><a href="../web/orders/orders.php">View Orders</a></li>
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
  <div class="carousel">
    <button class="carousel-button prev">‹</button>
    <div class="carousel-track-container">
      <div class="carousel-track">
        <div class="carousel-item">
          <img src="../web/assets/images/graham2.png" alt="Slide 1">
        </div>
        <div class="carousel-item">
          <img src="../web/assets/images/graham3.png" alt="Slide 2">
        </div>
        <div class="carousel-item">
          <img src="../web/assets/images/graham4.png" alt="Slide 3">
        </div>        
        <div class="carousel-item">
          <img src="../web/assets/images/graham5.png" alt="Slide 4">
        </div>
      </div>
    </div>
    <button class="carousel-button next">›</button>
  </div>
  <div class="image-section-container">
    <div class="img-container">
      <img src="assets/images/graham6.png" alt="User">
    </div>
  </div>
  <section id = "products">
    <div class="grid-container">
      <div class="grid-item" style="background-image: url('assets/images/graham2.png');">
      </div>
      <div class="grid-item" style="background-image: url('assets/images/graham3.png');">
      </div>
      <div class="grid-item" style="background-image: url('assets/images/graham4.png');">
      </div>
      <div class="grid-item" style="background-image: url('assets/images/graham5.png');">
      </div>
    </div>
  </section>
  <footer class="footer">
      <div class="container2"></div>
          <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
      </div>
  </footer>
  <script src="../web/assets/js/carousel.js"></script>
  <script src="../web/assets/js/hamburger.js"></script>
</body>
</html>
