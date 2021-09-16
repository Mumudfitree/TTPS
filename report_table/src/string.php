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

    function fetchTimeString ($string){

        $array = array(-1);

        for($i=0; $i<strlen($string); $i++){
            $array = array_merge( $array, array(
                'hour' => $string[0].$string[1],
                'minute' => $string[3].$string[4]
            ));
            $array = array_merge( $array, array(
                'hour' => $string[8].$string[9],
                'minute' => $string[11].$string[12]
            ));
        }

    }

?>