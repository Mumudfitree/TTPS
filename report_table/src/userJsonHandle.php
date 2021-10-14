<?php

    function randomScope(int $leastPossible, int $mostPossible): int{
        $range = $mostPossible - $leastPossible;

        $value = rand()%$range + $leastPossible + 1;

        return $value;
    }

?>