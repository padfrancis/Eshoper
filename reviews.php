<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/reviews.css">
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
      <h1>Customer Reviews</h1>
      <div class="about">
        <a href="index.php"><p>Home</p></a> &gt; <a href="reviews.php"><p>Customer Reviews</p></a>
        </div>
      </div>
    </div>
  </header>
  <section class="reviews">
    <div class="container2">
        <button id="addReviewButton">Add a Review</button>
        <div class="review">
            <h3>John Doe</h3>
            <p>⭐⭐⭐⭐⭐</p>
            <p>"Great product! Highly recommend it."</p>
        </div>
    </div>
</section>

<!-- Review Modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Add a Review</h2>
        <form action="add_review.php" method="post">
            <label for="product_id">Product ID</label>
            <input type="number" id="product_id" name="product_id" placeholder="Enter Product ID" required><br>

            <label for="user_id">User ID</label>
            <input type="number" id="user_id" name="user_id" placeholder="Enter Your User ID" required><br>

            <label for="rating">Rating</label>
            <select id="rating" name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br>

            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" placeholder="Write your review here" required></textarea><br>
            <button type="submit">Submit Review</button>
        </form>
    </div>
</div>
<footer class="footer">
    <div class="container2">
        <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
    </div>
</footer>
<script src="../web/assets/js/hamburger.js"></script>
<script src="../web/assets/js/modal-reviews.js"></script>
</body>
</html>
