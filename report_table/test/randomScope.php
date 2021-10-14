<?php

    include_once "../src/userJsonHandle.php";

    $scope = 100;

    for($i=0; $i<$scope; $i++){
        $value =randomScope($i, $scope);
        echo $value."<br>";
    }

?>