<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>簡易掲示板</title>
</head>
<body>
    <form action="" method="post">
        <!--名前の入力フォーム-->
        <input type="text" name="name" value="名前">
        <!--コメントの入力フォーム-->
        <input type="text" name="comment" value="コメント">
        <input type="submit" name="submit">
        <!--消去の入力フォーム-->
        <input type="text" name="deleteno" value="">
        <input type="submit" name="delete" value="削除">
    </form>
    <?php
          /*ファイルの指定*/
          $filename = "mission_3-1.txt";
          /*POST送信があったとき*/
          if(isset($_POST["delete"])){
          /*変数に代入*/
          $delete = $_POST["deleteno"];
          /*ファイル全体を読み込んで配列に格納する*/
          $delCon = file("mission_3-1.txt");
          /*配列の要素数（＝行数）だけループさせる*/
          for ($j = 0; $j < count($delCon) ; $j++){ 
          /*区切り文字「<>」で分割して、投稿番号を取得*/
          $delData = explode("<>", $delCon[$j]);
          /*投稿番号と削除対象番号を比較。等しくない場合はファイルに追加書き込みを行う*/
          if ($delData[0] == $delete) {
          array_splice($delcon, $j, 1);
          file_put_contents($filename, implode("\n", $delCon));
          }

          }
          fclose($fp);
          }
            /*POST送信があった時*/
            if (isset($_POST["submit"])){
            /*変数に代入*/
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            /*日付データ取得*/
            $date = date("Y/m/d H:i:s");
            /*ファイルの存在がある場合は投稿番号+1、なかったら１を指定*/
            if (file_exists($filename)) {
            $num = count(file($filename))+1;
            } else {
            $num = 1;
            }
            /*書き込む文字列を組み合わせた変数*/
            $data = "$num <> $name <> $comment <> $date". PHP_EOL;
            $fp2 = fopen($filename , "a");
            fwrite( $fp2 , $data);
            fclose($fp2);
            }
    ?>
    <?php   
            /*ファイル全体を読み込んで配列に格納する*/
            $ret_array = file( $filename );
            if(file_exists($filename)){
            foreach( $ret_array as $value ) {
            $result = explode("<>", $value);
            echo "$result[0] $result[1] $result[2] $result[3] <br>"  ;
            }
            }
            ?>