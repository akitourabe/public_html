 <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title> "m_3-4" </title>
</head>
<body>
   

<?php
    $filename="mission_3-4.txt";
    //編集モード化新規投稿mode化の判別
    //送信フォームを受信する場合
    


  if(isset($_POST["submit"])){
    if(!empty($_POST["name"])&&!empty($_POST["comment"])){
     $name=$_POST["name"];
     $comment=$_POST["comment"];
     $date=date("Y/m/d H:i:s");
     $mode = empty($_POST["edit_number"]) ? "new" : "edit";
      
        //新規投稿
        if (empty($_POST["mode"])) {
         // 既存のコメント数をカウントして投稿番号を決定
             if(file_exists($filename)){
                $lastpostnumber=file($filename,FILE_IGNORE_NEW_LINES);//指定されたファイルの内容を行ごとに分割し、それぞれの行を要素とする
                $postnumber=count($lastpostnumber)+1;//存在する行を読み込んでそこから投稿番号を続ける
         
            }else{
                $postnumber=1;
        }  
    
         $comments="$postnumber<>$name<>$comment<>$date";
     
        $fp=fopen($filename,"a");
            fwrite($fp,$comments.PHP_EOL);
            fclose($fp);
             
        
    
        }
    //編集処理
    elseif(!empty($_POST["mode"])){
    
    $edited_postnumber=$_POST["mode"];
    $new_name=$_POST["name"];
    $new_comment=$_POST["comment"];
    
    $fp = fopen($filename, "r+");
    //一行一要素として読み取る
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    $new_lines=array();
      
        //配列の各要素を順番に取り出すループを開始する
        foreach ($lines as $line) {
            //各行の内容を区切り文字で分割し、結果を$valueに格納する。
            $explode = explode("<>", $line);
            $postnumber = $explode[0];
        
            //編集番号と投稿番号を比較、投稿番号と編集番号が一致したとき
            if ($postnumber == $edited_postnumber) {
           
            //該当業の内容を差し替える
              
                $edited_line = "$edited_postnumber<>$new_name<>$new_comment<>$date";
                $new_lines[] = $edited_line;//新しい内容を追加
            } else {
                //編集対象でない行はそのまま新しい内容に追加
                $new_lines[] = $line;
            }
        }
    
    
    ftruncate($fp, 0);// ファイルの内容を空にする
    rewind($fp);//$fpを先頭に戻すことで新しい内容をファイルの先頭から書き込む
    
    // 更新された内容をファイルに書き込む
    foreach ($new_lines as $new_line) {
        fwrite($fp, $new_line . PHP_EOL);
    }
    
    // ファイルをクローズ
    fclose($fp);
    
    }
    }     
  }

      
     
     
     
   //削除フォームを受信する場合
       if(isset($_POST["delete_submit"])){
         $deletenumber=$_POST["delete_number"];
         //一行一要素として読み取る
         $lines=file($filename,FILE_IGNORE_NEW_LINES);
         //newlinesに空の配列が格納される
         $newlines=array();
         
         foreach($lines as $line){
         $value=explode("<>",$line);
         
         //この時$value[0]は投稿番号だから…
         $postnumber=$value[0];
         //投稿番号と削除対象番号を比較。投稿番号が削除番号と一致しない時…
         if($postnumber!==$deletenumber){
        //一致しない行を$newlinesに追加して削除後のファイル内容を作成する
        //これをループすることで、削除対象番号に対応する行をファイルから除外した内容が$newlinesに格納される
             $newlines[]=$line;
         }
         } 
         $fp = fopen($filename, "w");
         foreach ($newlines as $newline) {
            fwrite($fp, $newline. PHP_EOL);
    }
    fclose($fp);
        
     }
//編集フォームが投稿された場合編集元表示欄に表示させる
if(isset($_POST["edit_submit"])) {
    //集フォームが送信された場合、編集対象の投稿番号を取得
    $edited_postnumber = $_POST["edit_number"];
    //ファイルから投稿を読み込む
    $lines=file($filename,FILE_IGNORE_NEW_LINES);
    
    
    
    //ループ開始
    foreach($lines as $line){
            $value=explode("<>",$line);
            $postnumber = $value[0];
         
            if ($postnumber == $edited_postnumber) {
                $edit_name = $value[1];//ここでそのnameを格納してフォームに送る
                $edit_comment = $value[2];//ここでそのcommentを格納してフォームに送る
                break; // 該当する行が見つかったらループを終了
    
    
           }
      }
    
   
      
    }     

    ?>    // 
    
    
     <form action=""method="POST">
        <!---名前入力欄-->
        <label for="name">名前:</label>
        <input type="text" name="name" value="<?php if(isset($_POST["edit_submit"])) echo $edit_name; ?>"><br>
        <!--コメント入力欄-->
        <label for="comment">コメント:</label>
        <input type="text" name="comment"value="<?php if (isset($_POST["edit_submit"])) echo $edit_comment;?>">
        
     
    
         <!--編集元の番号が表示される欄-->
        <input type="hidden" name="mode" value="<?php  if(isset($edited_postnumber)) echo $edited_postnumber  ?>">
        
        <!--送信ボタン-->
        <input type="submit" name="submit" value="送信"><br>
     </form>
     <!--フォームを作り直さないと送信ボタンの隣に削除ボタンができてしまう-->

   
     <form action=""method="POST">　
         <!--削除番号用指定フォーム-->
         <label for="delete_number">削除対象番号:</label>
         <input type="number" name="delete_number" >
        
        
        <!---削除ボタン-->
        <input type="submit"name="delete_submit"value="削除" ><br>
    </form>
        
        <!--編集フォーム-->
        <form action="" method="POST">
        <label for="edit_number">編集番号:</label>
        <input type="number" name="edit_number">
      <!--編集ボタン-->
         <input type="submit" name="edit_submit" value="編集"><br>
    </form>
    
    <?php 
    
      $lines=file($filename,FILE_IGNORE_NEW_LINES);
     
     foreach($lines as $line){
         //explode関数で読み込んだデータを分割することで、投稿番号や名前などを取得して表示させることができる。
         $value=explode("<>",$line); 
         $postnumber=$value[0]; 
         $name=$value[1];
         $comment=$value[2];
         $date=$value[3];
         
         //取得した値をブラウザに表示
         echo "投稿番号:$postnumber<br>";
         echo"名前:$name<br>";
         echo"コメント:$comment<br>";
         echo"投稿日時:$date<br>";
         
     }
    ?>
</body>
</html>