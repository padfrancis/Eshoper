<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GenGrahamz - Sign Up</title>
    <link rel="stylesheet" href="auth.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="container">
        <div class="logo">
            <a href="../index.php">
                <img src="../assets/images/logo2.png" alt="GenGrahamz Logo">
                <p>GenGrahamz</p>
            </a>
        </div>
        </div>
    </nav>

    <!-- Signup Form Section -->
    <section class="signup-section">
        <div class="form-container">
            <h1>Hello, Shopper!</h1>
            <p>Enter your personal details and<br> start your shopping journey with us</p>
            <form action = "signup.php" method = "POST">
                <div class="icon">
                    <img src="../assets/images/user.png" alt="User Icon">
                </div>
                <input name = "firstname" type="text" placeholder="First Name" required>
                <input name = "lastname" type="text" placeholder="Last Name" required>
                <input name = "username" type="text" placeholder="Username" required>
                <input name = "password" type="password" placeholder="Password" required>
                <input name = "email" type="email" placeholder="Email" required>
                <button type="submit">Sign Up</button>
                <p class="login-link">
                    Already have an account? <a href="login.php">Login here!</a>
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Username or Email already exists');</script>";
    } else {
        try {
            $hashed_password = hash('sha256', $password);
            $stmt = $conn->prepare("INSERT INTO users (username, firstname, lastname, password, email) 
                    VALUES (:username, :firstname, :lastname, :password, :email)");
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                echo "<script>alert('Successfully Added!');</script>";
            } else {
                throw new Exception("Error adding user!");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$conn = null;
?>

