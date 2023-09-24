<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta chartset = "UTF-8">
        <tytle>お問い合わせフォーム</tytle>
    </head>
    <body>
        <form action = "confirm.php" method = "get">
            名前<br>
            <input type ="text" name = "message"><br>
            メールアドレス<br>
            <input type ="e-mail" name = "メアド"><br>
            
            インターン志望理由<br>
            <textarea name = "message" rows ="8" cols="2">
            </textarea><br>
            
            <input type="submit" value = "確認">
            
        </form>
    </body>
</html>