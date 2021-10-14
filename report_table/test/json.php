<?php

    $time = getdate();

    $name = array("Imron");

    $times = rand()%100;

    for($i = 0; $i < $times; $i++){

        $nameGen = array();

        $strlen = rand()%100;

        for($index = 0; $index < $strlen; $index++){

            if($index === 0){
                $char = (rand()%26) + 65;

            }

            else {
                $char = (rand()%26) + 97;
            }

            $nameGen[$index] = $char;

            
            $nameGenJs = json_encode($nameGen);
            printf("%s\n", $nameGenJs);
            
        }
        
        array_push($name, $nameGen);
        $nameJs = json_encode($name);
        printf("%s\n", $nameJs);

    }

    $jsonStream = array();

    foreach($time as $arrayName=>$timeData){
        $time[$arrayName] = strval($timeData);
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

        $hour = strval(rand()%24);
        $minute = strval(rand()%60);

        $timeString = array();

        if(!isset($hour[1])){
            $hour = "0".$hour[0];

        }

        if(!isset($minute[1])){
            $minute = "0".$minute[0];

        }

        $timeString = $hour.$minute;

        array_push($secondData, $timeString);

        $string = sprintf("%s%s", $hour, $minute);

    }

    $ndJson = json_encode($secondData);

    $data = [
        $firstData => $secondData
    ];

    $userData = [
        $name => $data
    ];

    array_push($jsonStream, $userData);

    $json = json_encode($data);

    echo $json;

    return 0;
    
?>