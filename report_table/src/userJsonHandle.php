<?php

    /* function randomScope(int $leastPossible, int $mostPossible): int{
        $range = $mostPossible - $leastPossible;

        $value = rand()%$range + $leastPossible + 1;

        return $value;
    } */

    function randomScope(int $leastPossible, int $mostPossible): int{
        
        $value = -1;

        while(TRUE){
            $value = (rand() % $mostPossible) + 1;

            if($value >= $leastPossible){
                break;
            }
        }

        return $value;
    }

?>