<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta chartset = "UTF-8">
        <title>mission 1-20</title>
    </head>
    <body>
        <form action=""method="post">
            <input type ="text"name="str">
            <input type ="submit"name ="submit">
        </form>
        <?php
                $str = $_POST["str"];
                echo $str;
                ?>
    </body>
</html>