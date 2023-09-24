<!--1.言語定義-->
<!DOCTYPE html>
<head>
    <meta chartset ="UTF-8">
    <tytle>mission_1-27</tytle>
</head>
<body>
<!--2.フォームを作成する-->
    <form action =""method= "post">
        <input type = "number" name="num" placeholder="数字を入力">
        <input type = "submit" name="submit">
    </form>
    </body>
    </html>
<!--３．ファイル作成(ここからPHP)-->
<?PHP
    $filename="mission_1-27.txt";
//numに何か入っていれば
    if (isset($_POST["num"])){
        $num = $_POST["num"];
//ファイルを開く
    $fp= fopen($filename,"a");
//ファイルに書き込む
if($fp){
    fwrite($fp,$num.PHP_EOL);
//ファイルを閉じる
    fclose($fp);
//ファイルに書き込み成功とつける
    echo "書き込み成功<br>";
    }else {
        echo "書き込んでください";
    }
    }
//ファイルがあったら
        if(file_exists($filename)){
    $lines = file($filename,FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
//もし3の倍数かつ５の倍数の時FizzBuzz　
    if ($line%3==0 && $line%5==0){
      echo "FizzBuzz<br>";
      
      }elseif($line%3==0){
        echo "Fizz<br>";
    
    } elseif($line%5 == 0){
        echo  "Buzz<br>";
    }else{
        echo $line."<br>";
    }
  }
}
?>