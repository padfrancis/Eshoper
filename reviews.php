<?php
session_start();
include '../web/assets/config/conn.php';
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
          <img src="assets/images/logo2.png" alt="GenGrahamz Logo">
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
    <?php if(isset($_SESSION['user'])): ?>
    <button id="addReviewButton">Add a Review</button>
    <?php endif; ?>
        <?php
            try {
              $stmt = $conn->prepare("SELECT prod_name, username, rating, comment FROM reviews");
              $stmt->execute();
              $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

              foreach ($reviews as $review) {
                echo "<div class = 'review'>";
                echo "<h3>" . htmlspecialchars($review['username']) . "</h3>";
                echo "<h3>" . htmlspecialchars($review['prod_name']) . "</h3>";
                echo "<p>" . str_repeat("⭐", htmlspecialchars($review['rating'])) . "</p>";
                echo "<p>\"" . htmlspecialchars($review['comment']) . "\"</p>";
                echo "</div>";
              }
            } catch (Exception $e) {
              echo "Error: " . $e->getMessage();
            }
          ?>
      </div>
    </div>
</section>
<!-- Review Modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Add a Review</h2>
        <form action="../web/controller/add-review.php" method="post">
          <label for="product_name"><span>* </span>Product Name</label>
          <select id="prod_name" name="prod_name" required>
          <option value="">Select a product</option>
              <?php
              try {
                $stmt = $conn->prepare("SELECT prod_name FROM products");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  foreach ($products as $product) {
                    echo "<option value='" . htmlspecialchars($product['prod_name']) . "'>" . htmlspecialchars($product['prod_name']) . "</option>";
                  }
                } catch (Exception $e) {
                  echo "Error: " . $e->getMessage();
                }
              ?>
            </select>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" value = "<?php 
              if (isset($_SESSION['user']))
              {
                echo htmlspecialchars( $_SESSION['user']);
              }
            ?>" 
            readonly>

            <label for="rating">Rating</label>
            <select id="rating" name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>

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
