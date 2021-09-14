<html>
    <body>
        <link rel="stylesheet" href="./css/style.css"></link>

        <table>
            <tr>

<?php

    include_once './../src/date.php';

for($i=0; $i<9; $i++){

        tableBlockPainter($i);
    }
    
?>
            </tr>
        </table>
    </body>
</html>
