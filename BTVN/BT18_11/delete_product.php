<?php
session_start();

if (isset($_GET['index'])) {
    $index = $_GET['index'];

    if (isset($_SESSION['products'])) {
        $products = $_SESSION['products'];

        if (isset($products[$index])) {
            unset($products[$index]);
            $products = array_values($products);
        }

        $_SESSION['products'] = $products;
    }
}

header('Location: index.php');
exit();
?>