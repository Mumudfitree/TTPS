<?php

    include_once './../src/script_admin.php';
    include_once './../src/script_main.php';

?>

<html>
    <body>
        <script src="./../src/script_admin.js"></script>
        <button class="btn btn-danger" onclick="getDataPrompt();">

<?php

    echo $_COOKIE['lineMessage'];

?>

        </button>
    </body>
</html>