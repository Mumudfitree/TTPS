<?php

    include_once "../src/userJsonHandle.php";

    $time = getdate();

    $name = array("Imron");

    $times = randomScope(1, 20);
    for($i = 0; $i < $times; $i++){

        $strlen = randomScope(1, 20);

        for($index = 0; $index < $strlen; $index++){

            if($index === 0){
                $char = chr(randomScope(65, 90));
                $nameGen = $char;

            }

            else if ($nameGen[$index-1] === ' '){
                $char = chr(randomScope(65, 90));
                $nameGen = $nameGen.$char;
            }
            else {
                $char = randomScope(97, 123);
                $char = ($char === 123) ? chr(32) : chr($char);
                $nameGen = $nameGen.$char;
            }
            
            $nameGenJs = json_encode($nameGen);
            
        }
        
        array_push($name, $nameGen);
        
    }
    
    $nameJs = json_encode($name);
    printf("%s<br>", $nameJs);

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

    $userData = array();
    $jsonStream = array();

    foreach($name as $value){

        $times = rand()%10 + 1;

        $secondData = array();

        while($times){

            $hour = strval(rand()%24);
            $minute = strval(rand()%60);

            if(!isset($hour[1])){
                $hour = "0".$hour[0];

            }

            if(!isset($minute[1])){
                $minute = "0".$minute[0];

            }

            $timeString = $hour.$minute;

            array_push($secondData, $timeString);

            --$times;

        }

        $ndJson = json_encode($secondData);

        $data = [
            $firstData => $secondData
        ];

        $userData = [
            $value => $data 
        ];

        array_push($jsonStream, $userData);

    }

    $json = json_encode($jsonStream);

    echo $json;

    return 0;
    
?>