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

    function charGenerate($mode){ //mode: 2 letter (start with 1), enable spacebar;
                                  //      end letter: 1- only UPPERCASE 2- only lowercase 3- mixed

        switch(gettype($mode[0])){
            case 'i': //'i' from "integer"
                $mode = strval($mode);
                break;
            case 's': //'s' from "string"
                break;
            default:
                return 1;
        }

        $charPool = (isset($mode[1])) ? 27 : 26;
        $generateMode = (isset($mode[1])) ? $mode[1] : $mode[0];

        switch($generateMode){
            case '0':
                $value = randomScope(65, 90);
                break;
            case '1':
                $value = randomScope(97, 122);
                break;
        }
        

    }

    function nameGenerate(int $numberOfName, ?int $nameLength){

        if(!isset($nameLength)){
            $nameLength = 20;
        }


    }

?>