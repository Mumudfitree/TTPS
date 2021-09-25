<?php
    function getTimeTableFromDatabase (){

        $sql = "SELECT * FROM time; ";
        $query = mysqli_query($GLOBALS['conn'], $sql);

        $obj = [];

        while($row = mysqli_fetch_array($query)){

            $obj = array_merge($obj, array(
                $row['time_id'] => $row['time_name']
            ));

            
        }

        $objStr = fetchTimeString($obj);

        return $objStr;
 
    }

    function upTime(){
        $hour = intval(date('G'));

        $minute = intval(date('i'));
        $second = intval(date('s'));

        $unix = intval(date('U'));

        $valueReturn = [
            'hour' => intval($hour),
            'minute' => intval($minute),
            'second' => intval($second),
            'unix' => intval($unix)
        ];

        return $valueReturn;
    }

    function convertToDatabaseForm($upTime){

        $dbTime = getTimeTableFromDatabase();
        
        for($i = 0; isset($dbTime[$i]); $i++){// use += 2  //check as first case and last case
            
            if($i%2 === 0){
                if ( !(($upTime['hour'] + 1) >= $dbTime[$i]['hour']) ) continue;

                if( ($upTime['minute'] + 5) >= 60) {
                    $upTime['hour'] += 1;
                    $upTime['minute'] = $dbTime[$i]['minute'];
                }

                if( ($upTime['minute'] + 5) >= $dbTime[$i]['minute']) $upTime['minute'] = $dbTime[$i]['minute'];

                if($upTime['hour'] === $dbTime[$i]['hour'] && $upTime['minute'] === $dbTime[$i]['minute']) return $i;
            }

            return -1;

        }

    }
?>