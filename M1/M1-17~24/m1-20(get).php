<?php
    echo $_GET["message"];
    ?>
<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta chartset = "UTF-8">
        <tytle>お試し</tytle>
    </head>
    <body>
        <form action = "index.php" method = "get">
            
            <input type ="text" name = "message"><br>
            <input type ="submit" value = "送信">
            
        </form>
    </body>
</html>
