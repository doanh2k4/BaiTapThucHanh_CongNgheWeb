<?php include("header.php"); ?>

<form action="add.php" method="post">
    <div class="form-group">
        <label for="name">Tên sản phẩm</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="price">Giá thành</label>
        <input type="text" class="form-control" id="price" name="price" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm sản phẩm mới</button>
</form>

  