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
    <link rel="stylesheet" href="/web/assets/css/users.css">
    <script src="https://kit.fontawesome.com/aeb1f52835.js" crossorigin="anonymous"></script>
    <title>Users</title>
</head>
<body>
<div class = "container">
    <nav class="navbar">
      <div class="logo">
        <a href="../index.php">
          <img src="../assets/images/logo.png" alt="GenGrahamz Logo">
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
          <a href="../products/product.php">Products</a>
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
                  <li><a href="../web/controller/users.php">View Users</a></li>
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
            <form action="logout.php" method="post" class="logout-form" onsubmit="return confirm('<?php echo $_SESSION['user'];?>, are you sure you want to Logout?')">
                <button class = "logout-btn" type="submit" class="logout-btn">Logout</button>
            </form>
            <?php endif; ?>
        </div>
    </nav>    
  </div>
    <section class="users-section">
        <div class="table-container">
        <h2>List of Users</h2>
        <table class="">
            <tr>
                <th>User_id</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Password</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created_at</th>
                <th>Actions</th>
            </tr>
            <tbody id="searchresult">
                <?php
                include '../assets/config/conn.php';
                $stmt = $conn->prepare("SELECT * FROM `users`");
                $stmt->execute();

                $result = $stmt->fetchAll();

            foreach ($result as $row) 
            {
                $ID = $row['user_id'];
                $Username = $row['username'];
                $Firstname = $row['firstname'];
                $Lastname = $row['lastname'];
                $Password = $row['password'];
                $Email = $row["email"];
                $Role = $row['role'];
                $Created_at = $row["created_at"];
                ?>
                <tr>
                    <td id="ID-<?= $ID ?>"><?php echo $ID ?></td>
                    <td id="Username-<?= $Username ?>"><?php echo $Username ?></td>
                    <td id="Firstname-<?= $Firstname ?>"><?php echo $Firstname ?></td>
                    <td id="Lastname-<?= $Lastname ?>"><?php echo $Lastname ?></td>
                    <td id="Password-<?= $Password ?>"><?php echo $Password ?></td>
                    <td id="Email-<?= $Email ?>"><?php echo $Email ?></td>
                    <td id="Username-<?= $Role ?>"><?php echo $Role ?></td>
                    <td id="Created_at-<?= $Created_at ?>"><?php echo $Created_at ?></td>
                    <td id="ID-<?= $ID ?>">
                    <button type="button" class="btn1 editUser" data-id="<?= $ID ?>" data-username="<?= $Username ?>" data-firstname="<?= $Firstname ?>" data-lastname="<?= $Lastname ?>" data-email="<?= $Email ?>" data-role="<?= $Role ?>"><i class="fa-regular fa-pen-to-square"></i></button>
                    <form action="../controller/delete-user.php?id=<?php echo $row['user_id']; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user? <?php echo $row['username']; ?>')" style="display: inline-block;">
                        <input type="hidden" name="user_id" value="<?= $ID ?>" style="display: inline-block;">
                    <button type="submit" class="btn2"><i class="fa fa-trash" style="display: inline-block;"></i></button>
                    </form>
                    <form action="../auth/signup.php" method="get" style="display: inline-block;">
                        <button type="submit" class="add"><i class="fa fa-plus"></i></button>
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
    <footer class="footer">
        <div class="container2">
        <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
        </div>
    </footer>
    <div id="userModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Edit User Details</h2>
        <form id="editUserForm" action="../controller/update-user.php" method="post">
            <label for="user_id">User ID</label>
            <input type="number" id="modal_user_id" name="user_id" readonly><br>

            <label for="username">Username</label>
            <input type="text" id="modal_username" name="username" required><br>

            <label for="firstname">First Name</label>
            <input type="text" id="modal_firstname" name="firstname" required><br>

            <label for="lastname">Last Name</label>
            <input type="text" id="modal_lastname" name="lastname" required><br>

            <label for="email">Email</label>
            <input type="email" id="modal_email" name="email" required><br>

            <label for="role">Role</label>
            <select id="modal_role" name="role" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select><br>

            <button class = "submit" type="submit">Update User</button>
        </form>
    </div>
</div>
<script>
    document.querySelectorAll('.editUser').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('modal_user_id').value = this.dataset.id;
            document.getElementById('modal_username').value = this.dataset.username;
            document.getElementById('modal_firstname').value = this.dataset.firstname;
            document.getElementById('modal_lastname').value = this.dataset.lastname;
            document.getElementById('modal_email').value = this.dataset.email;
            document.getElementById('modal_role').value = this.dataset.role;
            document.getElementById('editUserForm').action = `../controller/update-user.php?id=${this.dataset.id}`;
            document.getElementById('userModal').style.display = 'block';
        });
    });

    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('userModal').style.display = 'none';
    });
</script>
</body>
</html>