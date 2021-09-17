<?php

    include_once "./../../connection.php";
    include_once "./../src/time.php";
    include_once "./../src/string.php";

    date_default_timezone_set('Asia/Bangkok');

    $time = upTime();

    $dbTime = getTimeTableFromDatabase();

    for($i = 0; isset($dbTime[$i]); $i++){// use += 2  //check as first case and last case

        echo $dbTime[$i]['hour'].':'.$dbTime[$i]['minute'];
            
        if($i%2 === 0){
            if ( !(($time['hour'] + 1) >= $dbTime[$i]['hour']) ) {
                echo '  : not<br>'; 
                continue;}

            if( ($time['minute'] + 5) >= 60) {
                $time['hour'] += 1;
                $time['minute'] = $dbTime[$i]['minute'];
            }

            if( ($time['minute'] + 5) >= $dbTime[$i]['minute']) {
                $time['minute'] = $dbTime[$i]['minute'];
            }

            if($time['hour'] === $dbTime[$i]['hour'] && $time['minute'] === $dbTime[$i]['minute']) {
                echo '  : time<br>';
            }
            else {
                echo "  : not<br>";
            }
        }

        if($i%2 === 1){
            if ( ($time['hour'] + 1) > $dbTime[$i]['hour'] ) {
                echo '    : not<br>'; 
                continue;
            }
            if ( ($time['minute']) > $dbTime[$i]['minute'] ) {
                echo ': not<br>'; 
                continue;}

            if( ($time['hour'] - $dbTime[$i]['hour']) <= 0 && ( $time['hour'] - $dbTime[$i]['hour'] ) >= -1 && ( ($time['minute'] - $dbTime[$i]['minute']) <= 1 ) && ( ($time['minute'] - $dbTime[$i]['minute']) >= -1 ) )  {
                echo "  : time<br>";
            }
            else {
                echo "  : not<br>";
            }
        }
    }
?>