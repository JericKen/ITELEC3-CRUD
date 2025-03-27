<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "about";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOExeption $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>