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
    <link rel="stylesheet" href="orders.css">
    <script src="https://kit.fontawesome.com/aeb1f52835.js" crossorigin="anonymous"></script>
    <title>View Orders</title>
</head>
<body>
    <div class = "container">
        <nav class="navbar">
        <div class="logo">
            <a href="index.php">
            <img src="../assets/images/logo2.png" alt="GenGrahamz Logo">
            <p>GenGrahamz</p>
            </a>
        </div>
        <button class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li class="dropdown">
            <a href="../products/product.php">Products</a>
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
                    <li><a href="../products/view_products.php">View Products</a></li>
                    <li><a href="../orders/orders.php">View Orders</a></li>
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
                <form action="../controller/logout.php" method="post" class="logout-form" onsubmit="return confirm('<?php echo $_SESSION['user'];?>, Are you sure you want to Logout?')">
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
                <?php endif; ?>
            </div>
        </nav>    
    </div>
    <section class="products-section">
        <div class="table-container">
            <h2 class= "list-prod">List of Orders</h2>
            <table class="">
                <tr>
                    <th>Reservation_ID</th>
                    <th>Username</th>
                    <th>Prod_name</th>
                    <th>Quantity</th>
                    <th>Reservation Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <tbody id="searchresult">
                    <?php
                    include '../assets/config/conn.php';
                    $stmt = $conn->prepare("SELECT `reservation_id`, `username`, `prod_name`, `quantity`, `reservation_date`, `status` FROM `order_reservations`");
                    $stmt->execute();

                    $result = $stmt->fetchAll();

                    foreach ($result as $row) {
                        $reservation_id = $row['reservation_id'];
                        $username = $row['username'];
                        $prod_name = $row['prod_name'];
                        $quantity = $row['quantity'];
                        $reservation_date = $row['reservation_date'];
                        $status = $row['status'];
                    ?>
                    <tr>
                        <td id="reservation_id-<?= $reservation_id ?>"><?php echo $reservation_id; ?></td>
                        <td id="username-<?= $username ?>"><?php echo $username; ?></td>
                        <td id="prod_name-<?= $prod_name ?>"><?php echo $prod_name; ?></td>
                        <td id="quantity-<?= $quantity ?>"><?php echo $quantity; ?></td>
                        <td id="reservation_date-<?= $reservation_date ?>"><?php echo $reservation_date; ?></td>
                        <td id="status-<?= $status ?>"><?php echo $status; ?></td>
                        <td id="Actions-<?= $reservation_id ?>">               
                            <?php if ($status === 'reserved'): ?>
                                <form action="/web/controller/cancel-order.php?id=<?php echo $row['reservation_id']; ?>" method="post" onsubmit="return confirm('Are you sure you want to cancel this order for <?php echo $_SESSION['user']; ?>?')" style="display: inline-block;">
                                    <input type="hidden" name="reservation_id" value="<?= $reservation_id ?>" style="display: inline-block;">
                                    <button type="submit" class="btn1"><i class="fa-solid fa-xmark"></i></button>
                                </form>                            
                                <form action="/web/controller/complete-order.php?id=<?php echo $row['reservation_id']; ?>" method="post" onsubmit="return confirm('Are you sure you want to complete this order for <?php echo $_SESSION['user']; ?>?')" style="display: inline-block;">
                                    <input type="hidden" name="reservation_id" value="<?= $reservation_id ?>" style="display: inline-block;">
                                    <button type="submit" class="btn2"><i class="fa-solid fa-check"></i></button>
                                </form>
                            <?php elseif ($status === 'completed' || $status === 'cancelled'): ?>
                                <span>No available actions</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <footer class="footer">
        <div class="container2">
        <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>