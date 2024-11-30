<?php
session_start();
include 'header.php';
include 'products.php';
?>

<main>
    <br>
    <div class="d-flex justify-content-start mb-3">
        <a href="add_product.php" class="btn btn-success" target="_blank">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Sản phẩm</th>
                <th>Giá thành</th>
                <th class="text-center">Sửa</th>
                <th class="text-center">Xóa</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($products as $index => $product) {
                echo "<tr>";
                echo "<td>{$product['name']}</td>";
                echo "<td>{$product['price']} VND</td>";
                echo "<td><a href='edit_product.php?index={$index}' class='btn btn-primary'><i class='fas fa-edit'></i></a></td>";
                echo "<td><a href='delete_product.php?index={$index}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</main>

<?php include 'footer.php'; ?>