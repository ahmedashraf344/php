<?php

namespace App\Services\Notification;

use App\Services\Notification\Contracts\Notification;

class PushNotification implements Notification
{

    /**
     * Send Push Notification
     *
     * @param array $data
     * @param $message
     * @return bool
     */
    public function send(array $data,$message): bool
    {
//        dd(1);
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $ids = $data;

        $serverKey = 'AIzaSyDMhjYBw9PSOZL2CRLpLjR0cdyXesssmLM';

        $notification = [
            "title" => "Board-G System",
            "body" => $message,
            "sound" => "default",
            "badge" => "1",
        ];

        $extraNotificationData = [
            "title" => "Board-G System",
            "body" => $message,
            "sound" => "default",
            "badge" => "1",
        ];

        $fcmNotification = [
            'registration_ids' => $ids, //multple token array
            "priority"      => "High",
            "notification"  => $notification,
            "data"          => $extraNotificationData
        ];

        $headers = [
            'Authorization: key='.$serverKey,
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
