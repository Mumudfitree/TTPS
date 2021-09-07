<?php

    session_start();

    echo $_COOKIE['lineMessage'].'<br>';

    include_once './../src/script_admin.php';
    include_once './../../notification/message.php';
    //include_once './../../notification/line_notify.php';

    $queryData = getToken();

        //if (isset($queryData['token']) or $queryData['token'] === NULL or $queryData['token'] === '\0')
        //it is not correct, because getToken() return as string. (Only $row['token'], not $row)
        
        if (isset($queryData) or $queryData === NULL or $queryData === '\0')
            { //จะต้องกดปุ่มใหม่ ถ้ายังไม่ลงทะเบียน ยังต้องแก้ให้สามารถดึงมาต่อจุดเดิมได้

                //header('locaton: /notification/line_notify.php');

                header('location: ./../../notification/line_notify.php');
            }
?>