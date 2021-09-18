<?php

    include_once './../src/date.php';

    define('secondOfDay', 86400);
    define('normal12Years', 4383);

    $unixTime = getUnixTimeOfDay(1, 1, rand(2001, 3000));

    $dayArray = getDayFromUnix($unixTime);

    $pass = 0;

    for($i = 0; $i < normal12Years; $i++){
        $isPass = checkdate($dayArray['monthOfDay'], $dayArray['dayOfMonth'], $dayArray['yearOfDay']);
        $unixTime += secondOfDay;
        $dayArray = getDayFromUnix($unixTime);

        if($isPass){
            $pass += 1;
            echo ($i+1).': passed<br>';
        }
        else{
            echo ($i+1).': failed<br>';
        }

        $isPass = 0;

    }

    if($pass === normal12Years){
        echo 'all passed';
    }
    else{
        echo 'some didn\'t pass';
    }

?>