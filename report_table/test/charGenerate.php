<?php

    include_once "../src/userJsonHandle.php";

    for($i=0; $i<=1; $i++){

        for($j=1; $j<=3; $j++){

            for($k=0; $k<53; $k++){

                if(!$i && $k === 26){
                    continue;
                }

                if($j != 3 && $k >= 27){
                    break;
                }

                $mode = strval($i).strval($j);

                $value = charGenerate($mode, 1, $k);

                printf("%s char '%d': %s<br>", $mode, $k, $value);


            }

        }

    }

?>