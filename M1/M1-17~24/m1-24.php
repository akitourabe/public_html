<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission_1-24</title>
    </head>
    <body>
        <a href="">リセット</a><br><!--←postパラメータを消します。-->;
        <form action="" method="post">
        <input type ="text" name="str" placeholder="何かを入力">
        <input type = "submit" name="submit">
        </form>
        ＊＊＊<br>
        １、ノーチェック:<br>
        <?php
                $str =$_POST["str"];
                echo "[$str]";
                ?><br>
        2.issetチェック；<br>
        <?php
                if(isset ($_POST["str"])){
                    $str = $_POST["str"];
                    echo"[".$str."]";
                }else{
                    echo"-post送信なし-";
                }
                ?><br>
        3.empty チェック;<br>
        <?php   
                if(!empty($_POST["str"])){
                     $str = $_POST["str"];//！マークを入れないと操作が逆になる
                    echo "【".$str."】";
        } else {
                echo "- str 中身なし -";
        }
    ?>
        
    </body>
    </html>
