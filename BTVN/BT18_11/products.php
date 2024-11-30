<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['products'])) {
    $products = $_SESSION['products'];
} else {
    $products = [
        ['name' => 'Sản phẩm 1', 'price' => '1000'],
        ['name' => 'Sản phẩm 2', 'price' => '2000'],
        ['name' => 'Sản phẩm 3', 'price' => '3000']
    ];
}
?>