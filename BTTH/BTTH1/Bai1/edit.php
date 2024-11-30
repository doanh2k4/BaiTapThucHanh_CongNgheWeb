<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flowerId = $_POST['flowerId']; 
    $tenHoa = $_POST['tenHoa'];
    $moTa = $_POST['moTa'];
    $currentImage = $_POST['currentImage']; // Giữ lại ảnh hiện tại nếu không tải ảnh mới

    // Xử lý ảnh được tải lên
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'images/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (getimagesize($_FILES['image']['tmp_name']) !== false && $_FILES['image']['size'] < 5000000) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $anh = $uploadFile;

                // Xóa ảnh cũ nếu có
                if ($currentImage && file_exists($currentImage)) {
                    unlink($currentImage);
                }
            } else {
                echo "Lỗi khi tải ảnh lên.";
                exit();
            }
        } else {
            echo "Ảnh không hợp lệ.";
            exit();
        }
    } else {
        $anh = $currentImage; // Giữ ảnh cũ nếu không có ảnh mới
    }

    // Cập nhật thông tin hoa trong cơ sở dữ liệu
    $query = "UPDATE flowers SET tenHoa = :tenHoa, moTa = :moTa, anh = :anh WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':tenHoa', $tenHoa);
    $stmt->bindParam(':moTa', $moTa);
    $stmt->bindParam(':anh', $anh);
    $stmt->bindParam(':id', $flowerId);

    if ($stmt->execute()) {
        echo "<script>
                alert('Cập nhật hoa thành công!');
                window.close();
                header('Location: indexAdmin.php');
              </script>";
    } else {
        echo "Lỗi khi cập nhật hoa.";
    }
} else {
    if (isset($_GET['id'])) {
        $flowerId = $_GET['id'];
        $query = "SELECT * FROM flowers WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $flowerId);
        $stmt->execute();
        $flower = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$flower) {
            echo "Không tìm thấy hoa.";
            exit();
        }
    } else {
        echo "ID hoa không được xác định.";
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container my-5">
        <h1 class="text-center mb-4">Sửa Thông Tin Hoa</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="flowerId" value="<?= htmlspecialchars($flower['id']); ?>">
            <input type="hidden" name="currentImage" value="<?= htmlspecialchars($flower['anh']); ?>">
            
            <div class="mb-3">
                <label for="tenHoa" class="form-label">Tên Hoa</label>
                <input type="text" class="form-control" id="tenHoa" name="tenHoa" value="<?= htmlspecialchars($flower['tenHoa']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="moTa" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="moTa" name="moTa" required><?= htmlspecialchars($flower['moTa']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <img src="<?= htmlspecialchars($flower['anh']); ?>" alt="Ảnh Hoa" style="width:100px; height:auto; margin-top: 10px;">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Cập Nhật Hoa</button>
                <a href="index.php" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
