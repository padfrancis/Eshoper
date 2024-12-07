<?php
include'../assets/config/conn.php';

if (isset($_POST['user_id'])) {
  $userId = $_POST['user_id'];

  try {
    $query = "DELETE FROM `users` WHERE `user_id` = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $userId);
    $result = $stmt->execute();

    if ($result)
    {
      echo 'success';
      header('Location: http://localhost/web/controller/users.php');
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
