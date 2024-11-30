<?php include("connect.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các loại hoa</title>
    <style>
        .container { max-width: 800px; margin: auto; }
        .card { border: 1px solid #ddd; border-radius: 8px; overflow: hidden; margin-bottom: 20px; }
        .card-img-top { width: 100%; height: auto; }
        .card-body { padding: 15px; }
        .card-title { font-size: 1.5em; color: #333; }
        .card-text { font-size: 1em; color: #666; }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Danh sách Hoa</h1>
        <div class="flower-list">
            <?php foreach ($flowers as $flower): ?>
                <div class="card">
                    <img src="<?= $flower['anh']; ?>" class="card-img-top" alt="<?= $flower['tenHoa']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($flower['tenHoa']); ?></h5>
                        <p class="card-text"><?= htmlspecialchars($flower['moTa']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>
