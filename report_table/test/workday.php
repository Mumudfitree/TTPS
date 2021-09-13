<?php
    include_once('./../src/date.php');

    for($i = 1; $i <= 31; $i++){
    $dayInfo = getDayOfWeek();
    $monthCount = returnDayCount($dayInfo);
    echo $i.': '.isWorkDay($i, $dayInfo).'<br>';
    }
?>