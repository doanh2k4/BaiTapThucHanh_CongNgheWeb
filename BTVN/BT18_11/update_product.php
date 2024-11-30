<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $index = $_POST['index'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    if (isset($_SESSION['products'])) {
        $products = $_SESSION['products'];

        if (isset($products[$index])) {
            $products[$index]['name'] = $name;
            $products[$index]['price'] = $price;
        }

        $_SESSION['products'] = $products;
    }

    header('Location: index.php');
    exit();
}
?>