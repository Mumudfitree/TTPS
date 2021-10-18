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

    function charGenerate($mode, ?int $isEnabledDebugging, ?int $charSequence){ //mode: 2 letter (start with 1), enable spacebar;
                                  //      end letter: 1- only UPPERCASE 2- only lowercase 3- mixed

        //$type = gettype($mode);
        
        switch(gettype($mode)[0]){
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

        $first = -1;
        $last = -1;

        switch($generateMode){
            case '1':
                $first = 65;
                break;
            case '2':
                $first = 97;
                break;
            case '3':
                $first = 0;
                $last = ($first - 1) + $charPool + 26;
                break;

            default:
                return 1;
        }

        if($generateMode != '3'){
            $last = ($first - 1) + $charPool;
        }

        if ($isEnabledDebugging){
            $value = $first + $charSequence;
        }

        else{
                $value = randomScope($first, $last);
        }

        if($value === 91 || $value === 123 || $value === 52){
            return chr(32);
        }

        if($value < 26){
            return chr($value+65);
        }
        if($value < 52){
            return chr(($value+97)-26);  //I have to reduce 26, because first that come in this condition, $value will be 26. And 26+97 = 123 which isn't right.
        }

        return chr($value);
        

    }

    function nameGenerate(int $numberOfName, ?int $nameLength){

        if(!isset($nameLength)){
            $nameLength = 20;
        }


    }

?>