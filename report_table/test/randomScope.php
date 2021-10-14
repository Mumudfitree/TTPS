<?php

    include_once "../src/userJsonHandle.php";

    $times = rand()%1000;

    $seed = (rand()%1000) + $times/(rand()%1000);
    
    for($i=0; $i<$times; $i++){

        if($times%111===0){

            srand($times+rand()%$times);

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }

        if($times%103===0){

            srand($times+rand()%$i);

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }
        if($times%97===0){

            srand($i+rand()%$times);

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }
        if($times%91===0){

            srand($i+rand()/($times-$i));

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }
        if($times%87===0){

            srand(($i*$times)%$i);

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }
        if($times%83===0){

            srand(($times/$i)%$i);

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }
        if($times%13===0){

            srand($i+$times-($times%$i));

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }
        if($times%7===0){

            srand($times/$i);

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }
        if($times%5===0){

            srand(($i-1)*$times);

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }
        if($times%3===0){

            srand(pow(-1, $i)+pow(-1, $times));

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }
        if($times%2===0){

            srand(pow(-1, $i)*pow(-1, $times));

            $rand1 = rand()%1000;
            $rand2 = rand()%$rand1;

            $value = randomScope($rand2, $rand1);
            echo $value."<br>";

            continue;
        }

        srand($i);

        $rand1 = rand()%1000;
        $rand2 = rand()%$rand1;

        $value = randomScope($rand2, $rand1);
        echo $value."<br>";

    }

?>