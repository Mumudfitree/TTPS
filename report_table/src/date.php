<?php

    function getDayOfWeek(){

        $dayOfMonth = date('d');

        $monthOfDay = date('F');
        $yearOfDay = date('Y');

        $dayOfWeek = date('l');

        $valueReturn = [
            'dayOfMonth' => $dayOfMonth,
            'monthOfDay' => $monthOfDay,
            'yearOfDay' => $yearOfDay,
            'dayOfWeek' => $dayOfWeek
        ];

        return $valueReturn;
    }

    function returnDayCount($arrayData){
        $month = $arrayData['monthOfDay'];
        $year = $arrayData['yearOfDay'];

        switch($month){
            case 'January':
                return 31;
            case 'February':
                if(isLeapYear($year)){
                    return 29;
                }
                return 28;
            case 'March':
                return 31;
            case 'April':
                return 30;
            case 'May':
                return 31;
            case 'June':
                return 30;
            case 'July':
                return 31;
            case 'August':
                return 31;
            case 'September':
                return 30;
            case 'October':
                return 31;
            case 'November':
                return 30;
            case 'December':
                return 31;
            default:
                return 'invalid';
        }

    }

    function isLeapYear($yearData){

        if($yearData%400 === 0){
            return 1;
        }

        if($yearData%100 === 0){
            return 0;
        }

        if($yearData%4 === 0){
            return 1;
        }

        return 0;
    }

    function findFirstDayOfMonth($arrayData){

        $date = $arrayData['dayOfMonth'];
        $day = $arrayData['dayOfWeek'];

        if($arrayData['dayOfMonth'] <= 15){

        }
        

    }

    function dayGenarate(){

    }

    function IsWorkDay(){

    }

    function tableBlockPainter(){
        
    }

    function enumGenerator($enumSize){
        for($i=0; $i<$enumSize; $i++){
            $enumArray[$i] = -1;
        }

        return $enumArray;
    }

?>