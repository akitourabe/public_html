<!--まず書式設定-->
<!DOCTYPE html>
<head>
    <meta chartset = utf-8>
    <tytle>簡易掲示板の入力フォーム</tytle>
</head>
<body>
 <form action = "", method = post>
     <input type ="text" name="name" placeholder="名前">
     <input type ="text" name = "str" placeholder="コメント">
     <input type ="submit" value = "送信">
 </form>
</body>
   
<?php
    
//もし中に文字が両方入っていたらテキストファイルに書き出す
    if(!empty($_POST["name"]&& $_POST["str"])){
        
    $name =$_POST["name"];
    $filename="mission3-1.txt";
    $str = $_POST["str"];
    $date =date("Y-m-d H:i:s");
     $L = "$name<>$str<>$date";
    $fp = fopen($filename,"a");
    fwrite($fp,$L.PHP_EOL);
    fclose($fp);
    //ファイルの書き出しができたら、ファイルに保存し改行
    if(file_exists($filename)){
        $lines=file($filename,FILE_IGNORE_NEW_LINES);
        foreach($lines as $id =>  $line){
            echo $id+ 1 ."$line<br>";
        }
    }
}
    ?>
    