<?php

$servername = "localhost";
$user = "root";
$password = "";
$db = "gengrahamz";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}
