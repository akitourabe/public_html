<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>簡易掲示板の入力フォーム</title>
</head>
<body>
    <!-- 入力フォームの作成 -->
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前"><br>
        <textarea name="str" cols="30" rows="5" placeholder="コメント"></textarea><br>
        <input type="submit" value="送信"><br>
        <input type="number" name="bangou" placeholder="削除対象番号"><br>
        <input type="submit" name="delete" value="削除">
    </form>
</body>

<?php
$filename = "mission3-3.txt";

// 新規投稿処理
if (!empty($_POST["name"]) && !empty($_POST["str"])) {
    $name = $_POST["name"];
    $str = $_POST["str"];
    $date = date("Y-m-d H:i:s");
    $postNumber=count($lines)+1;
    $line = "$postNumber<>$name<>$str<>$date";
    $fp = fopen($filename, "a");
    fwrite($fp, $line.PHP_EOL);
    fclose($fp);
}

// ファイルの読み込みと表示
if (file_exists($filename)) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    $postNumber=count($lines)+1;
    foreach ($lines as $line) {
        $com = explode("<>", $line,4);
        echo $com[0] . $com[1] . $com[2] . $com[3] ."<br>";
    }
}

// 削除処理
if (isset($_POST["delete"]) && isset($_POST["bangou"])) {
    $deleteNumber = $_POST["bangou"];
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    $fp = fopen($filename, "w");
    foreach ($lines as $line) {
        $parts = explode("<>", $line);
        $postNumber = $parts[0];
        if ($postNumber != $deleteNumber) {
            fwrite($fp, $line.PHP_EOL);
        }
    }
    fclose($fp);
}
?>