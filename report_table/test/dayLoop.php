<?php

    include_once './../src/date.php';

    define('secondOfDay', 86400);
    define('normal12Years', 4383);

    $unixTime = getUnixTimeOfDay(1, 1, rand(2001, 3000));

    $dayArray = getDayFromUnix($unixTime);

    $pass = 0;

    $enum_month = enumGenerator(31); //I forgot to called enum, and I specifieddayGenerate wrong array.

    for($i = 1; $i <= normal12Years; $i++){
        $isValid = checkdate($dayArray['monthOfDay'], $dayArray['dayOfMonth'], $dayArray['yearOfDay']);

        if(!$isValid){
            echo 'Failed, day isn\'t valid<br>';
            break;
        }

        if(!isset($_SESSION['monthLoop'])){
            $weekDay = findFirstDayOfMonth($dayArray);
            $yearCode = 12;
            $monthCode = returnDayCount($dayArray);

            $_SESSION['monthLoop'] = $dayArray['monthOfDay'];

            $_SESSION['dayLoop'] = $dayArray['dayOfMonth'];
            $_SESSION['monthDay'] = returnDayCount($dayArray);
            $firstDayOfMonth = findFirstDayOfMonth($dayArray);
            $enum_month = dayGenerate($enum_month, $_SESSION['monthDay'], $firstDayOfMonth);
            $_SESSION['firstLoop'] = 1;
            //here enum that produce is start at 0, not 1.

        }

        if(($_SESSION['monthLoop'] === $yearCode) || isset($_SESSION['firstLoop']) ){ //here, monthloop and monthcode are different format. You should change that first.
            $weekDay = findFirstDayOfMonth($dayArray);

            $monthCode = returnDayCount($dayArray);

            $_SESSION['monthLoop'] += 1;

        }

        if($_SESSION['monthLoop'] === $yearCode){
            $_SESSION['monthLoop'] = 1;
        }

        $bool[0] = ($_SESSION['monthLoop'] < $yearCode);
        $bool[1] = isset($_SESSION['firstLoop']);
        $bool[2] = $_SESSION['dayLoop'] >= $_SESSION['monthDay'];
        $bool[3] = isset($_SESSION['firstLoop']);
        $bool[4] = $bool[0] or $bool[1];
        $bool[5] = $bool[0] and $bool[1];
        $bool[6] = $bool[2] or $bool[3];
        $bool[7] = $bool[2] and $bool[3];
        $bool[8] = $bool[0] || $bool[1];
        $bool[9] = $bool[2] || $bool[3];

        $bool[10] = TRUE or FALSE;

        $_bool = $_SESSION['monthLoop'] < $yearCode or isset($_SESSION['firstLoop']);
        $boolean = $_SESSION['dayLoop'] >= $_SESSION['monthDay'] or isset($_SESSION['firstLoop']);

        if(($_SESSION['dayLoop'] === $_SESSION['monthDay']) || isset($_SESSION['firstLoop'])){ //codes from previous check still can get in here.
            //codes broken because I mistype.
            
            $_SESSION['dayLoop'] = 1;
            $_SESSION['monthDay'] = returnDayCount($dayArray);
            $firstDayOfMonth = findFirstDayOfMonth($dayArray);
            $enum_month = dayGenerate($enum_month, $_SESSION['monthDay'], $firstDayOfMonth);
        }
        
        else{ //when it first init. It still get in here. (I forgot it use if-else. So It will go here.)
            $_SESSION['dayLoop'] += 1;
        }

        unset($_SESSION['firstLoop']);

        $correctResult = intval(date('w', $unixTime));
        
        if($correctResult === $enum_month[$_SESSION['dayLoop'] - 1]){ //Because enum start at 0, and $_SESSION['dayloop'] start at 1. So I have to reduce base to give it equal.
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

    unset($_SESSION['monthLoop']);
    unset($_SESSION['dayLoop']);
    unset($_SESSION['MonthDay']);
    unset($_SESSION['firstLoop']);

?>