<?php
    function getTimeFromDatabase (){

        $sql = "SELECT * FROM time; ";
        $query = mysqli_query($GLOBALS['conn'], $sql);

        $obj = [];
        $objStr = [];

        while($row = mysqli_fetch_array($query)){

            $obj = array_merge($obj, array(
                $row['time_id'] => $row['time_name']
            ));

            
        }

        $objStr = fetchTimeString($obj);
        
 
    }
?>