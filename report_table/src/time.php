<?php
    function getTimeFromDatabase (){

        $sql = "SELECT * FROM time; ";
        $query = mysqli_query($GLOBALS['conn'], $sql);

        $obj = [];
        $occ = [];
        $objStr = [];

        while($row = mysqli_fetch_array($query)){

            $obj = array_merge($obj, array(
                $row['time_id'] => $row['time_name']
            ));

            $occ = array_merge( $occ, array(
                $row['time_id'] => findOccurancePos($obj[$row['time_id']], ':')
            ));
            
        }

        $i = 0;
        $j = 0;

        foreach($occ as $timeSet){
            foreach($timeSet as $part){
                $objStr = array_merge( $objStr, array(
                    'hour' => substr($obj[$i], $occ[$i][$j], 2),
                    'minute' => substr($obj[$i], $occ[$i][$j]-2, 2)
                ));

                $j++;
            }

            $i++;
        }
 
    }
?>