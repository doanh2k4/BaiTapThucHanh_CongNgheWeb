<?php
session_start();
include 'header.php';

if (isset($_GET['index'])) {
    $index = $_GET['index'];

    if (isset($_SESSION['products'])) {
        $products = $_SESSION['products'];
        $product = $products[$index];
    }
}
?>

<form action="update_product.php" method="post">
    <input type="hidden" name="index" value="<?php echo $index; ?>">
    <div class="form-group">
        <label for="name">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="price">Giá thành</label>
        <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
</form>

