<?php include("connect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý các loại hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        img {
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <main class="container my-5">
        <h1 class="text-center mb-4">Danh sách các loài hoa</h1>

        <!-- Nút thêm hoa -->
        <a href="add.php" class="btn btn-success mb-3" target="_blank">
            <i class="fa-solid fa-plus"></i> Thêm hoa
        </a>

        <!-- Bảng danh sách hoa -->
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên hoa</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                </tr>
            </thead>

            <tbody>
                <?php $stt = 1;
                foreach ($flowers as $index => $flower): ?>
                    <tr>
                        <td><?= $stt++; ?></td>
                        <td><?= htmlspecialchars($flower['tenHoa']); ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($flower['anh']); ?>" alt="<?= htmlspecialchars($flower['tenHoa']); ?>" style="width:100px; height:auto;">
                        </td> <!-- Di chuyển ảnh -->
                        <td><?= htmlspecialchars($flower['moTa']); ?></td>
                        <td>
                            <!-- Nút sửa -->
                            <a href="edit.php?id=<?= $flower['id']; ?>" class="btn btn-warning" target="_blank">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </td>
                        <td>
                            <!-- Nút xóa -->
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                data-index="<?= $index; ?>">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </main>

    <!-- Modal xác nhận xóa -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Xác Nhận Xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa hoa này không?</p>
                        <input type="hidden" id="deleteIndex" name="deleteIndex">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <a href="delete.php?id=<?= $flower['id']; ?>" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> Xóa
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Xử lý dữ liệu truyền vào modal sửa
        const editModal = document.getElementById('editFlowerModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');
            const image = button.getAttribute('data-image');

            const modalNameInput = editModal.querySelector('#editTenHoa');
            const modalDescriptionInput = editModal.querySelector('#editMoTa');
            const modalImageInput = editModal.querySelector('#editImage');
            const modalImagePreview = editModal.querySelector('#editImagePreview');
            const modalFlowerIdInput = editModal.querySelector('#editFlowerId');

            modalNameInput.value = name;
            modalDescriptionInput.value = description;
            modalImagePreview.src = image;
            modalFlowerIdInput.value = id;
        });
    </script>
</body>

</html>