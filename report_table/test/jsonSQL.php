<?php

    session_start();
    include_once "./../../connection.php";

    $sql = "SELECT * FROM work_history ";
    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
    $row = mysqli_fetch_array($result);

    $data = [
        'year' => 2021,
        'month' => 9,
        'date' => 17
    ];

    $json = json_encode($data);

    $sql = "INSERT INTO work_history VALUES (".$_SESSION['master_id'].", '".$json."');";
    $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error());
    $row = mysqli_fetch_array($result);
?>