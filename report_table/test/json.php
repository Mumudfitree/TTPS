<?php

    $time = getdate();

    $firstData = [
        "year" => $time["year"],
        "month" => $time["mon"],
        "day" => $time["mday"],
        "date" => $time["wday"]
    ];

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

    return 0;
    
?>