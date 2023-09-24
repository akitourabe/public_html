<?php
    $ltems = array (2,3,5,7,11,13,17);
    foreach($ltems as $ltem){
        
    if ($ltem%3==0 && $ltem%5==0){
      echo "FizzBuzz<br>";
      
      }elseif($ltem%3==0){
        echo "Fizz<br>";
    
    } elseif($ltem%5 == 0){
        echo  "Buzz<br>";
    }else{
        echo "３と５ではない<br>";
    }
  }
?>