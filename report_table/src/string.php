<?php

    function findOccurancePos ($string, $specificChar){

        $occurance = array(-1);

        for($i=0, $counter=0; $i<strlen($string); $i++){
            if ($string[$i] === $specificChar){
                $occurance[$counter] = $i;
                $counter += 1;
            }
        }

        return $occurance;

    }

    function fetchTimeString ($array){

        $i = 0;

        $returnArray[0] = array(
            'hour' => intval($array[$i][0].$array[$i][1]),
            'minute' => intval($array[$i][3].$array[$i][4])
        );

        $returnArray[1] = array(
            'hour' => intval($array[$i][8].$array[$i][9]),
            'minute' => intval($array[$i][11].$array[$i][12])
        );

        for($i=1; isset($array[$i]); $i++){
            $returnArray[$i*2] = array(
                'hour' => intval($array[$i][0].$array[$i][1]),
                'minute' => intval($array[$i][3].$array[$i][4])
            );
            $returnArray[$i*2+1] = array(
                'hour' => intval($array[$i][8].$array[$i][9]),
                'minute' => intval($array[$i][11].$array[$i][12])
            );
        }

        return $returnArray;
    }

?>