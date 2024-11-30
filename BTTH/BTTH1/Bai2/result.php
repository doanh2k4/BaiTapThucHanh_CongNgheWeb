<?php
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$current_question = [];
$all_answers = [];
foreach ($questions as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            $all_answers[] = $current_question;
        }
        $current_question = [];
    }
    $current_question[] = $line;
}
if (!empty($current_question)) {
    $all_answers[] = $current_question;
}

$correct_answers = [];
foreach ($all_answers as $question) {
    $correct_answers[] = trim(substr($question[5], strpos($question[5], ":") + 1));
}

$score = 0;
foreach ($_POST as $key => $userAnswer) {
    $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
    if (isset($correct_answers[$questionNumber - 1]) && $correct_answers[$questionNumber - 1] === $userAnswer) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success text-center">
            Bạn trả lời đúng <strong><?php echo $score; ?></strong> / <?php echo count($correct_answers); ?> câu.
        </div>
        <a href="index.php" class="btn btn-primary">Làm lại</a>
    </div>
</body>
</html>
