<?php

    include_once './src/date.php';

    for($i=0; $i<=4000; $i++){

        $answer = isLeapYear($i);

        echo "$i: ";

        if($answer === 1){
            echo 'yes<br>';
            continue;
        }

        echo 'no<br>';
    }

?>