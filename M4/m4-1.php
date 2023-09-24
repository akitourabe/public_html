
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
    ?>