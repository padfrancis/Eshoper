<?php
session_start();
include '../web/assets/config/conn.php';
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
            <a href="index.php"><p class = "abt">Home</p></a> &gt; <a href="contact.php"><p class = "abt">Order Here</p></a>
          </div>
        </div>
      </header>
      <?php if(!isset($_SESSION['user'])): ?>
        <h1 class = "rev">Please Create an Account/Login First</h1>
      <?php endif ?>
      <?php if(isset($_SESSION['user'])): ?>
      <section class="contact">
        <div class="contact-box">
          <form action="../web/controller/add-order.php" method="post">
            <label for="username"><span>* </span>Username</label><br>
            <input type="text" id="username" name="username" value = "<?php 
              if (isset($_SESSION['user']))
              {
                echo htmlspecialchars($_SESSION['user']);
              }
            ?>" 
            readonly>
            <br>
            <label for="product_name"><span>* </span>Product Name</label><br>
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
            </select><br>
            <label for="quantity"><span>* </span>Quantity</label><br>
            <input type="number" id="quantity" name="quantity" required><br>
            <input type="submit" value="Submit">
          </form>
        </div>
      </section>
      <?php endif ?>
      <footer class="footer" style = "position:fixed;">
        <div class="container2"></div>
            <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
        </div>
      </footer>
</body>
</html>
