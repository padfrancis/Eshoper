<?php
include'../assets/config/conn.php';

if (isset($_POST['product_id'])) {
  $prod_id = $_POST['product_id'];

  try {
    $query = "DELETE FROM `products` WHERE `product_id` = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $prod_id);
    $result = $stmt->execute();

    if ($result)
    {
      echo 'success';
      header('Location: http://localhost/web/products/view_products.php');
    } 
    else 
    {
      echo 'error';
    }
  } 
  catch (PDOException $e) 
  {
    echo 'Error: ' . $e->getMessage();
  }
}

$conn = null;

?>
