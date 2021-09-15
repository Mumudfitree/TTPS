<html>
    <body>
        <link rel="stylesheet" href="./css/style.css"></link>

        <table>
            <tr>

<?php

    include_once './../src/date.php';

    tableBlockPainter(0);

for($i=1; $i<8; $i++){

        /*if (!checkPainterSpecialCase($i)) */ tableBlockPainter(10);
        tableBlockPainter($i);
        while($i === 6){
            tableBlockPrint('<div class="blueText">');
            tableDayPrint($i);
            tableBlockPainter(9);
            $i += 1;
            $_SESSION['isLoop'] = 1;
        }

        if(!isset($_SESSION['isLoop'])){
            tableDayPrint($i);
        }

        if(isset($_SESSION['isLoop'])){
            $i -= 1;
            unset($_SESSION['isLoop']);
        }

        tableBlockPainter(11);

    }

    tableBlockPainter(8);
    
?>
            </tr>
        </table>
    </body>
</html>
