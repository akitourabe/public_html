<?php
    $date = date("Y年m月d日 H時i分s秒");
    echo $date;
?>
        <!--dateが抜けててエラー-->
        
<?php
    $date = date("y年M月D日 h時i分S秒");
    echo $date;
?>
    <!--ｙは２千が抜ける
        Mは月の英語表記に、
        sは日の英語表記に、Dは曜日になる
        hは１２時間表記になる
        iはなぜか０になる-->
        
        