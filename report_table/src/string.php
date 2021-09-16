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
            'hour' => $array[$i][0].$array[$i][1],
            'minute' => $array[$i][3].$array[$i][4]
        );

        $returnArray = array_merge( $returnArray, array(
            'hour' => $array[$i][8].$array[$i][9],
            'minute' => $array[$i][11].$array[$i][12]
        ));

        for($i=1; isset($array[$i]); $i++){
            $returnArray = array_merge( $returnArray, array(
                'hour' => $array[$i][0].$array[$i][1],
                'minute' => $array[$i][3].$array[$i][4]
            ));
            $returnArray = array_merge( $returnArray, array(
                'hour' => $array[$i][8].$array[$i][9],
                'minute' => $array[$i][11].$array[$i][12]
            ));
        }

    }

?>