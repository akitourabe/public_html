<!DOCTYPE html>
<!--１．HTMLパート：入力フォームを準備-->
<head>
    <body>
<!--書式設定-->
    <meta chartset=utf-8>
    <tytle>mission2-3.txt</tytle>
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
//もしPOST送信が行われていたら
    if($_SERVER["REQUEST_METHOD"]==="POST"){
//もしPOSTに文字が入っていたら開いて書いて閉じる
        if (!empty($_POST["str"])){
        $str= $_POST["str"];
        
        $filename = "mission2-3.txt";
        
        $fp=fopen($filename,"a");
        
        fwrite($fp,$str.PHP_EOL);
        fclose($fp);
        //もしファイルが存在したら改行して表記できるようにする
        if(file_exists($filename)){
            $lines=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
            echo $str."を受け付けました<br>";
            }
        }
        //POSTに何も入っていなかったら
        }else{
        echo"入力に失敗しました";
        }
//もしPOST送信が行われていなかったら
    }else{
        echo "入力してください";
    }
?>