<DOCTYPE!>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <title>mission_3-3</title>
        </head>
        <body>
            <!-- フォームを作成 --> 
            <form action="" method="post">
                <!-- 名前入力欄 --> 
                <input type="text" name="name" placeholder="名前">
                <!-- コメント入力欄 -->
                <input type="text" name="str" placeholder="コメント">
                <!-- 送信ボタン -->
                <input type="submit" name="submit" value="投稿">
            </form>
            
            <form action="" method="post">
                
                <input type="number" name="number" placeholder="削除対象番号">
                
                <input type="submit" value="削除">
                
            </form>
        </body>
    <?php

        $filename = "mission_3-3(3).txt";

        if(!empty($_POST["name"]) && !empty($_POST["str"])){
                
                $name = $_POST["name"];
                
                $str = $_POST["str"];
              
                $date = date("Y/m/d H:i:s");
                
                //もしテキストファイルが存在するなら
                if(file_exists($filename)){
                    //ファイルの既存の要素数（≒最後の投稿番号）をカウントして、＋1する
                    $num = count(file($filename,FILE_IGNORE_NEW_LINES)) + 1;
                
                }else{
                    //ファイルが存在しない（投稿が一つもない）時は、投稿番号が1
                    $num = 1;
                }
                
                $comment = $num . "<>" . $name . "<>" . $str . "<>" . $date;
            
                $fp = fopen($filename, "a");
                
                fwrite($fp, $comment . PHP_EOL);

                fclose($fp);
                //ファイルを1行ずつ読み込み、配列変数に代入する
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
                
                foreach($lines as $line){
                    $com = explode("<>", $line);
                    if(!empty("$line")){
                    echo $com[0];
                    echo $com[1];
                    echo $com[2];
                    echo $com[3] . "<br>";
                    }
                }
                
                
        }elseif(!empty($_POST["number"])){
        
                $number = $_POST["number"];
                
                $lines = file($filename,FILE_IGNORE_NEW_LINES);
                
                $fp = fopen($filename, "w");
                
                
                foreach($lines as $line){
                
                    $com = explode("<>", $line);  
                    
                    if($com[0] != $number){
                    
                        fwrite($fp, $line. PHP_EOL);
                        
                        if(!empty("$line")){
                        echo $com[0];
                        echo $com[1];
                        echo $com[2];
                        echo $com[3] . "<br>";
                        }
                    }else{
                        fwrite($fp, "". PHP_EOL);
                    }
                }
                fclose($fp); 

        }   
               
        
    ?>