<?php

    function returnUserWork(){
        
    }

    function addUserWork(){
        $sql = "SELECT * FROM choose_a_teaching WHERE login_id = ".$_SESSION['master_id']."; ";
        $query = mysqli_query($GLOBALS['conn'], $sql);

        $time = getTimeTableFromDatabase();

        while($row = mysqli_fetch_array($query)){

            
            
        }
    }

?>