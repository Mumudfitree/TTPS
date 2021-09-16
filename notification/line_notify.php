<?php   
    if(session_status() != 2){
        session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
    }
    require_once('../connection.php');

    if(!isset($_SESSION['login_type'])){
        $_SESSION['login_type'] = 0;
        http_response_code(403);
        //header("location: ../index.php");
        return;
    }
    if($_SESSION['login_type'] === 0){
        http_response_code(403);
        //header("location: ../index.php");
        return;
    }

    $client_id = 'wpUIRBGGA6B7RaRF02BrON';
    $api_url = 'https://notify-bot.line.me/oauth/authorize?';
    $callback_url = 'http://localhost/TTPS.wsl/notification/line_notify.php'; //have to change back later
        
    $state = "mylinenotify";
        
    haveState();

    //I have to create redirect control function after this.
    if(isset($_SESSION['processingStage']) && $_SESSION['processingStage'] === 'redirectBack'){

            unset($_SESSION['processingStage']);

            header("location: ".$_SESSION['relatedURI']); //it should redirect back to unfinished work from before. Maybe I always save URL before it redirect to other page? But it shouldn't fix all of problem, I have to save stage too. Maybe save every stage that it progress. And have Central function to give where it should go, and what value it should be? Like 'redirectUnauthorizeHello' or 'errorAuthorizeRedirectTo_./admin/download.php'
    }   //I forgot to update function to be able to add token data. Now it just be able to add code only, not token.
        //No, I already did that.

    //unset($_SESSION['processingStage']);
    //unset($_['relatedURI']);    //oops, mistype.
    //unset($_SESSION['relatedURI']);

    function haveState(){

        if(isset($_SESSION['code'])){
            echo "haveSession";

            addDatabase();
            getToken();

            unsetSession();

            $_SESSION['processingStage'] = "redirectBack";

            //if(!isset($_SESSION['recallURI'])){
            if(!isset($_SESSION['relatedURI'])){    

                //$_SESSION['recallURI'];
                $_SESSION['relatedURI'] = "../index.php";
                //$_SESSION['redirectURI' = "/index.php"]
            }

            return;

        }
        if(isset($_GET['state'])){
            echo "haveStage<br>";
            checkState();
        }
        else {
            auth();
        }
    }
        
    function checkState(){  //I forgot to return (or break) from function
        
        if($_GET['state'] === $GLOBALS['state']){
            echo "state<br>";
                        
            clearState();

            return 0;

        }

        echo "<br>".$_GET['state']." ".$GLOBALS['state'];
        echo("<br>State is not match. Please try again.");

    }
            
    function auth(){
            
        $query = [
            'response_type' => 'code',
            'client_id' => $GLOBALS['client_id'],
            'redirect_uri' => $GLOBALS['callback_url'],
            'scope' => 'notify',
            'state' => $GLOBALS['state']
        ];
            
        $queryData = $GLOBALS['api_url'] . http_build_query($query);
        header("location: $queryData");
            
    }
        
    function clearState(){
        //$code = $_GET['code'];  //This one didn't need. I already called directly.
        $_SESSION['code'] = $_GET['code'];

        echo $_SESSION['code'];

        header("location: line_notify.php");
    }
    
    function addDatabase(){

        //ยังไม่เรียบร้อย แต่ว่าพอใช้งานได้
        //อยากให้มีระบบตรวจทานว่าเพิ่มไปให้ใคร
        //ถ้ามีอีเมล์ก็ตรวจว่าตรงกับที่มีไหม
        //ถ้าตรง ให้ทำการเพิ่มไปใน database และแจ้งว่าเพิ่มลงในอีเมล์นี้แล้ว
        //แล้วถามเพิ่มว่า ไม่ใช่บัญชีนี้หรือ
        //ถ้าไม่ตรง ให้เพิ่มลงใน guestXX ก่อน
        //แล้วแจ้งว่า เพิ่มลงใน guest แล้ว
        //ถามเพิ่มว่า เพิ่มชื่อลงในระบบ

        //เวลาที่ใช้บัญชีที่ทำการเชื่อม line notify แล้ว
        //ให้ดึงข้อมูลไปใช้ได้ทันที ไม่ต้องขอใหม่


        //ปัญหาที่ยังไม่แก้ไข
        //การจะใช้งาน line notify จำเป็นต้อง log in ในระบบก่อน
        //ไม่เช่นนั้นจะทำการเพิ่มข้อมูลไม่ขึ้น
        //เพราะพยายามเชื่อมกับ database จึงจำเป็นต้องมี master_id

    
        if($_SESSION['login_type']){
            echo $_SESSION['user_login'];
        }

        try{   //Here you are still didn't give entry for new user, I have to fix this.
            if(!isset($errorMsg)){ //This one doesn't use because I will use query() instead.
                //$insert_stmt = $GLOBALS['db']->prepare("SELECT * FROM login_information WHERE username = :id;");

                //this codes should be seperate to function in the future
                /*if($insert_stmt->execute()){

                    //problem is, I forgot to change other one that called it. So the it show that SQL codes were wrong. Codes from first one is correct, but not the second one. Because it pass checking Query at first times, but not the second.

                }*/ //old one

                //I mean, this codes should be seperate to function.
                $insert_stmt = 'SELECT * FROM login_information';
                $stmt = $GLOBALS['db']->query($insert_stmt);

                $dbData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($dbData as $distinctData){

                    //This is wrong, I need to find if there are already created one. Not finds if that datas that are reading now is exist. Or if datas that is reading now is NULL.
                    //if(!isset($distinctData["master_id"]) or $distinctData["master_id"] === NULL){

                    if(intval($distinctData['master_id']) === intval($_SESSION['master_id']) && !isset($_SESSION['unregister'])){  //This is wrong. It will always try using INSERT INTO no matter what your datas is already there or not.
                    //But... Actually, it was true. Codes is UPDATE, not INSERT TO. INSERT TO are outside.

                        $insert_stmt = $GLOBALS['db']->prepare("UPDATE notify
                                                                        SET code = :code
                                                                        WHERE master_id = :n;");
                        //$insert_stmt->bindParam(":id", $_SESSION['user_login']); 
                        //old one, and didn't have to use anymore.
                        $insert_stmt->bindParam(":code", $_SESSION['code']);
                        $insert_stmt->bindParam(":n", $_SESSION['master_id']); //forgot to change to master_id

                        if($insert_stmt->execute()){
                            $insertMsg = "Updated successfully.";  
                        }
                        
                        return 0;
                        
                    }
                    
                    //This codes should be seperate to function
                    //$insert_stmt = $GLOBALS['db']->prepare("INSERT INTO notify (master_id, code) VALUES :n, :code");
                    //This codes should have move to outside and get codes from outsides in.
                }
                $code = $_SESSION['code'];
                $n = intval($_SESSION['master_id']);
                
                $insert_stmt = $GLOBALS['db']->prepare("INSERT INTO notify (master_id, code) VALUES :n, :code; ");


                $insert_stmt->bindParam(":code", $code);
                $insert_stmt->bindParam(":n", $n, \PDO::PARAM_INT); //forgot to change to master_id
                
                if($insert_stmt->execute()){
                    $insertMsg = "Updated successfully.";  
                }
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }

    }

    function getToken(){

        $client_id = 'wpUIRBGGA6B7RaRF02BrON';
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-bot.line.me/oauth/token';
        $callback_url = 'http://localhost/TTPS.wsl/notification/line_notify.php';   //have to change back later

        $fields = [
            'grant_type' => 'authorization_code',
            'code' => $_SESSION['code'],
            'redirect_uri' => $callback_url,
            'client_id' => $client_id,
            'client_secret' => $client_secret
        ];
        
        try {
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
            $res = curl_exec($ch);
            curl_close($ch);
        
            if ($res == false)
                throw new Exception(curl_error($ch), curl_errno($ch));
        
            $json = json_decode($res);

            $_SESSION['token'] = $json->access_token;


            try{
                if(!isset($errorMsg)){ //bugs is from here, I forgot to unset $errorMsg (or is it?)
                                       //No, it wasn't. bugs is from forgot to return function. And it run code outside Condition Scope.

                    $insert_stmt = $GLOBALS['db']->prepare("UPDATE notify
                                                                SET token = :token
                                                                WHERE master_id = :n;");
                    $insert_stmt->bindParam(":token", $_SESSION['token']);
                    $insert_stmt->bindParam(":n", $_SESSION['master_id']); //forgot to change to master_id
                    
                    if($insert_stmt->execute()){
                        $insertMsg = "Updated successfully.";   
                    }
                }
            } catch (PDOException $e){
                echo $e->getMessage();
            }
    
        } catch(Exception $e) {
            throw new Exception($e->getMessage());

        }
    }

    function unsetSession(){

        unset($_SESSION['code']);
        unset($_SESSION['token']);
    }
    
?>