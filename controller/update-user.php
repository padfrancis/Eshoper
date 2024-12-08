<?php
include('../assets/config/conn.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $ID = $_POST['user_id'];
        $Username = $_POST['username'];
        $Firstname = $_POST['firstname'];
        $Lastname = $_POST['lastname'];
        $Email = $_POST["email"];
        $Role = $_POST['role'];

        $stmt_check = $conn->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
        $stmt_check->bindParam(':user_id', $ID);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            $stmt_duplicate = $conn->prepare("SELECT * FROM `users` WHERE (`username` = :username OR `email` = :email) AND `user_id` != :user_id");
            $stmt_duplicate->bindParam(':username', $Username);
            $stmt_duplicate->bindParam(':email', $Email);
            $stmt_duplicate->bindParam(':user_id', $ID);
            $stmt_duplicate->execute();

            if ($stmt_duplicate->rowCount() > 0) {
                echo "<script>alert('Username or Email already exists for another user!');</script>";
            } else {
                $stmt_update = $conn->prepare("UPDATE users SET username = :username, firstname = :firstname, lastname = :lastname,
                email = :email, role = :role WHERE user_id = :user_id");
                $stmt_update->bindParam(':user_id', $ID);
                $stmt_update->bindParam(':username', $Username);
                $stmt_update->bindParam(':firstname', $Firstname);
                $stmt_update->bindParam(':lastname', $Lastname);
                $stmt_update->bindParam(':email', $Email);
                $stmt_update->bindParam(':role', $Role);

                if ($stmt_update->execute()) {
                    echo "<script>alert('Record with Username $Username Successfully Updated!');</script>";
                } else {
                    echo "<script>alert('Error Updating User');</script>";
                }
            }
        } else {
            echo "<script>alert('User_ID Not Found!');</script>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if (isset($stmt_check)) {
            $stmt_check = null;
        }
        if (isset($stmt_duplicate)) {
            $stmt_duplicate = null;
        }
        if (isset($stmt_update)) {
            $stmt_update = null;
        }
        echo "
            <script>
                window.location.href = '/web/controller/users.php';
            </script>
            ";
        $conn = null;
    }
}