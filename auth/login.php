<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GenGrahamz - Log in</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="container">
            <div class="logo">
                <a href="../index.php">
                    <img src="../assets/images/logo.png" alt="GenGrahamz Logo">
                    <p>GenGrahamz</p>
                </a>
            </div>
        </div>
    </nav>

    <!-- login Form Section -->
    <section class="login-section">
        <div class="form-container">
            <h1>Welcome Back!</h1>
            <p>To continue shopping with us, please log in with your personal information</p>
            <form action="login.php" method="POST">
                <div class="icon">
                    <img src="../assets/images/user.png" alt="User Icon">
                </div>
                <input name="username" type="text" placeholder="Username" required>
                <input name="password" type="password" placeholder="Password" required>
                <button type="submit">Log in</button>
                <p class="login-link">
                    Don't have an account? <a href="signup.php">Signup here!</a>
                </p>
            </form>
        </div>
    </section>
    <footer class="footer">
            <div class="container"></div>
                <p>&copy; <?php echo date("Y"); ?> GenGrahamz. All rights reserved.</p>
            </div>
    </footer>
</body>
</html>
<?php
include'../assets/config/conn.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT `password`, `role` FROM `users` WHERE `username` = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $stored_password = $row['password'];
        if (hash_equals($stored_password, hash('sha256', $password))) {
            $role = $row['role'];
            $_SESSION['role'] = $role;
            $_SESSION['user'] = $username;

            if($role == "admin") {
                echo "
            <script>
                alert('Admin Login Successfully');
                window.location.href = 'http://localhost/web/index.php';
            </script>
            ";
            }
            if($role == "user") {
                echo "
                <script>
                    alert('Login Successfully');
                    window.location.href = 'http://localhost/web/index.php';
                </script>
                ";
            }
        } else {
        echo "
        <script>
            alert('Incorrect Password!');
            window.location.href = 'http://localhost/web/auth/login.php';
        </script>
        ";
        }
    } else {
        echo "
        <script>
            alert('User not Found!');
            window.location.href = 'http://localhost/web/auth/login.php';
        </script>
        ";
    }
}
?>