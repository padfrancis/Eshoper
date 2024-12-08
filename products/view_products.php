<?php
session_start();
if(empty($_SESSION['user'])) {
    header('location: ../index.php');
}
if($_SESSION['role'] == "user") 
  {
    if(!empty($_SESSION['user'])) 
    {
        header('location: ../index.php');
        exit;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="product.css">
    <script src="https://kit.fontawesome.com/aeb1f52835.js" crossorigin="anonymous"></script>
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
                  <li><a href="../products/view_products.php">View Products</a></li>
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
        <div class="table-container">
            <h2 class= "list-prod">List of Products</h2>
            <button class = "addprod" id="addProductButton">Add Product</button>
            <table class="">
                <tr>
                    <th>Product_ID</th>
                    <th>Prod_name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Stock Quantity</th>
                    <th>Created_at</th>
                    <th>Actions</th>
                </tr>
                <tbody id="searchresult">
                    <?php
                    include '../assets/config/conn.php';
                    $stmt = $conn->prepare("SELECT * FROM `products`");
                    $stmt->execute();

                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        $ID = $row['product_id'];
                        $prod_name = $row['prod_name'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image = $row['image'];
                        $stock_quantity = $row['stock_quantity'];
                        $Created_at = $row['created_at'];
                    ?>
                    <tr>
                        <td id="ID-<?= $ID ?>"><?php echo $ID; ?></td>
                        <td id="prod_name-<?= $prod_name ?>"><?php echo $prod_name; ?></td>
                        <td class = "desc"id="Description-<?= $description ?>"><?php echo $description; ?></td>
                        <td id="Price-<?= $price ?>"><?php echo $price; ?></td>
                        <td id="Image-<?= $ID ?>">
                            <?php if (filter_var($image, FILTER_VALIDATE_URL) || file_exists($image)): ?>
                                <img src="<?php echo $image; ?>" alt="<?php echo $prod_name; ?>" style="width: 50px; height: auto;">
                            <?php else: ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" alt="<?php echo $prod_name; ?>" style="width: 200px; height:auto;">
                            <?php endif; ?>
                        </td>
                        <td id="StockQuantity-<?= $stock_quantity ?>"><?php echo $stock_quantity; ?></td>
                        <td id="CategoryID-<?= $Created_at ?>"><?php echo $Created_at; ?></td>
                        <td id="Actions-<?= $ID ?>" >
                            <button type="button" class="btn1 editProduct" data-id="<?= $ID ?>" data-prod_name="<?= $prod_name ?>" data-description="<?= $description ?>" data-price="<?= $price ?>" data-stock="<?= $stock_quantity ?>" data-category="<?= $Created_at ?>">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <form action="/web/controller/delete-product.php?id=<?php echo $row['product_id']; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this product? <?php echo $row['prod_name']; ?>')" style="display: inline-block;">
                                <input type="hidden" name="product_id" value="<?= $ID ?>" style="display: inline-block;">
                                <button type="submit" class="btn2"><i class="fa fa-trash" style="display: inline-block;"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </section>
        <!-- Add Product Modal -->
        <div id="reviewModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Add a Product</h2>
            <form action="../controller/add-product.php" method="post" enctype="multipart/form-data">
                <label for="prod_name">Product Name</label>
                <input type="text" id="prod_name" name="prod_name" required><br>

                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea><br>

                <label for="price">Price</label>
                <input type="text" id="price" name="price" required><br>

                <label for="image">Image URL</label>
                <input type="file" accept ="image" id="image" name="image" required><br>

                <label for="stock_quantity">Stock Quantity</label>
                <input type="number" id="stock_quantity" name="stock_quantity" required><br>

                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal2">&times;</span>
            <h2>Edit Product Details</h2>
            <form id="editUserForm" action="../web/controller/update-products.php" method="post" enctype="multipart/form-data">

                <label for="product_id">Product ID</label>
                <input type="text" id="modal_product_id" name="product_id" readonly><br>

                <label for="Prod_name">Product Name</label>
                <input type="text" id="modal_prod_name" name="prod_name" required><br>

                <label for="description">Description</label>
                <textarea name="description" id="modal_desc" required></textarea><br>

                <label for="price">Price</label>
                <input type="number" id="modal_price" name="price" required><br>

                <label for="image">Image</label>
                <input type="file" accept="image" id="modal_image" name="image" required><br>

                <label for="stock">Stock Quantity</label>
                <input type="number" id="modal_stock" name="stock_quantity" required><br>

                <button class = "submit" type="submit">Update Product</button>
            </form>
        </div>
    </div>
    <script>
        document.querySelectorAll('.editProduct').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('modal_product_id').value = this.dataset.id;
                document.getElementById('modal_prod_name').value = this.dataset.prod_name;
                document.getElementById('modal_desc').value = this.dataset.description;
                document.getElementById('modal_price').value = this.dataset.price;
                document.getElementById('modal_stock').value = this.dataset.stock;
                document.getElementById('modal_image').dataset.id = this.dataset.id;
                document.getElementById('editUserForm').action = `../controller/update-products.php?id=${this.dataset.id}`;
                document.getElementById('editModal').style.display = 'block';
            });
        });

        document.getElementById('closeModal2').addEventListener('click', function() {
            document.getElementById('editModal').style.display = 'none';
        });
    </script>
    <footer class="footer">
        <div class="container2"></div>
        <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
    </footer>
    <script src = "../products/product.js"></script>
</body>
</html>