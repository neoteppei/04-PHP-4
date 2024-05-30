<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>うるう年判定</title>
</head>
<body>
    <?php
    function isLeapYear($year) {
        return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
    }

    for ($year = 1980; $year <= 2080; $year++) {
        if (isLeapYear($year)) {
            // うるう年の場合、画像を表示する
            echo "<p><img src='img/torch.png' alt='torch' style='width:20px;height:20px;'> {$year}年はうるう年です。</p>";
        } else {
            echo "<p>{$year}年</p>";
        }
    }
    ?>
</body>
</html>