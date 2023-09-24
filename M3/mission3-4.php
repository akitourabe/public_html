<?php
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        if(!empty($_POST["comment"]&&!empty($_POST["name"]))){
            //フォームから受け取ったものを取得
            $str= $_POST["comment"];
            $name=$_POST["name"];
            $input=$name."<>".$str;
            //ファイルを読み込みモードで開く
            $fp=fopen("mission3-4.txt","a");
            //行の投稿番号を計
            $postnumber=count(file("mission3-4.txt",FILE_IGNORE_NEW_LINES))+ 1;
            $posts =$postnumber."<>".$input;
                //ファイルに新しいデータを書き込む。
                fwrite($fp,$posts.PHP_EOL);
                fclose($fp);  
                $lines=file("mission3-4.txt",FILE_IGNORE_NEW_LINES);
                foreach($lines as $line){
                  $explode=explode("<>",$line,3);
                echo $explode[0]."<>".$explode[1]."<>".$explode[2]."<br>";
        }
  
    }
    }
    //もし編集フォームに何か入っていたら
    if(!empty($_POST["edit_submit"])){
        //編集フォームの中身を取得
        $edit =$_POST["edit_post_id"];
        $lines=file("mission3-4.txt",FILE_IGNORE_NEW_LINES);
        foreach($lines as $line){
            //ファイルの変数を＜＞で区切る
            //もし番号が編集フォームの番号と同じなら
            if($explode[0] == $edit ){
                //編集対象の投稿内容を取得する
                $edit_name=$_POST["name"];
                $edit_comment=$_POST["str"];
                break;
            }
        }
    }
    ?>
<form action="" method="post">
            <!--名前フォームの作成-->
        <input type="text" name="name" placeholder="名前" value="<?php if(!empty($_POST["editnumber"])) echo $edit_name;?>"><br>
        <!--コメントフォームの作成-->
        <input type="text" name="comment" placeholder="コメント" value="<?php if(!empty($_POST["editnumber"])) echo $edit_comment;?>">
        <input type="hidden" name="number" placeholder="編集対象番号" value="<?php if(!empty($_POST["editnumber"])) echo $edit_postnumber;?>">
        <!--送信ボタンの作成-->
        <input type="submit" name="submit" value="投稿"><br>
                <!--削除フォームのs区政-->
        <input type="number" name="delete" placeholder="削除番号">
        <!--削除ボタンの作成-->
        <input type="submit" name="submit" value="削除"><br>
        <!--編集番号指定フォームの作成-->
        <input type="number" name="editnumber" placeholder="編集番号">
        <input type="submit" name="edit" value="編集"><br>
        
        <?php
           $lines=file("mission3-4.txt",FILE_IGNORE_NEW_LINES);
           $edit_name=$_POST["name"];
            $edit_comment=$_POST["str"];
            foreach($lines as $line){
            $explode=explode("<>",$line,3);   
            echo$explode[0]."<>".$edit_name."<>".$edit_comment."<br>"; 
            }
        ?>