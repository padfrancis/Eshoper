<?php
include '../assets/config/conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_POST["username"];
    $prod_name = $_POST["prod_name"];
    $quantity = $_POST["quantity"];

    try 
    {
      $stmt = $conn->prepare("INSERT INTO order_reservations (username, prod_name, quantity) 
      VALUES (:username, :prod_name, :quantity)");
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':prod_name', $prod_name);
      $stmt->bindParam(':quantity', $quantity);
      if ($stmt->execute()) 
      {
          echo "<script>alert('Successfully Added Order!');
                window.location.href='../contact.php';
          </script>";
      } 
      else 
      {
        throw new Exception("Error adding Order!");
      }
    }catch (Exception $e)
    {
    echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
