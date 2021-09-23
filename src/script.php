<?php

    function alertBox(string $message){

        $command = 'alert("'.$message.'");';

        return $command;
    }

    function pageReturn(){

        $command = 'window.history.back();';

        return $command;
    }

    
    function jsCombine(array $command){
        
        $jsStatement[0] = '<script>';
        
        $i = 1;

        foreach($command as $statement){
            
            $jsStatement[$i] = $statement;
            $i++;
        }

        $jsStatement[$i] = '</script>';

        return $jsStatement;
        
    }

    function incorrectUserDataError(){

        $statement[0] = alertBox("ชื่อบัญชีผู้ใช้ รหัสผ่าน หรือ ระบุบทบาท ไม่ถูกต้อง");
        $statement[1] = pageReturn();

        $js = jsCombine($statement);

        return $js;

    }

?>