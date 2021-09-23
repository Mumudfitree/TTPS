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

    function pageReturn(){
        echo (
            '
            <script>
                window.history.back();
            </script>
            '
        );
    }
?>