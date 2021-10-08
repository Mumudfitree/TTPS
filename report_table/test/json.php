<?php

    $time = getdate();

    foreach($time as $timeData){
        $timeData = strval($timeData);
    }

    if(!isset($time['mon'][1])){
        $time['mon'][1] = $time['mon'][0];
        $time['mon'][0] = '0';
    }

    if(!isset($time['mday'][1])){
        $time['mday'][1] = $time['mday'][0];
        $time['mday'][0] = '0';
    }

    $firstData = sprintf("%s%s%s%s", $time['year'], $time['mon'], $time['mday'], $time['wday']);

    $times = rand()%10 + 1;

    $secondData = array();

    for($i = 0; $i < $times; $i++){

        $hour = rand()%24;
        $minute = rand()%60;

        $timeString = array();

        array_push($timeString, $hour, $minute);

        array_push($secondData, $timeString);

        $string = sprintf("%s%s", $hour, $minute);

    }

    $ndJson = json_encode($secondData);

    $data = [
        $firstData => $secondData
    ];

    $json = json_encode($data);

    return 0;
    
?>