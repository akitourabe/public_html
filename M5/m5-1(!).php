
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// データベース接続設定
$dsn = 'mysql:dbname=tb250301db;host=localhost';
$user = 'tb-250301';
$password = 'waZh6pVrTa';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// テーブル再作成（新しいカラム 'new_pass' を含む）
$sql = "CREATE TABLE IF NOT EXISTS tbtest (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name char(32),
    comment TEXT,
    date DATETIME,
    new_pass VARCHAR(13)
);";
$stmt = $pdo->query($sql);

// 編集対象のデータを格納する変数
$edit_id = "";
$edit_name = "";
$edit_comment = "";

// 新規投稿処理
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["new_submit"])) {
    if (!empty($_POST["name"]) && !empty($_POST["comment"])) {
        $name = $_POST["name"];
        $comment = $_POST["comment"];
        $date = date("Y/m/d H:i:s");
        $passcode = $_POST["new_pass"];

        $sql = "INSERT INTO tbtest (name, comment, date, new_pass) VALUES (:name, :comment, :date, :new_pass)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':new_pass', $passcode, PDO::PARAM_STR);
        $stmt->execute();
    }
}

// 削除機能
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_submit"])) {
    if (!empty($_POST["delete_number"]) && !empty($_POST["delete_pass"])) {
        $delete_number = $_POST["delete_number"];
        $delete_password = $_POST["delete_pass"];

        $sql = 'SELECT * FROM tbtest WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $delete_number, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['new_pass'] == $delete_password) {
            $sql = 'DELETE FROM tbtest WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $delete_number, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
}

// 編集機能 - 編集ボタンが押された場合の処理
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["edit_submit"])) {
    if (!empty($_POST["edit_number"]) && !empty($_POST["edit_pass"])) {
        $edit_number = $_POST["edit_number"];
        $edit_password = $_POST["edit_pass"];

        $sql = 'SELECT * FROM tbtest WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $edit_number, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['new_pass'] == $edit_password) {
            $edit_id = $row['id'];
            $edit_name = $row['name'];
            $edit_comment = $row['comment'];
        }
    }
}

// 編集機能 - 編集フォームからの更新処理
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["edit_update"])) {
    if (!empty($_POST["edit_number"]) && !empty($_POST["edit_pass"]) && !empty($_POST["edit_name"]) && !empty($_POST["edit_comment"])) {
        $edit_number = $_POST["edit_number"];
        $edit_password = $_POST["edit_pass"];
        $new_name = $_POST["edit_name"];
        $new_comment = $_POST["edit_comment"];

        $sql = 'SELECT * FROM tbtest WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $edit_number, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['new_pass'] == $edit_password) {
            $sql = 'UPDATE tbtest SET name = :name, comment = :comment WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $new_name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $new_comment, PDO::PARAM_STR);
            $stmt->bindParam(':id', $edit_number, PDO::PARAM_INT);
            $stmt->execute();

            // 編集後に変数をクリア
            $edit_id = "";
            $edit_name = "";
            $edit_comment = "";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>mission.5-1</title>
</head>
<body>
    <br>新規投稿<br>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前" value="<?php echo htmlspecialchars($edit_name); ?>"><br>
        <textarea name="comment" cols="30" rows="5" placeholder="コメント"><?php echo htmlspecialchars($edit_comment); ?></textarea><br>
        <input type="password" name="new_pass" placeholder="パスワード">
        <input type="submit" name="new_submit" value="投稿"><br>
    </form>
    
    <!-- 削除 -->
    <br>削除<br>
    <form action="" method="post">
        <input type="number" name="delete_number" placeholder="削除したい番号"><br>
        <input type="password" name="delete_pass" placeholder="パスワード">
        <input type="submit" name="delete_submit" value="削除"><br>
    </form>

    <!-- 編集 -->
    <br>編集<br>
    <form action="" method="post">
        <input type="text" name="edit_name" placeholder="編集する名前" value="<?php echo htmlspecialchars($edit_name); ?>"><br>
        <textarea name="edit_comment" cols="30" rows="5" placeholder="編集する内容"><?php echo htmlspecialchars($edit_comment); ?></textarea><br>
        <input type="number" name="edit_number" placeholder="編集対象番号"><br>
        <input type="password" name="edit_pass" placeholder="パスワード">
        <input type="submit" name="edit_submit" value="編集">
    </form>
    <!-- 編集後の更新ボタン -->
    <?php if (!empty($edit_id)) : ?>
        <form action="" method="post">
            <input type="hidden" name="edit_number" value="<?php echo $edit_id; ?>">
            <input type="hidden" name="edit_pass" value="<?php echo htmlspecialchars($_POST["edit_pass"]); ?>">
            <input type="text" name="edit_name" placeholder="編集する名前" value="<?php echo htmlspecialchars($edit_name); ?>"><br>
            <textarea name="edit_comment" cols="30" rows="5" placeholder="編集する内容"><?php echo htmlspecialchars($edit_comment); ?></textarea><br>
            <input type="submit" name="edit_update" value="更新">
        </form>
    <?php endif; ?>

    <!-- 投稿内容を表示 -->
    <?php
    $sql = 'SELECT * FROM tbtest';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row) {
        echo $row['id'] . ',';
        echo $row['name'] . ',';
        echo $row['comment'] . ',';
        echo $row['date'] . '<br>';
        echo "<hr>";
    }
    ?>
</body>
</html>