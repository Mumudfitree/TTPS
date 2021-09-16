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
        if(!isset($_COOKIE[$cookieName]) || $_COOKIE[$cookieName] === NULL || $_COOKIE[$cookieName] === '\0' || $_COOKIE[$cookieName] === '' || $_COOKIE[$cookieName] === '-1' || $_COOKIE[$cookieName] === -1) return NULL;
        return $_COOKIE[$cookieName];
    }
?>