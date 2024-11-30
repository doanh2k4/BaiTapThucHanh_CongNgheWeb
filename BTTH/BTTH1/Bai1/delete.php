<?php
include("connect.php");

// Kiểm tra xem tham số ID 
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM flowers WHERE id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        // Thực thi câu lệnh SQL
        if ($stmt->execute()) {
            echo "  <script>
                        alert('Xóa hoa thành công!');
                        window.location.href = 'indexAdmin.php'; 
                    </script>";
            exit();
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Lỗi khi xóa hoa: " . $errorInfo[2];
        }

        $stmt = null;
    } else {
        $errorInfo = $conn->errorInfo();
        echo "Lỗi khi chuẩn bị câu lệnh SQL: " . $errorInfo[2];
    }
} else {
    echo "Không có ID hoa để xóa.";
}

$conn = null;
?>

