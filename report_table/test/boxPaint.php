<html>
    <body>
        <link rel="stylesheet" href="./css/style.css"></link>

        <table>
            <tr>

<?php

    include_once './../src/date.php';

    tableBlockPainter(0);

for($i=1; $i<8; $i++){

        if (!checkPainterSpecialCase($i)) tableBlockPainter(10);
        tableBlockPainter($i);
        tableDayPrint($i);
        tableBlockPainter(11);

    }

    tableBlockPainter(8);
    
?>
            </tr>
        </table>
    </body>
</html>
