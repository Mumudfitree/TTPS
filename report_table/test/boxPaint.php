<?php

    include_once './../src/date.php';

for($i=0; $i<9; $i++){

        switch($i){
            case 1: echo '<td>Sunday</td>'; break;
            case 2: echo '<td>Monday</td>'; break;
            case 3: echo '<td>Tuesday</td>'; break;
            case 4: echo '<td>Wednesday</td>'; break;
            case 5: echo '<td>Thrusday</td>'; break;
            case 6: echo '<td style="backgroud-color:green;color:purple;">Friday</td>'; break;
            case 7: echo '<td>Saturday</td>'; break;

            case 0: echo '<tr>'; break;
            case 8: echo '</tr>'; break;
        }
    }
    
?>
