<?php

    require_once ($_SERVER['DOCUMENT_ROOT']."/TTPS.wsl/notification/message.php");
    $token = getToken();

    echo $token.'<br>';
    echo gettype($token);
?>