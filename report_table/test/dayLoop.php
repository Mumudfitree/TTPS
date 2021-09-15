<?php

    include_once './../src/date.php';

    define('secondOfDay', 86400);
    define('normal12Years', 4383);

    $unixTime = getUnixTimeOfDay(1, 1, rand(2001, 3000));

    $dayArray = getDayFromUnix($unixTime);

    $pass = 0;

    $enum_month = enumGenerator(31); //I forgot to calles enum, and I specifieddayGenerate wrong array.

    for($i = 1; $i <= normal12Years; $i++){
        $isValid = checkdate($dayArray['monthOfDay'], $dayArray['dayOfMonth'], $dayArray['yearOfDay']);

        if(!$isValid){
            echo 'Failed, day isn\'t valid<br>';
            break;
        }

        

        if(!isset($_SESSION['monthLoop'])){
            $weekDay = findFirstDayOfMonth($dayArray);

            $monthCode = returnDayCount($dayArray);

            $_SESSION['monthLoop'] = $monthCode;
        }

        if($_SESSION['monthLoop'] < $monthCode){ //here, monthloop and monthcode are different format. You should change that first.
            $weekDay = findFirstDayOfMonth($dayArray);

            $monthCode = returnDayCount($dayArray);

            $_SESSION['monthLoop'] += 1;
        }

        if($_SESSION['monthLoop'] === 13){
            $_SESSION['monthLoop'] = 1;
        }

        if(!isset($_SESSION['dayLoop'])){
            $_SESSION['dayLoop'] = $dayArray['dayOfMonth'];
            $_SESSION['monthDay'] = returnDayCount($dayArray);
            $firstDayOfMonth = findFirstDayOfMonth($dayArray);
            $enum_month = dayGenerate($enum_month, $_SESSION['monthDay'], $firstDayOfMonth);
            $_SESSION['firstDayLoop'] = 1;
            //here enum that produce is start at 0, not 1.
        }

        if($_SESSION['dayLoop'] > $_SESSION['monthDay'] && !(isset($_SESSION['fisrtDayLoop']))){ //codes from previous check still can get in here.
            $_SESSION['dayLoop'] = 1;
            $_SESSION['monthDay'] = returnDayCount($dayArray);
            $enum_month = dayGenerate($enum_month, $_SESSION['monthDay'], $firstDayOfMonth);
        }
        
        else{
            $_SESSION['dayLoop'] += 1;
        }

        unset($_SESSION['firstDayLoop']);

        $correctResult = date('w', $unixTime);
        
        if($correctResult === $enum_month[$_SESSION['dayLoop'] - 1]){
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

    }

    if($pass === normal12Years){
        echo 'all passed<br>';
    }
    else{
        echo 'some didn\'t pass<br>';
    }

?>