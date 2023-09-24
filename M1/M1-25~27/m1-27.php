<!--1.言語定義-->
<!DOCTYPE html>
<html lang="a">
<head>
    <meta chartset = "utf-8">
<!--タイトルを打つ-->
    <tytle>mission1-27.text</tytle>
</head>
<body>
    <form action="" method="post">
        <input type = "number" name="num" placeholder="番号">
        <input type = "submit" name="submit">
    </form>
</body>
</html>
<!--ファイルがあったらファイルを開いて-->
<?php
  $filename = "mission1-27.txt";
        if(!empty($_POST["num"])){
            $num = $_POST["num"];
        //ファイルを開く
           $fp=fopen($filename,"a");
         if($fp){
           fwrite($fp,$num.PHP_EOL);
           fclose($fp);
           echo"書き込み成功<br>";
           }else{
               echo"書き込み失敗<br>";
           }
        }
//ファイルがあったらループ処理する
        if(file_exists($filename)){
            $lines=file($filename,FILE_IGNORE_NEW_LINES);
            foreach($lines as $line){
            if($line%3==0 && $line%5==0){
                echo "FizzBuzz<br>";
            }elseif($line%3==0){
                echo "Fizz<br>";
            }elseif($line%5==0){
                echo"Buzz<br>";
            }else{
                echo $line."<br>";
            }
            }
        }