<?php
    include_once('./../src/date.php');

    $i=1;
    $dayInfo = getDayOfWeek();
    $monthCount = returnDayCount($dayInfo);
    echo isWorkDay($i, $dayInfo);
?>