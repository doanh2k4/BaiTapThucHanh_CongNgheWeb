<?php
$servername = "localhost";
$username = "root";
$password = "08082004";
$dbname = "flowers";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Truy vấn dữ liệu từ bảng flowers
    $stmt = $conn->prepare("SELECT * FROM flowers");
    $stmt->execute();

    // Lưu dữ liệu vào mảng
    $flowers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
    exit();
}
