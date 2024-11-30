<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    if (isset($_SESSION['products'])) {
        $products = $_SESSION['products'];
    } else {
        $products = [
            ['name' => 'Sản phẩm 1', 'price' => '1000'],
            ['name' => 'Sản phẩm 2', 'price' => '2000'],
            ['name' => 'Sản phẩm 3', 'price' => '3000']
        ];
    }

    $new_product = ['name' => $name, 'price' => $price];
    array_push($products, $new_product);

    $_SESSION['products'] = $products;

    header('Location: index.php');
    exit();
}
?>