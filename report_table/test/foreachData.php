<?php

    include_once './../src/time.php';
    include_once './../src/string.php';
    include_once './../../connection.php';

    $sql = "SELECT * FROM time; ";
    $query = mysqli_query($GLOBALS['conn'], $sql);
    $row = mysqli_fetch_array($query);

    getTimeFromDatabase();

    //foreach ($row as $data)

?>