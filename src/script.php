<?php

    function alertBox(string $message){

        echo (
            '
            <script>
                alert("'.$message.'");
            </script>
            '
        );

        return 0;

    }
?>