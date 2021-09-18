<?php

    function printUserProfile(){
        
        echo ('
            <h3>
                ยินดีต้อนรับ <br>
                คุณ '.$_SESSION['user_login'].'
            </h3>
            ');
    }

    /*function lineMessage(){  //This function is first attempt. Didn't work well. Because it can't split section to vary.

        $queryData = getToken();

            if ($queryData['token'] === NULL or $queryData['token'] === '\0')
                { //จะต้องกดปุ่มใหม่ ถ้ายังไม่ลงทะเบียน ยังต้องแก้ให้สามารถดึงมาต่อจุดเดิมได้

                    header('locaton: /notification/line_notify.php');

                };

    }*/

    function checkLineRegister() //I think it should be better to give redirect on files that called.
    {
        $_SESSION['token'] = getUserTokenLoop($_SESSION['master_id']);

            //if (isset($queryData['token']) or $queryData['token'] === NULL or $queryData['token'] === '\0')
            //it is not correct, because getToken() return as string. (Only $row['token'], not $row)
            
            //if (isset($queryData) or $queryData === NULL or $queryData === '\0')
            //it is still not correct, I need to find if it wasn't set. it should be !isset($queryData) not isset($queryData)

            if (!isset($_SESSION['token']) || $_SESSION['token'] === NULL)
                { //จะต้องกดปุ่มใหม่ ถ้ายังไม่ลงทะเบียน ยังต้องแก้ให้สามารถดึงมาต่อจุดเดิมได้

                    //header('locaton: /notification/line_notify.php');

                    //header('location: ./../../notification/line_notify.php'); //don't copy from testType.php, it was in test folder, and it isn't equivalent to this file.

                    $_SESSION['unregister'] = 1;
                    return 1;

                }
        
        return 0;
    }

    /*function lineMessageSender($tokenQuery, $messageData)   //This is old one, I want to edit this. but I just done in line_notify.php, So I just preserve it.
    {   //using cURL method

        $client_id = 'wpUIRBGGA6B7RaRF02BrON';
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-api.line.me/api/notify';
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
        

    }*/

    /*function lineMessageSender($tokenQuery, $messageData)  Second edition, not work that well
    {   //using cURL method

        $senderID = getToken();

        $client_id = 'wpUIRBGGA6B7RaRF02BrON';
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-api.line.me/api/notify';
        $callback_url = 'http://localhost/TTPS/notification/message.php';

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '.$senderID
        ];

        $fields = [  //here should be able to send other forms, more than just text. But just do one-by-one now.
            'message' => $messageData
        ];
        
        try {
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_HEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
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
    }*/

    function lineMessageSender($tokenQuery, string $messageData)
    {   //using cURL method

        if($messageData === NULL || $messageData === '\0' || $messageData === 'null') 
        {
            unset($_COOKIE['lineMessage']);
            return 0;
        }

        $senderID = getUserTokenLoop($_SESSION['master_id']);  //forgot to pass token to variable.

        //$senderID = $tokenQuery;

        $client_id = 'wpUIRBGGA6B7RaRF02BrON';  //Please clean this after commit
        $client_secret = 'o5mbSR8kqb2Rq5wOsfDwZQ2JiP8picFpFszofs2ea3A';

        $api_url = 'https://notify-api.line.me/api/notify';
        $callback_url = 'http://localhost/TTPS/notification/message.php';

        //You should send CURLOPT_HTTPHEADER as arrays according to document
        //You should send CURLOPT_POSTFIELDS as strings according to document
        //https://www.php.net/manual/en/function.curl-setopt.php

        /*$headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '.$senderID.''
        ];*/

        
        foreach ($senderID as $sender){  

            $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sender.'');  //You have to send headers as arrays
    
            $fields = [  //here should be able to send other forms, more than just text. But just do one-by-one now.
                'message' => $messageData
            ];

            try {
                $ch = curl_init();
            
                curl_setopt($ch, CURLOPT_URL, $api_url);
                //curl_setopt($ch, CURLOPT_HEADER, $headers); //not CURLOPT_HEADER, it's CURLOPT_HTTPHEADER
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POST, count($fields));
                //curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); //have to send as string if it only have 1 argument, I can't send like this
                curl_setopt($ch, CURLOPT_POSTFIELDS, "message=".$messageData);
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
    }

?>