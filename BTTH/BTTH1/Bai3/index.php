<?php
$filename = "KTPM3_Danh_sach_diem_danh.csv";

$sinhvien = [];

if (($handle = fopen($filename, "r")) !== FALSE) {
    $headers = fgetcsv($handle, 1000, ",");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $sinhvien[] = array_combine($headers, $data);
    }

    fclose($handle);
}

// print_r($sinhvien);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Danh sách sinh viên</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Course1</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 1;
                foreach ($sinhvien as $sv) {
                    echo "<tr>";
                        echo "<td>{$stt}</td>";
                        echo "<td>{$sv['username']}</td>";      
                        echo "<td>{$sv['password']}</td>";   
                        echo "<td>{$sv['lastname']}</td>";   
                        echo "<td>{$sv['firstname']}</td>"; 
                        echo "<td>{$sv['city']}</td>";       
                        echo "<td>{$sv['email']}</td>";     
                        echo "<td>{$sv['course1']}</td>";   
                    echo "</tr>";
                    $stt++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
