<?php
include '../assets/config/conn.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_POST["username"];
    $prod_name = $_POST["prod_name"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];
    try 
    {
      $stmt = $conn->prepare("INSERT INTO reviews (prod_name, username, rating, comment) 
      VALUES (:prod_name, :username, :rating, :comment)");
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':prod_name', $prod_name);
      $stmt->bindParam(':rating', $rating);
      $stmt->bindParam(':comment', $comment);
      if ($stmt->execute()) 
      {
          echo "<script>alert('Successfully Added Review!');
                window.location.href='../reviews.php';
          </script>";
      } 
      else 
      {
        throw new Exception("Error adding Review!");
      }
    }catch (Exception $e)
    {
    echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
