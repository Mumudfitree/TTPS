<?php

    /* function randomScope(int $leastPossible, int $mostPossible): int{
        $range = $mostPossible - $leastPossible;

        $value = rand()%$range + $leastPossible + 1;

        return $value;
    } */

    function randomScope(int $leastPossible, int $mostPossible): int{
        
        $value = -1;

        while($value < $leastPossible || $value > $mostPossible){
            $value = rand()% $mostPossible;
        }

        return $value;
    }

?>