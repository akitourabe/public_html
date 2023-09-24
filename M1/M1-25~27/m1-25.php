<?php
    $str = "Hello World";
    $filename = "mission_1-25.txt";
    //書き込みモードでファイルを開く
    $file = fopen($filename,"w+b");
    
    //ファイルに書き込む
    fwrite ($file, $str.PHP_EOL);

    //ファイルを閉じる
    fclose ($file);
    
    echo "書き込み成功！";
    ?>
    