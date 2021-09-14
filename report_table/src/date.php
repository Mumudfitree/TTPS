<?php

    function getDayOfWeek(){

        $dayOfMonth = date('d');

        $monthOfDay = date('F');
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

        $exceedDay = $date%7;

        if ($day >= $exceedDay){
            return $day - $exceedDay;
        }
        
        return 6 + $day - $exceedDay;
    }

    function dayGenarate(){ //ทำการสร้างวันสำหรับทั้งเดือนนั้น คือ เก็บเป็น วันที่ 1 = 3, 2 = 4, ..., 5 = 0
        //อันนี้ไม่ต้องทำ
    }

    function isWorkDay($date, $arrayData){ //ตรวจสอบว่าคือวันหยุดหรือไม่
        //ในขั้นต้นให้เขียนแค่ตรวจสอบวันเสาร์กับวันอาทิตย์ก่อน วันอาทิตย์คือ 0 ส่วนวันเสาร์คือ 6
        //คืนค่าเป็น 1 เมื่อเป็นวันทำงาน และ 0 เมื่อเป็นวันหยุด
        //$date คือส่งวันที่มา ส่วน $arrayData ส่งข้อมูลเกี่ยวกับวันนี้ ประกาศไว้ใน getDayOfWeek()

        //code here...

        if($date === 0)
        {
            return 0;
        }
        return 1;
    }

    function tableBlockPainter($day){ //ส่งลักษณะของสีพื้นหลังช่องตารางตามที่กำหนดไว้
        //เบื้องต้นให้พิมพ์สีออกมาเฉพาะวันศุกร์ เป็นสีเขียว
        //เป็นไปได้ ให้ทำการใช้ color picker ดูดสีออกมาจากภาพ เพื่อให้สีตรงที่สุด
        //หรือแล้วแต่ ถ้าคิดว่ามีสีอื่นที่สวยกว่านั้น ก็ใช้อันนั้นได้
        //ให้ทำการ echo ออกมาเลย ไม่ต้องคืนคาอะไรกลับไป
        //$day คือส่งวันมา เป็นตัวเลข 0 - 6 0 คือวันอาทิตย์ 6 คือวันเสาร์

        //code here...

        switch($day){
            case 1: echo '<td>Sunday</td>'; return 0;
            case 2: echo '<td>Monday</td>'; return 0;
            case 3: echo '<td>Tuesday</td>'; return 0;
            case 4: echo '<td>Wednesday</td>'; return 0;
            case 5: echo '<td>Thrusday</td>'; return 0;
            case 6: echo '<td style="backgroud-color:green;color:purple;">Friday</td>'; return 0;
            case 7: echo '<td>Saturday</td>'; return 0;

            case 0: echo '<tr>'; return 0;
            case 8: echo '</tr>'; return 0;
        }

        //echo '
            //text-align:center;">

             //';



        //สิ่งที่ต้องทำต่อไปสำหรับฟังก์ชั่นนี้ ตรงนี้ยังไม่จำเป็นต้องทำ
        //ลงสีคนขาด 0
        //ลงสีคนลา ล
        //ลงสีคนลาป่วย ป
        //ลงสีคนมาทำงานครึ่งวัน 0.5
    }

    function enumGenerator($enumSize){
        for($i=1; $i<=$enumSize; $i++){
            $enumArray[$i] = -1;
        }

        return $enumArray;
    }

?>