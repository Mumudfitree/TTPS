<?php
    session_start();
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
    $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

    $api_url = 'https://notify-api.line.me/api/notify';
    $callback_url = 'http://localhost/TTPS/notification/message.php';

    /* function message()  //ตรงนี้ต้องการทำกรณีที่ไม่ได้ส่งข้อความอะไรมา ยังไม่ได้ทำ
    {
        $client_id = 'wpUIRBGGA6B7RaRF02BrON';
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-bot.line.me/oauth/token';
        $callback_url = 'http://localhost/TTPS/notification/message.php';

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
        
        } catch(Exception $e) {
            throw new Exception($e->getMessage());

        }
    } */

    function getToken()
    {
        $sql = "SELECT token FROM notify WHERE master_id = ".$_SESSION['master_id']."; ";
                $query = mysqli_query($GLOBALS['conn'], $sql);
                $row = mysqli_fetch_array($query);

                //if called directly, return token values (and UserID?)
                //return $row['token'];

                //if called indirectly, return token
                return $row['token'];
    }

    function getUserToken(string $user)
    {

    }

    function _message(string $msg) //stream methods
    {   
        $senderID = getToken();

        $queryData = array('message' => $msg);
        $queryData = http_build_query($queryData,'','&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                            ."Authorization: Bearer ".$senderID."\r\n"
                            ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($GLOBALS['api_url'], FALSE, $context);
        $res = json_decode($result);
        return $res;
    }

    function message(string $msg) //curl methods
    {
        $client_id = 'wpUIRBGGA6B7RaRF02BrON';
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-bot.line.me/oauth/token';
        $callback_url = 'http://localhost/TTPS/notification/message.php';

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
        
        } catch(Exception $e) {
            throw new Exception($e->getMessage());

        }
    }

?>