<?php

    function getDayOfWeek(){

        $dayOfMonth = date('j');

        $monthOfDay = date('n');
        $yearOfDay = date('Y');

        $dayOfWeek = date('w');

        $valueReturn = [
            'dayOfMonth' => $dayOfMonth,
            'monthOfDay' => $monthOfDay,
            'yearOfDay' => $yearOfDay,
            'dayOfWeek' => $dayOfWeek
        ];

        return $valueReturn;
    }

    function createDayOfWeek($dateOfMonth, $monthOfDay, $yearOfDay){

        if(!checkdate($monthOfDay, $dateOfMonth, $yearOfDay)){

            return -1;
        }

        $unix = getUnixTimeOfDay($dateOfMonth, $monthOfDay, $yearOfDay);

        $dayOfWeek = date('w', $unix);

        $valueReturn = [
            'dayOfMonth' => $dateOfMonth,
            'monthOfDay' => $monthOfDay,
            'yearOfDay' => $yearOfDay,
            'dayOfWeek' => $dayOfWeek
        ];

        return $valueReturn;

    }

    function getDayFromUnix($unixTime){

            $dayOfMonth = date('j', $unixTime);
    
            $monthOfDay = date('n', $unixTime);
            $yearOfDay = date('Y', $unixTime);
    
            $dayOfWeek = date('w', $unixTime);
    
            $valueReturn = [
                'dayOfMonth' => $dayOfMonth,
                'monthOfDay' => $monthOfDay,
                'yearOfDay' => $yearOfDay,
                'dayOfWeek' => $dayOfWeek
            ];

            return $valueReturn;
    }

    function getUnixTimeOfDay($date, $month, $year) //get time of day at 12 pm
    {
        $unixTime = gmmktime(0, 0, 0, $month, $date, $year);

        return $unixTime;
    }

    function returnDayCount($arrayData){
        $month = $arrayData['monthOfDay'];
        $year = $arrayData['yearOfDay'];

        switch($month){
            case 1:
                return 31;
            case 2:
                if(isLeapYear($year)){
                    return 29;
                }
                return 28;
            case 3:
                return 31;
            case 4:
                return 30;
            case 5:
                return 31;
            case 6:
                return 30;
            case 7:
                return 31;
            case 8:
                return 31;
            case 9:
                return 30;
            case 10:
                return 31;
            case 11:
                return 30;
            case 12:
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

        //Because first possible date is 1, but first possible day is 0, it need to reduce base inequality first.
        $date = $arrayData['dayOfMonth'] - 1; 
        $day = $arrayData['dayOfWeek'];

        $exceedDay = $date%7;

        if ($day >= $exceedDay){
            return $day - $exceedDay;
        }
        
        return 7 - abs($day - $exceedDay);
    }

    function dayGenerate($enumArray, $monthDay, $firstWeekDay){ //ทำการสร้างวันสำหรับทั้งเดือนนั้น คือ เก็บเป็น วันที่ 1 = 3, 2 = 4, ..., 5 = 0
        for($i = 0; $i < $monthDay; $i++, $firstWeekDay+=1){
            if($firstWeekDay === 7){
                $firstWeekDay = 0;
            }
            $enumArray[$i] = $firstWeekDay;

        }

        return $enumArray;

    }

    function isWorkDay($day){ //ตรวจสอบว่าคือวันหยุดหรือไม่
        //ในขั้นต้นให้เขียนแค่ตรวจสอบวันเสาร์กับวันอาทิตย์ก่อน วันอาทิตย์คือ 0 ส่วนวันเสาร์คือ 6
        //คืนค่าเป็น 1 เมื่อเป็นวันทำงาน และ 0 เมื่อเป็นวันหยุด
        //$date คือส่งวันที่มา ส่วน $arrayData ส่งข้อมูลเกี่ยวกับวันนี้ ประกาศไว้ใน getDayOfWeek()

        //code here...

        $exceptArray = array(0, 6);
        foreach($exceptArray as $loop){
            if ($loop === $day) return 1;
            if ($loop > $day) return 0;
        }
    }

    /*function checkPainterSpecialCase($day){
        $exceptArray = array(6);
        foreach ($exceptArray as $loop){
            if($day === $loop){
                return 1;
            }
            return 0;
        }
    }*/

    function tableBlockPainter($day){ //ส่งลักษณะของสีพื้นหลังช่องตารางตามที่กำหนดไว้
        //เบื้องต้นให้พิมพ์สีออกมาเฉพาะวันศุกร์ เป็นสีเขียว
        //เป็นไปได้ ให้ทำการใช้ color picker ดูดสีออกมาจากภาพ เพื่อให้สีตรงที่สุด
        //หรือแล้วแต่ ถ้าคิดว่ามีสีอื่นที่สวยกว่านั้น ก็ใช้อันนั้นได้
        //ให้ทำการ echo ออกมาเลย ไม่ต้องคืนคาอะไรกลับไป
        //$day คือส่งวันมา เป็นตัวเลข 0 - 6 0 คือวันอาทิตย์ 6 คือวันเสาร์

        //code here...

        switch($day){
            case 6: {
                    echo ' style="background-color:green;"'; break;
                    }

            case 0: echo '<tr'; break;
            case 8: echo '</tr'; break;
            case 9: echo '</div'; break;
            case 10: echo '<td'; return 0;
            case 11: echo '</td'; break;

            default: break;
        }

            echo '>';

            return 0;

        //echo '
            //text-align:center;">

             //';



        //สิ่งที่ต้องทำต่อไปสำหรับฟังก์ชั่นนี้ ตรงนี้ยังไม่จำเป็นต้องทำ
        //ลงสีคนขาด 0
        //ลงสีคนลา ล
        //ลงสีคนลาป่วย ป
        //ลงสีคนมาทำงานครึ่งวัน 0.5
    }

    function tableBlockPrint($data){
        echo $data;
    }

    function tableDayPrint($day){
        switch($day){
            case 1: echo 'Sunday'; return 0;
            case 2: echo 'Monday'; return 0;
            case 3: echo 'Tuesday'; return 0;
            case 4: echo 'Wednesday'; return 0;
            case 5: echo 'Thrusday'; return 0;
            case 6: echo 'Friday'; return 0;
            case 7: echo 'Saturday'; return 0;
        }
    }

    function enumGenerator($enumSize){ //enum have to start at 0.
        for($i=0; $i<$enumSize; $i++){
            $enumArray[$i] = -1;
        }

        return $enumArray;
    }

?>