<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-3</title>
</head>
<body>
    <!--フォームの作成-->
    <form action="" method="post">
        <!--名前フォームの作成-->
        <input type="text" name="name" placeholder="名前"><br>
        <!--コメントフォームの作成-->
        <input type="text" name="comment" placeholder="コメント"><br>
        <!--送信ボタンの作成-->
        <input type="submit" name="submit" value="投稿"><br>
                <!--削除フォームのs区政-->
        <input type="number" name="delete" placeholder="削除番号"><br>
        <!--削除ボタンの作成-->
        <input type="submit" name="submit" value="削除"><br>
    </form>
    <?php
        $filename="mission_3-3.txt";
        $name=$_POST["name"];
        $comment=$_POST["comment"];
        $date=date("Y/m/d　H:i:s");

        if(file_exists($filename)){
            $postnumber=file($filename,FILE_IGNORE_NEW_LINES);
            $postNumber=count($postnumber)+1;
            
        }
        $total=$postNumber."<>".$name."<>".$comment."<>".$date;
        $delete=$_POST["delete"];
        
        if(!empty($_POST["delete"])){
            if(file_exists($filename)){
                $lines=file($filename,FILE_IGNORE_NEW_LINES);
            //テキストファイルをw+モードで開く
                $fp=fopen($filename,"w+");
            //配列のすべての要素について、変数への代入を繰り返す
                foreach($lines as $line_data){
            //$lineで分割
                        $line=explode("<>",$line_data);
                         if (count($line) >= 4) {
                        //$line[0]削除番号のこと
                        if($delete!=$line[0]){
                            fwrite($fp,$line_data.PHP_EOL);
                            echo $line[0].$line[1].$line[2].$line[3]."<br>";
                        }
                    }
                }
                fclose($fp);
                }    
        }elseif(!empty($_POST["name"]) && !empty($_POST["comment"])){
        //テキストファイルを追記モードで開く
            $fp=fopen($filename,"a");
         //テキストファイルにPOSTを受け取った$totalを保存して偉業ごとに改行
            fwrite($fp,$total.PHP_EOL);
        //テキストファイルを閉じる
            fclose($fp);
            if(file_exists($filename)){
        //配列にテキストファイルの中身を読み込む
                $lines=file($filename,FILE_IGNORE_NEW_LINES);
        //配列のすべての要素について、変数への代入を繰り返す
                foreach($lines as $line_data){
            //$lineで分割
                    $line=explode("<>","$line_data");
                    if (count($line) >= 4) {
                    echo $line[0].$line[1].$line[2].$line[3]."<br>";
                }
            }
        }
    }
        
    ?>
</body>
</html>
