<?php

    function landingBlock()
    {
        echo ('

            <div class="alert alert-success">
                <h3>
                    '.$_SESSION['success'].'
                </h3>
            </div>

            ');

        unset($_SESSION['success']);
    }

    function getCookie($cookieName){ //It probably won't be used, because it can set directly
        return $_COOKIE[$cookieName];
    }
?>