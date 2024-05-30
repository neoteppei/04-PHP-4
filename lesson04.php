<?php
$arr = [
    'r1' => ['c1' => 10, 'c2' => 5, 'c3' => 20],
    'r2' => ['c1' => 7, 'c2' => 8, 'c3' => 12],
    'r3' => ['c1' => 25, 'c2' => 9, 'c3' => 130]
];

// 行と列の合計を計算
$row_sums = [];
$col_sums = ['c1' => 0, 'c2' => 0, 'c3' => 0];

foreach ($arr as $row_key => $row) {
    $row_sum = array_sum($row);
    $row_sums[$row_key] = $row_sum;

    foreach ($row as $col_key => $value) {
        $col_sums[$col_key] += $value;
    }
}

$total_sum = array_sum($col_sums);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>テーブル表示</title>
<style>
table {
    border:1px solid #000;
    border-collapse: collapse;
}
th, td {
    border:1px solid #000;
    padding: 5px;
    text-align: right;
}
</style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>c1</th>
                <th>c2</th>
                <th>c3</th>
                <th>横合計</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($arr as $row_key => $row): ?>
                <tr>
                    <th><?php echo $row_key; ?></th>
                    <?php foreach ($row as $col_key => $value): ?>
                        <td><?php echo $value; ?></td>
                    <?php endforeach; ?>
                    <td><?php echo $row_sums[$row_key]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>縦合計</th>
                <?php foreach ($col_sums as $col_sum): ?>
                    <td><?php echo $col_sum; ?></td>
                <?php endforeach; ?>
                <td><?php echo $total_sum; ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>