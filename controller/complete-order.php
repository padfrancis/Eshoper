<?php
include '../assets/config/conn.php';
$reservation_id = $_POST['reservation_id'];


$sql = "UPDATE order_reservations SET status='completed' WHERE reservation_id=?";
$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $reservation_id);

if ($stmt->execute()) {
    echo "Order reservation status updated to completed.";
    header('Location: http://localhost/web/orders/orders.php');
} else {
    echo "Error updating record: " . $conn = null;
}

$stmt = null;
$conn = null;
