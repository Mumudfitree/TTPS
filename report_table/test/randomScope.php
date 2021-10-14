<?php

    include_once "../src/userJsonHandle.php";

    for($i=0; $i<1000; $i++){
        $value =randomScope($i, 1000);
        echo $value."<br>";
    }

?>