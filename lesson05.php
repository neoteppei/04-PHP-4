<?php

// 手札を取得する関数
function hand() {
    $cards = [];
    for ($i = 1; $i <= 5; $i++) {
        $suit = $_POST["suit$i"] ?? '';
        $number = $_POST["number$i"] ?? '';
        if ($suit && $number) {
            $cards[] = ['suit' => $suit, 'number' => (int)$number];
        }
    }
    return $cards;
}

// 判定関数
function judge($cards) {
    $valid_suits = ['heart', 'spade', 'diamond', 'club'];
    $valid_numbers = range(1, 13);

    // カードの不正チェック
    $suits = [];
    $numbers = [];
    foreach ($cards as $card) {
        // 絵柄が不正な場合は不正
        if (!in_array($card['suit'], $valid_suits) || !in_array($card['number'], $valid_numbers)) {
            return "手札が不正です";
        }

        // 同じ絵柄と数字のカードが複数ある場合は不正
        $card_key = $card['suit'] . $card['number'];
        if (in_array($card_key, $suits)) {
            return "手札が不正です";
        }
        $suits[] = $card_key;

        $suits[] = $card['suit'];
        $numbers[] = $card['number'];
    }

    // カードの番号とスートを抽出
    $numbers = array_column($cards, 'number');
    $suits = array_column($cards, 'suit');

    // スートがすべて同じか確認
    $is_flush = (count(array_unique($suits)) === 1);

    // 番号を昇順に並び替え
    sort($numbers);

    // ロイヤルストレートフラッシュの判定
    if ($is_flush && $numbers === [1, 10, 11, 12, 13]) {
        return "ロイヤルストレートフラッシュ";
    }

    // ストレートの判定
    $is_straight = true;
    for ($i = 1; $i < count($numbers); $i++) {
        if ($numbers[$i] !== $numbers[$i - 1] + 1) {
            $is_straight = false;
            break;
        }
    }

    // ストレートフラッシュの判定
    if ($is_flush && $is_straight) {
        return "ストレートフラッシュ";
    }

    // フォーカード、フルハウス、スリーカード、ツーペア、ワンペアの判定
    $counts = array_count_values($numbers);
    $pair_count = 0;
    $three_of_a_kind = false;
    $four_of_a_kind = false;

    foreach ($counts as $count) {
        if ($count === 2) {
            $pair_count++;
        } elseif ($count === 3) {
            $three_of_a_kind = true;
        } elseif ($count === 4) {
            $four_of_a_kind = true;
        }
    }

    if ($four_of_a_kind) {
        return "フォーカード";
    } elseif ($three_of_a_kind && $pair_count === 1) {
        return "フルハウス";
    } elseif ($is_flush) {
        return "フラッシュ";
    } elseif ($is_straight) {
        return "ストレート";
    } elseif ($three_of_a_kind) {
        return "スリーカード";
    } elseif ($pair_count === 2) {
        return "ツーペア";
    } elseif ($pair_count === 1) {
        return "ワンペア";
    } else {
        return "役はなしです";
    }
}

// フォームが送信された場合の処理
$hand = [];
$result = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hand = hand();
    $result = judge($hand);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" style="text/css" href="./css/style.css">
<title>ポーカー役判定</title>
</head>
<body>
    <form action="#" method="POST" name="formtype">
        <section>    
            <div class="flex">
                <?php for($i = 1; $i <= 5; $i++){ ?>
                <div class="card">
                    <p><?php echo $i . ":" ?> 
                    <select name="<?php echo "suit".$i ?>" class="suit">
                        <option value=""></option>
                        <option value="spade">spade</option>
                        <option value="diamond">diamond</option>
                        <option value="heart">heart</option>
                        <option value="club">club</option>
                    </select>
                    <select name="<?php echo "number".$i ?>">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                    </select>
                </div>
                <?php } ?>
                <button type="submit" class="button1" name="submit">判定</button>
            </div>
            <div>
                <p>手札は 
                    <?php 
                    foreach ($hand as $card) {
                        echo $card['suit'] . $card['number'] . ' ';
                    }
                    ?>
                </p>
            </div>
            <div>
                <p>役は <?php echo $result; ?></p>
            </div>
         </section>
    </form>
</body>
</html>