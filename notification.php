<?php
    extract($_POST);
    $url = 'https://fcm.googleapis.com/fcm/send';
    $data = [
        "to" => '/topics/mycustomtopic',
        "notification" => [
            "body" => $msg,
            "title" => $title
        ],
        "data" => [
            "titulo" => $title,
            "mensaje" => $msg
        ]
    ];
    $data = json_encode($data);
    $url = 'https://fcm.googleapis.com/fcm/send';
    $server_key = '';
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$server_key
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $result = curl_exec($ch);
    if ($result === FALSE) {
        echo ('Oops! FCM Send Error: ' . curl_error($ch));
    }else{
        echo 'OK';
    }
    curl_close($ch);
