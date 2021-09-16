<?php 
    session_start();

    if ($_SESSION['login_type'] != 1) {
        header("location: ../index.php");
    }

?>

<?php

    /*if(isset($_POST['lineMessageBox'])){
        echo '<script>console.log(" '.$_POST['lineMessageBox'].' ")</script>';
    }*/

    /*if(isset($_POST['lineMessageButton'])){  //test are pass
        echo '<script>console.log(" '.$_POST['lineMessageButton'].' ")</script>';
    }*/

    if(isset($_POST['lineMessageButton'])){

        $_SESSION['cookie'] = $_COOKIE['lineMessage'];
        unset($_COOKIE['lineMessage']);
        $_SESSION['sendMessage'] = 1;

        if($_SESSION['cookie'] === '-1') unset($_SESSION['cookie']);

        include_once './src/script_admin.php';
        include_once './../notification/message.php';

        $userToken = checkLineRegister();

        if (isset($_SESSION['cookie']))
        {
            lineMessageSender($userToken, $_SESSION['cookie']);
        }
        else unset($_COOKIE['lineMessage']);
    }

    if (isset($_COOKIE['lineMessage']) && !isset($_SESSION['sendMessage'])){
        unset($_COOKIE['lineMessage']);
    }

    unset($_SESSION['sendMessage']);
    unset($_SESSION['cookie']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลักผู้ดูแลระบบ</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>


<body>

<?php 
    
    include_once('slidebar_admin.php'); 

?>

<div class="main">
    <div class="text-center mt-5">
        <div class="container">
        <script src="./src/script_admin.js"></script>

<?php
   
    if(isset($_SESSION['success'])){

        include_once './src/script_main.php';
        landingBlock();
    }

    include_once './src/script_admin.php';
    printUserProfile();

?>

            <!--div class="display-3 text-center"-->
            <!-- div class="text-center mt-5">
                <button class="btn btn-success mb-3" onclick="
                getDataPrompt();
                destroyCookie('lineMessage');
                ">test</button -->
                <!-- button class="btn btn-success mb-3" onclick=  //I think this part should work on javascript, or php only.
                "

< ?php  //it was broken when you add php codes to button element, I have to fix.

    include_once '/notification/message.php';
    //lineMessage(); //old method, but I have to split function.

    $userToken = checkLineRegister();

?>
    //message = getDataPrompt();  //old method, direct return :js

    getDataPrompt();  //new method, using cookie to bypass

< ?php

    lineMessageSender($userToken, $_TOKEN['lineMessage']);
    unset($userToken);

?>

    destroyCookie('lineMessage');

                ">
                    ส่งข้อความผ่าน LINE
                </button -->


                <form id="lineMessage" action="./admin_home.php" method="post">
                    <input type="text" name="lineMessageBox" value="nothing" hidden>
                        <!-- using hidden input can handle most situation, like can't find $_POST variable -->
                    <button type="submit" class="btn btn-success" name="lineMessageButton"  value="shh" onclick=
                    "
                        getDataPrompt();  //I will destroy cookie on php side. And I won't use destroyCookie() that I have created.
                    ">
                        ส่งข้อความผ่าน Line
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</div>


    <!-- script src="./src/script_admin.js"></script 
        you have to include script before it was called.
    -->
    
</body>
</html>