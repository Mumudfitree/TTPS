<?php

    function alertBox(string $message){

        $command = 
            '
                alert("'.$message.'");
            '
        ;

        return $command;
    }

    function pageReturn(){

        $command = 
            '
                window.history.back();
            '
        ;

        return $command;
    }

    
    function jsCombine(array $command){
        
        echo '<script>';
        
        foreach($command as $statement){
            
            echo $statement;
        }

        echo '</script>';
        
    }

    function incorrectUserDataError(){

        $statement[0] = alertBox("ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง");
        $statement[1] = pageReturn();

        jsCombine($statement);

    }

?>