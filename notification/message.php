<?php
    if(session_status() != 2){
        session_start();//คำสั่งต้องloginก่อนถึงเข้าได้
    }

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

    include_once './../connection.php';

    $client_id = 'wpUIRBGGA6B7RaRF02BrON';
    $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

    $api_url = 'https://notify-api.line.me/api/notify';
    $callback_url = 'http://localhost/TTPS.wsl/notification/message.php';  //have to change back later

    function getToken()
    {
        $sql = "SELECT * FROM notify WHERE master_id = ".$_SESSION['master_id']."; ";
                $query = mysqli_query($GLOBALS['conn'], $sql);
                $row = mysqli_fetch_array($query);

                return $row;  
                
    }

    function getAllToken()
    {
        $sql = "SELECT * FROM notify";
        $query = mysqli_query($GLOBALS['conn'], $sql);

        $arr = array();
        $i = 0;
        while ($row = mysqli_fetch_array($query)) {

            if($row['master_id'] === $_SESSION['master_id']) {

            }
                    
                    $arr[$i] = $row['master_id'];
                    $i++;
                }

                return $arr;

    }

    function getUserToken(string $user)
    {

    }

    function getUserTokenLoop(int $id){
        $sql = "SELECT * FROM notify WHERE master_id = ".$id.";";
        $query = mysqli_query($GLOBALS['conn'], $sql);
        $row = mysqli_fetch_array($query);

        return $row;
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
        $senderID = getToken();

        $client_id = 'wpUIRBGGA6B7RaRF02BrON';  //Please clean this after commit
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-api.line.me/api/notify';
        $callback_url = 'http://localhost/TTPS.wsl/notification/message.php';  //have to change back later

        //You should send CURLOPT_HTTPHEADER as arrays according to document
        //You should send CURLOPT_POSTFIELDS as strings according to document
        //https://www.php.net/manual/en/function.curl-setopt.php

        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$senderID.'');  //You have to send headers as arrays

        $fields = [  //here should be able to send other forms, more than just text. But just do one-by-one now.
            'message' => $msg
        ];
        
        try {
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, "message=".$msg);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
            $res = curl_exec($ch);
            curl_close($ch);
        
            if ($res == false)
                throw new Exception(curl_error($ch), curl_errno($ch));
        
            $json = json_decode($res);
        
        } catch(Exception $e) {
            throw new Exception($e->getMessage());

        }
    }

?>