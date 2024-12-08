<?php
include('../assets/config/conn.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $ID = $_POST['product_id'];
        $prod_name = $_POST['prod_name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $stock_quantity = $_POST['stock_quantity'];

        $stmt_check = $conn->prepare("SELECT * FROM `products` WHERE `product_id` = :product_id");
        $stmt_check->bindParam(':product_id', $ID);
        $stmt_check->execute();

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image = file_get_contents($_FILES['image']['tmp_name']);
        } else {
            echo "<script>alert('Error uploading image');</script>";
            exit;
        }

        if ($stmt_check->rowCount() > 0) {
            $stmt_duplicate = $conn->prepare("SELECT * FROM `products` WHERE `prod_name` = :prod_name AND `product_id` != :product_id");
            $stmt_duplicate->bindParam(':prod_name', $prod_name);
            $stmt_duplicate->bindParam(':product_id', $ID);
            $stmt_duplicate->execute();

            if ($stmt_duplicate->rowCount() > 0) {
                echo "<script>alert('Duplicate Product Name Found!');</script>";
            } else {
                $stmt_update = $conn->prepare("UPDATE products SET prod_name = :prod_name, description = :description, price = :price,
                image = :image, stock_quantity = :stock_quantity WHERE product_id = :product_id");
                $stmt_update->bindParam(':product_id', $ID);
                $stmt_update->bindParam(':prod_name', $prod_name);
                $stmt_update->bindParam(':description', $description);
                $stmt_update->bindParam(':price', $price);
                $stmt_update->bindParam(':image', $image, PDO::PARAM_LOB);
                $stmt_update->bindParam(':stock_quantity', $stock_quantity);

                if ($stmt_update->execute()) {
                    echo "<script>alert('Record with Product Name $prod_name Successfully Updated!');</script>";
                } else {
                    echo "<script>alert('Error Updating Product');</script>";
                }
            }
        } else {
            echo "<script>alert('Product_ID Not Found!');</script>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if (isset($stmt_check)) {
            $stmt_check = null;
        }
        if (isset($stmt_update)) {
            $stmt_update = null;
        }
        if (isset($stmt_duplicate)) {
            $stmt_duplicate = null;
        }
        echo "
            <script>
                window.location.href = '/web/products/view_products.php';
            </script>
            ";
        $conn = null;
    }
}