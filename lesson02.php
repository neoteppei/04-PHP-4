<?php
function numberLoop() {
    $rows = 5; 


for ($i = 1; $i <= $rows; $i++) {
    
    for ($j = $rows; $j > $i; $j--) {
        echo "*";
    }

    
    for ($j = 1; $j <= $i; $j++) {
        echo $j;
    }

    
    for ($j = $i - 1; $j >= 1; $j--) {
        echo $j;
    }

    
    echo "\n";
}


for ($i = $rows - 1; $i >= 1; $i--) {
    
    for ($j = $rows; $j > $i; $j--) {
        echo "*";
    }

    
    for ($j = 1; $j <= $i; $j++) {
        echo $j;
    }

    
    for ($j = $i - 1; $j >= 1; $j--) {
        echo $j;
    }

    
    echo "\n";
}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>ループ表示</title>
</head>
<body>
    <!-- numberLoop() 関数の結果を表示 -->
    <pre><?php echo numberLoop(); ?></pre>
</body>
</html>
