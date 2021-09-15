<?php

    include_once './../src/date.php';

    define('secondOfDay', 86400);
    define('normal12Years', 4383);

    $unixTime = getUnixTimeOfDay(1, 1, rand(2001, 3000));

    $dayArray = getDayFromUnix($unixTime);

    $pass = 0;

    for($i = 1; $i <= normal12Years; $i++){
        $isValid = checkdate($dayArray['monthOfDay'], $dayArray['dayOfMonth'], $dayArray['yearOfDay']);

        if(!$isValid){
            echo 'Failed, day isn\'t valid<br>';
            break;
        }

        $weekDay = findFirstDayOfMonth($dayArray);

        $monthCode = $dayArray['yearOfDay'].$dayArray['monthOfDay'];

        if(!isset($_SESSION['monthLoop'])){
            $_SESSION['monthLoop'] = $monthCode;
        }

        if($_SESSION['monthLoop'] < $monthCode){
            $_SESSION['monthLoop'] += 1;
        }

        if($_SESSION['monthLoop'] === 13){
            $_SESSION['monthLoop'] = 1;
        }

        if(!isset($_SESSION['dayLoop'])){
            $_SESSION['dayLoop'] = $dayArray['dayOfMonth'];
            $_SESSION['monthDay'] = returnDayCount($dayArray);
            $firstDayOfMonth = findFirstDayOfMonth($dayArray);
            $enum_month = dayGenerate($dayArray, $_SESSION['monthDay'], $firstDayOfMonth);
        }

        $correctResult = date('w', $unixTime);
        
        if($correctResult === $enum_month[$_SESSION['dayLoop']]){
            $isPassed = 1;

        }

        else{
            $isPassed = 0;
        }

        $unixTime += secondOfDay;
        $dayArray = getDayFromUnix($unixTime);

        if($isPassed){
            $pass += 1;
            echo ($i).': passed<br>';
        }
        else{
            echo ($i).': failed<br>';
        }

        $isPass = 0;

        if($_SESSION['dayLoop'] > $_SESSION['monthDay']){
            $_SESSION['dayLoop'] = 1;
            $_SESSION['monthDay'] = returnDayCount($dayArray);
            $enum_month = dayGenerate($dayArray, $_SESSION['monthDay'], $firstDayOfMonth);
        }
        
        else{
            $_SESSION['dayLoop'] += 1;
        }

    }

    if($pass === normal12Years){
        echo 'all passed<br>';
    }
    else{
        echo 'some didn\'t pass<br>';
    }

?>