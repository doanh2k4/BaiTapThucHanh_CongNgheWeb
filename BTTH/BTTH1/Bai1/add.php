<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tenHoa = $_POST['tenHoa'];
    $moTa = $_POST['moTa'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'images/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (getimagesize($_FILES['image']['tmp_name']) !== false && $_FILES['image']['size'] < 5000000) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $anh = $uploadFile;

                $query = "INSERT INTO flowers (tenHoa, moTa, anh) VALUES (:tenHoa, :moTa, :anh)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':tenHoa', $tenHoa);
                $stmt->bindParam(':moTa', $moTa);
                $stmt->bindParam(':anh', $anh);

                if ($stmt->execute()) {
                    echo "<script>
                            alert('Thêm hoa thành công!');
                            window.close(); 
                            header('Location: indexAdmin.php');
                            exit();
                          </script>";
                } else {
                    echo "Lỗi khi thêm hoa mới.";
                }
            } else {
                echo "Lỗi khi tải ảnh lên.";
            }
        } else {
            echo "Vui lòng chọn một ảnh hợp lệ.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hoa Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main class="container my-5">
        <h1 class="text-center mb-4">Thêm Hoa Mới</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tenHoa" class="form-label">Tên Hoa</label>
                <input type="text" class="form-control" id="tenHoa" name="tenHoa" required>
            </div>
            <div class="mb-3">
                <label for="moTa" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="moTa" name="moTa" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Thêm Hoa</button>
                <a href="index.php" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>