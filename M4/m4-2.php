
<?php
    // 【サンプル】
    // ・データベース名：tb219876db
    // ・ユーザー名：tb-219876
    // ・パスワード：ZzYyXxWwVv
    // の学生の場合：

    // DB接続設定
    $dsn = 'mysql:dbname=tb219876db;host=localhost';
    $user = 'tb-219876';
    $password = 'ZzYyXxWwVv';
    $pdo = new PDO($dsn, $user, $password);
    $sql = "CREATE TABLE IF NOT EXISTS tbtest"//もしtbtestのテーブルがあったら、表を作る
    ."("
    ."id INT AUTO_INCREMENT PRIMARY KEY,"//このコードはもしtbtestという名前のテーブルがまだ存在しない場合に、新しいテーブルを作成します。このテーブルは、id、name、commentという3つのカラムを持ち、idカラムは主キーとして設定され、自動的に増加する一意の値を持ちます。このテーブルを使用してデータを保存できます。
    ."name char(32),"
    ."comment TEXT"
    .");";
    $stmt = $pdo->query($sql);
    //アロー演算子でアクセスする。でSQLクエリ（$sqlの中身)
    //をデータに送信し、クエリの実行結果を格納する。
    ?>
    