<?php
include '../assets/config/conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST["prod_name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $stock_quantity = $_POST["stock_quantity"];

    $stmt = $conn->prepare("SELECT * FROM products WHERE prod_name = :prod_name");
    $stmt->bindParam(':prod_name', $product_name);
    $stmt->execute();
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = file_get_contents($_FILES['image']['tmp_name']);
    } else {
        echo "<script>alert('Error uploading image');</script>";
        exit;
    }
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Error! Product Name already exists');</script>";
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO products (prod_name, description, price, image, stock_quantity) 
                    VALUES (:product_name, :description, :price, :image, :stock_quantity)");
            $stmt->bindParam(':image', $image, PDO::PARAM_LOB);
            $stmt->bindParam(':product_name', $product_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':stock_quantity', $stock_quantity);

            if ($stmt->execute()) {
                echo "<script>alert('Successfully Added Product!');
                window.location.href = 'http://localhost/web/products/view_products.php';
                </script>";
            } else {
                throw new Exception("Error adding Product!");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$conn = null;
?>