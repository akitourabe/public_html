<!DOCTYPE html>
<!--１．HTMLパート：入力フォームを準備-->
<head>
    <body>
<!--書式設定-->
    <meta chartset=utf-8>
    <tytle>mission2-1.txt</tytle>
<!--フォーム設定-->
     <form action =""method= "post">
        <input type = "text" name="str" placeholder="コメント">
        <input type = "submit" value="送信">
      
    </form>
    </body>
</head>
<!--HTMLパートから送信・PHPパートで受信：
入力フォームから「POST送信」し、PHPで受信して変数に
代入-->

<!--テキストファイルに受信させる-->
<?php
//もしに送信されてたら、
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        if (!empty($_POST["str"])){
//内容を受信するポストを立てる
        $str= $_POST["str"];
//ファイルを指定する
        $filename = "mission2-1.txt";
//ファイルを開けて書き込み閉じる
//１.送信ごとに追記する
        $fp=fopen($filename,"w");
//２.ファイルがひらいたら行ごとに書いてとじる
        fwrite($fp,$str.PHP_EOL);
        fclose($fp);
//～を受け付けましたと表示する
        echo $str."を受け付けました<br>";
        
//何も入ってないときは入力に失敗しましたって表示する
        }else{
        echo"入力に失敗しました";
    }
    }else{
        echo "入力してください";
    }
?>
