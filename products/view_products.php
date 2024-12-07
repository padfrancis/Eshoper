<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="product.css">
    <title>View Products</title>
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
                <li><a href="../web/auth/login.php">Login</a></li>
                <li><a href="../web/auth/signup.php">Signup</a></li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_SESSION['user'])): ?>
            <li class="dropdown" id ="manage">
              <a href="">Manage <span class="arrow">▼</span></a>
                <ul class="dropdown-menu">
                  <li><a href="../controller/users.php">View Users</a></li>
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
            <form action="../controller/logout.php" method="post" class="logout-form" onsubmit="return confirm('<?php echo $_SESSION['user'];?>, are you sure you want to Logout?')">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
    <section class="products-section">
        <h2>All Products
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for products...">
        </div>
        </h2>
        <table class="">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Stock Quantity</th>
                <th>Category ID</th>
                <th>Actions</th>
            </tr>
            <tbody id="searchresult">
                <!--
                <?php
                foreach ($_SESSION['products'] as $index => $product) {
                    $ID = $index + 1;
                    $title = $product['title'];
                    $description = $product['description'];
                    $price = $product['price'];
                    $image = $product['image'];
                    $stock_quantity = $product['stock_quantity'];
                    $category_id = $product['category_id'];
                ?>
                <tr>
                    <td><?php echo $ID; ?></td>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $description; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" style="width: 50px; height: auto;"></td>
                    <td><?php echo $stock_quantity; ?></td>
                    <td><?php echo $category_id; ?></td>
                    <td style="display: inline-block;">
                        <form action="../controller/update_product.php?id=<?php echo $ID; ?>" method="post" style="display: inline-block;">
                            <button type="submit" class="btn1" style="display: inline-block;"><i class="fa fa-edit"></i></button>
                        </form>
                        <form action="../controller/delete_product.php?id=<?php echo $ID; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this product? <?php echo $title; ?>')" style="display: inline-block;">
                            <input type="hidden" name="product_id" value="<?php echo $ID; ?>" style="display: inline-block;">
                            <button type="submit" class="btn2"><i class="fa fa-trash" style="display: inline-block;"></i></button>
                        </form>
                        <form action="../controller/add_product.php" method="post" style="display: inline-block;">
                            <button type="submit" class="add" style="display: inline-block;"><i class="fa fa-plus"></i></button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
                -->
            </tbody>
        </table>
    </section>

    <footer class="footer">
        <div class="container2"></div>
        <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
    </footer>
</body>
</html>