<?php

    require_once ($_SERVER['DOCUMENT_ROOT']."/TTPS.wsl/notification/message.php");
    require_once '../connection.php';
    $token = getToken();

    echo $token.'<br>';
    echo gettype($token);
?>