<?php

    function returnUserWork(){
        
    }

    function addUserWork(){
        $sql = "SELECT * FROM choose_a_teaching WHERE login_id = ".$_SESSION['master_id']."; ";
        $query = mysqli_query($GLOBALS['conn'], $sql);

        $day = getDayOfWeek();

        if(!isWorkDay($day)) return 0;

        $upTime = upTime();


        $index = convertToDatabaseForm($upTime);
        if($index = -1) return 0;

            while($row = mysqli_fetch_array($query)){
                if(($row['time_id'] - 1) === $index) {
                    updateSQLjdoc($day, $index);

                    return 0;
                }
        }

        return 1;
        
    }

    function updateSQLjdoc($dayArray, $index){

        
        $sql = "SELECT * FROM work_history WHERE user_id = ".$_SESSION['master_id']."; ";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
        $row = mysqli_fetch_array($result);

            if(isset($row['work_history'])){

            $json_read = $row['work_history'];

            $json_read = json_decode($json_read);

            if ($json_read[1])

            $json_write = [
                [
                "year" => $dayArray['yearOfDay'],
                "month" => $dayArray['monthOfDay'],
                "date" => $dayArray['dayOfMonth']
                ]
            ];


            $section = [
                0
            ];

            $json_write = array_merge($json_write, $section);

            $json = json_encode($json_write);
        }
    }

    function dataGenerater(){

        $possibility = array('1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '1', '1', '1', '1', '1', '1', '1', '1', '1', '1',
                             '0.5', '0.5', '0.5', '0.7', '0.7', '0.3', '11', '0', '0',
                             'ล', 'ล', 'ล', 'ป', 'ป');

        $arraySize = count($possibility);
        $rand = rand()%$arraySize;

        return $possibility[$rand];
    }

?>